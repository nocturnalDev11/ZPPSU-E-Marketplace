<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Trade;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all()->map(function ($product) {
            $product->prod_picture = $product->prod_picture ? Storage::url($product->prod_picture) : null;
            return $product;
        });

        $services = Service::all();
        $trades = Trade::all();
        $posts = Post::all();

        return Inertia::render('LandingPage', [
            'products' => $products,
            'services' => $services,
            'trades' => $trades,
            'posts' => $posts
        ]);
    }
}
