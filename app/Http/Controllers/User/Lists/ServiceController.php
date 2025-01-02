<?php

namespace App\Http\Controllers\User\Lists;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use App\Http\Controllers\Controller;
use App\Models\Service\ServiceRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the service.
     */
    public function index()
    {
        $services = Service::all()->map(function ($service) {
            $service->services_picture = $service->services_picture ? Storage::url($service->services_picture) : null;
            return $service;
        });

        return Inertia::render('User/Lists/Services/Index', [
            'services' => $services,
        ]);
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return Inertia::render('User/Lists/Services/Partials/Create');
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'services_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'services_title' => 'required|string|max:255',
            'services_status' => 'required|string',
            'services_fee' => 'required|numeric',
            'services_category' => 'required|string',
            'services_description' => 'required|string|max:65535',
        ]);

        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('services_picture')) {
            $path = $request->file('services_picture')->store('services_picture', 'public');
            $validatedData['services_picture'] = $path;
        }

        Service::create($validatedData);

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    public function rate(Request $request)
    {
        $request->validate([
            'rating_value' => 'required|numeric|min:1|max:5',
            'rating_text' => 'nullable|string',
            'services_id' => 'required|exists:services,id',
            'parent_id' => 'nullable|exists:ratings,id',
        ]);

        ServiceRating::create([
            'user_id' => Auth::id(),
            'services_id' => $request->services_id,
            'parent_id' => $request->parent_id,
            'rating_value' => $request->rating_value,
            'rating_text' => $request->rating_text,
        ]);

        return back()->with('success', 'Rating added successfully.');
    }

    public function reply(Request $request)
    {
        $request->validate([
            'rating_text' => 'nullable|string',
            'services_id' => 'required|exists:services,id',
            'parent_id' => 'nullable|exists:ratings,id',
        ]);

        ServiceRating::create([
            'user_id' => Auth::id(),
            'services_id' => $request->services_id,
            'parent_id' => $request->parent_id,
            'rating_text' => $request->rating_text,
        ]);

        return back()->with('success', 'Reply added successfully.');
    }

    /**
     * Display the specified service.
     */
    public function show(string $id)
    {
        $service = Service::with(['user', 'ratings.user'])->findOrFail($id);

        $service->services_picture = $service->services_picture ? Storage::url($service->services_picture) : null;

        $ratings = $service->ratings()
                    ->whereNull('parent_id')
                    ->with('replies.user')
                    ->latest()
                    ->get();

        $relatedServices = Service::where('services_category', $service->services_category)
                            ->where('id', '!=', $id)
                            ->take(5)
                            ->get()
                            ->map(function ($relatedService) {
                                $relatedService->services_picture = $relatedService->services_picture ? Storage::url($relatedService->services_picture) : null;
                                return $relatedService;
                            });

        return Inertia::render('User/Lists/Services/Show', [
            'user' => Auth::user(),
            'user_id' => Auth::id(),
            'service' => $service,
            'ratings' => $ratings,
            'relatedServices' => $relatedServices,
        ]);
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(string $id)
    {
        $service = Service::find($id);

        if (!$service || $service->user_id !== Auth::id()) {
            return redirect()->route('services.index')->with('error', 'service not found or unauthorized.');
        }

        $service->services_picture = $service->services_picture ? Storage::url($service->services_picture) : null;

        return Inertia::render('User/Lists/ServicesPartials/Edit', [
            'service' => $service,
        ]);
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        if (Auth::id() !== $service->user_id) {
            return redirect()->route('services.index')->with('error', 'You are not authorized to update this service');
        }

        $validatedData = $request->validate([
            'services_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'services_title' => 'required|string|max:255',
            'services_status' => 'required|string',
            'services_fee' => 'required|numeric',
            'services_category' => 'required|string',
            'services_description' => 'required|string|max:65535',
        ]);

        $services_picture = $service->services_picture;

        if ($request->hasFile('services_picture')) {
            Storage::delete('public/' . $service->services_picture);
            $services_picture = $request->file('services_picture')->store('services_pictures', 'public');
        }

        $service->update(array_merge($validatedData, [
            'services_picture' => $services_picture,
        ]));

        return redirect()->route('services.show', $service->id)
            ->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified service.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        if (Auth::id() !== $service->user_id) {
            return redirect()->route('services.index')->with('error', 'Unauthorized access.');
        }

        if ($service->services_picture) {
            Storage::disk('public')->delete($service->services_picture);
        }

        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
