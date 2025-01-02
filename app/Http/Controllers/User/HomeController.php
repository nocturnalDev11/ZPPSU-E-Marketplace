<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Post\Post;
use App\Models\Trade\Trade;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Service\Service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::limit(10)->get()->map(function ($product) {
            $product->prod_picture = $product->prod_picture ? Storage::url($product->prod_picture) : null;
            return $product;
        });

        $services = Service::limit(10)->get()->map(function ($service) {
            $service->services_picture = $service->services_picture ? Storage::url($service->services_picture) : null;
            return $service;
        });

        $trades = Trade::limit(10)->get()->map(function ($trade) {
            $trade->trade_picture = $trade->trade_picture ? Storage::url($trade->trade_picture) : null;
            return $trade;
        });

        $posts = Post::limit(10)->get()->map(function ($post) {
            $post->post_picture = $post->post_picture ? Storage::url($post->post_picture) : null;
            return $post;
        });

        return Inertia::render('User/Home', [
            'auth' => [
                'user' => Auth::user(),
            ],

            'products' => $products,
            'services' => $services,
            'trades' => $trades,
            'posts' => $posts
        ]);
    }
}
