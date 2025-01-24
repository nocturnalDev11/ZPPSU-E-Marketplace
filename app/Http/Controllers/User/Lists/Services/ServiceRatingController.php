<?php

namespace App\Http\Controllers\User\Lists\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Service\ServiceRating;

class ServiceRatingController extends Controller
{
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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $rating = ServiceRating::find($id);

        if (!$rating) {
            abort(404);
        }

        if ($rating->user_id !== Auth::id() && $rating->service->user_id !== Auth::id()) {
            abort(403);
        }

        $rating->delete();

        return redirect()->back()->with('success', 'Rating deleted successfully.');
    }
}
