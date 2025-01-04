<?php

namespace App\Http\Controllers\User\Lists;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Models\Product\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index()
    {
        $products = Product::all()->map(function ($product) {
            $product->prod_picture = $product->prod_picture ? Storage::url($product->prod_picture) : null;
            return $product;
        });

        return Inertia::render('User/Lists/Products/Index', [
            'products' => $products,
        ]);
    }

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prod_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'prod_name' => 'required|string|max:255',
            'prod_price' => 'required|numeric|min:0',
            'prod_status' => 'required|string',
            'prod_category' => 'required|string',
            'prod_condition' => 'required|string',
            'prod_description' => 'required|string|max:65535',
            'prod_quantity' => 'required|integer|min:1',
        ]);

        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('prod_picture')) {
            $path = $request->file('prod_picture')->store('product_pictures', 'public');
            $validatedData['prod_picture'] = $path;
        }

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['user', 'ratings.user'])
            ->findOrFail($id);

        $product->prod_picture = $product->prod_picture ? Storage::url($product->prod_picture) : null;

        $ratings = $product->ratings()
                ->whereNull('parent_id')
                ->with('replies.user')
                ->latest()
                ->get();

        return Inertia::render('User/Lists/Products/Show', [
            // 'admin' => Auth::guard('admin'),
            'user' => Auth::user(),
            'user_id' => Auth::id(),
            'product' => $product,
            'ratings' => $ratings
        ]);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        if (!$product || $product->user_id !== Auth::id()) {
            return redirect()->route('products.index')->with('error', 'Product not found or unauthorized.');
        }

        $product->prod_picture = $product->prod_picture ? Storage::url($product->prod_picture) : null;

        return Inertia::render('User/Lists/Products/Partials/Edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        if (Auth::id() !== $product->user_id) {
            return redirect()->route('products.index')->with('error', 'Unauthorized');
        }

        $validatedData = $request->validate([
            'prod_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'prod_name' => 'required|string|max:255',
            'prod_price' => 'required|numeric|min:0',
            'prod_status' => 'required|string',
            'prod_category' => 'required|string',
            'prod_condition' => 'required|string',
            'prod_description' => 'required|string|max:65535',
            'prod_quantity' => 'required|integer|min:1',
        ]);

        $prod_picture = $product->prod_picture;

        if ($request->hasFile('prod_picture')) {
            Storage::delete('public/' . $product->prod_picture);
            $prod_picture = $request->file('prod_picture')->store('product_pictures', 'public');
        }

        $product->update(array_merge($validatedData, [
            'prod_picture' => $prod_picture,
        ]));

        return redirect()->route('products.show', $product->id)
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if (Auth::id() !== $product->user_id) {
            return redirect()->route('products.index')->with('error', 'Unauthorized access.');
        }

        if ($product->prod_picture) {
            Storage::disk('public')->delete($product->prod_picture);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
