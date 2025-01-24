<?php

namespace App\Http\Controllers\User\Lists\Products;

use Illuminate\Http\Request;
use App\Models\Product\Rating;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    public function rate(Request $request)
    {
        $request->validate([
            'rating_value' => 'required|numeric|min:1|max:5',
            'rating_text' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'parent_id' => 'nullable|exists:ratings,id',
        ]);

        Rating::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'parent_id' => $request->parent_id,
            'rating_value' => $request->rating_value,
            'rating_text' => $request->rating_text,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    public function reply(Request $request)
    {
        $request->validate([
            'rating_text' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'parent_id' => 'nullable|exists:ratings,id',
        ]);

        Rating::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
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
    public function destroy($id)
    {
        $rating = Rating::find($id);

        if (!$rating) {
            abort(404);
        }

        if ($rating->user_id !== Auth::id() && $rating->product->user_id !== Auth::id()) {
            abort(403);
        }

        $rating->delete();

        return redirect()->back()->with('success', 'Rating deleted successfully.');
    }
}
