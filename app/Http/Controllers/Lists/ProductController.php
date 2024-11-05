<?php

namespace App\Http\Controllers\Lists;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index()
    {
        $isAuthorized = Auth::check();

        $products = Product::all()->map(function ($product) {
            $product->prod_picture = $product->prod_picture ? Storage::url($product->prod_picture) : null;
            return $product;
        });

        return Inertia::render('Lists/Products/Index', [
            'products' => $products,
            'isAuthorized' => $isAuthorized,
        ]);
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prod_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'prod_name' => 'required|string|max:255',
            'prod_price' => 'required|numeric',
            'prod_status' => 'required|string',
            'prod_category' => 'required|string',
            'prod_condition' => 'required|string',
            'prod_description' => 'required|string|max:65535',
            'prod_quantity' => 'required|integer',
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
     * Display the specified product.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $product->prod_picture = $product->prod_picture ? Storage::url($product->prod_picture) : null;

        return Inertia::render('Lists/Products/Show', [
            'product' => $product,
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

        return Inertia::render('Lists/Products/Partials/Edit', [
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
            return redirect()->route('products.index')->with('error', 'You are not authorized to update this product');
        }

        $validatedData = $request->validate([
            'prod_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'prod_name' => 'required|string|max:255',
            'prod_price' => 'required|numeric',
            'prod_status' => 'required|string',
            'prod_category' => 'required|string',
            'prod_condition' => 'required|string',
            'prod_description' => 'required|string|max:65535',
            'prod_quantity' => 'required|integer',
        ]);

        if ($request->hasFile('prod_picture')) {
            if ($product->prod_picture) {
                Storage::disk('public')->delete($product->prod_picture);
            }

            $path = $request->file('prod_picture')->store('product_pictures', 'public');
            $validatedData['prod_picture'] = $path;
        }

        $product->update($validatedData);

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