<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all()->map(function ($product) {
        //     $product->prod_picture = $product->prod_picture ? Storage::url($product->prod_picture) : null;
        //     return $product;
        // });

        // $services = Service::all()->map(function ($service) {
        //     $service->services_picture = $service->services_picture ? Storage::url($service->services_picture) : null;
        //     return $service;
        // });

        // $trades = Trade::all()->map(function ($trade) {
        //     $trade->trade_picture = $trade->trade_picture ? Storage::url($trade->trade_picture) : null;
        //     return $trade;
        // });

        $posts = Post::all()->map(function ($post) {
            $post->post_picture = $post->post_picture ? Storage::url($post->post_picture) : null;
            return $post;
        });

        return Inertia::render('LandingPage', [
            // 'products' => $products,
            // 'services' => $services,
            // 'trades' => $trades,
            'posts' => $posts
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
        //
    }
}
