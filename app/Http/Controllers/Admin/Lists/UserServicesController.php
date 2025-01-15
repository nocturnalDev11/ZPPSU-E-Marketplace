<?php

namespace App\Http\Controllers\Admin\Lists;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('user')->get();

        foreach ($services as $service) {
            $service->services_picture = $service->services_picture ? Storage::url($service->services_picture) : null;
        }

        return Inertia::render('Admin/Lists/Services/ServiceTable', [
            'user' => Auth::user(),
            'services' => $services,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        if ($service->services_picture) {
            Storage::disk('public')->delete($service->services_picture);
        }

        $service->delete();

        return redirect()->route('user-service.index')->with('success', 'Product deleted successfully.');
    }
}
