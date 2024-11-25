<?php

namespace App\Http\Controllers\Lists;

use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of all services.
     */
    public function index()
    {
        $isAuthorized = Auth::check();

        $services = Service::all()->map(function ($service) {
            $service->services_picture = $service->services_picture ? Storage::url($service->services_picture) : null;
            return $service;
        });

        return Inertia::render('Lists/Services/Index', [
            'services' => $services,
            'isAuthorized' => $isAuthorized,
        ]);
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return Inertia::render('Lists/Services/Partials/Create');
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'services_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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

    /**
     * Display the specified service.
     */
    public function show(string $id)
    {
        $isAuthorized = Auth::check();

        $service = Service::with('user')->find($id);
        $service->services_picture = $service->services_picture ? Storage::url($service->services_picture) : null;

        $relatedServices = Service::where('services_category', $service->services_category)
            ->where('id', '!=', $id)
            ->take(5)
            ->get();

        $relatedServices = $relatedServices->map(function ($relatedService) {
            $relatedService->services_picture = $relatedService->services_picture ? Storage::url($relatedService->services_picture) : null;
            return $relatedService;
        });

        return Inertia::render('Lists/Services/Show', [
            'user' => Auth::user(),
            'service' => $service,
            'relatedServices' => $relatedServices,
            'isAuthorized' => $isAuthorized,
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

        return Inertia::render('Lists/Services/Edit', [
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
            'services_title' => 'required|string|max:255',
            'services_status' => 'required|string',
            'services_fee' => 'required|numeric',
            'services_category' => 'required|string',
            'services_description' => 'required|string|max:65535',
        ]);

        $service->update($validatedData);

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
