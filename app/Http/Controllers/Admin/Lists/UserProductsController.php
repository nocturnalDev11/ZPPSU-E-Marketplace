<?php

namespace App\Http\Controllers\Admin\Lists;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('user')->get();

        foreach ($products as $product) {
            $product->prod_picture = $product->prod_picture ? Storage::url($product->prod_picture) : null;
        }

        return Inertia::render('Admin/Lists/Products/ProductTable', [
            'user' => Auth::user(),
            'products' => $products,
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
        $product = Product::findOrFail($id);

        if ($product->prod_picture) {
            Storage::disk('public')->delete($product->prod_picture);
        }

        $product->delete();

        return redirect()->route('user-product.index')->with('success', 'Product deleted successfully.');
    }
}
