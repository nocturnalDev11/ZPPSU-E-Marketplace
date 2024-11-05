<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProfileController extends Controller
{
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
    public function show($id = null)
    {
        $user = $id ? User::findOrFail($id) : User::findOrFail(Auth::id());

        $posts = $user->posts->map(fn($post) => [
            'title' => $post->post_title,
            'image' => $post->post_picture,
            'description' => $post->post_content,
            'created_at' => $post->created_at,
            'type' => 'Post'
        ]);

        $products = $user->products->map(fn($product) => [
            'title' => $product->prod_name,
            'status' => $product->prod_status,
            'category' => $product->prod_category,
            'image' => $product->prod_picture ? Storage::url($product->prod_picture) : null,
            'description' => $product->prod_description,
            'price' => $product->prod_price,
            'created_at' => $product->created_at,
            'route' => route('products.show', $product->id),
            'type' => 'Product',
        ]);

        $services = $user->services->map(fn($service) => [
            'title' => $service->services_title,
            'image' => $service->services_picture ? Storage::url($service->services_picture) : null,
            'description' => $service->services_description,
            'created_at' => $service->created_at,
            'type' => 'Service'
        ]);

        $trades = $user->trades->map(fn($trade) => [
            'title' => $trade->trade_title,
            'image' => $trade->trade_picture,
            'description' => $trade->trade_description,
            'created_at' => $trade->created_at,
            'type' => 'Trade'
        ]);

        $activities = collect()
            ->merge($posts)
            ->merge($products)
            ->merge($services)
            ->merge($trades)
            ->sortByDesc('created_at')
            ->values()
            ->toArray();

        return Inertia::render('Profile/ViewProfile', [
            'auth' => [
                'user' => $user,
            ],
            'activities' => $activities,
            'posts' => $posts,
            'products' => $products,
            'services' => $services,
            'trades' => $trades,
            'postCount' => $posts->count(),
            'productCount' => $products->count(),
            'serviceCount' => $services->count(),
            'tradeCount' => $trades->count(),
        ]);
    }

    // public function show($id = null)
    // {
    //     $user = $id ? User::with(['posts', 'products', 'services', 'trades'])->findOrFail($id)
    //         : User::with(['posts', 'products', 'services', 'trades'])->findOrFail(Auth::id());

    //     // Map user activities with necessary attributes
    //     $activities = collect()
    //         ->merge($user->posts->map(fn($post) => [
    //             'title' => $post->post_title,
    //             'image' => $post->post_picture,
    //             'description' => $post->post_content,
    //             'created_at' => $post->created_at,
    //             'type' => 'Post'
    //         ]))
    //         ->merge($user->products->map(fn($product) => [
    //             'title' => $product->prod_name,
    //             'image' => $product->prod_picture = $product->prod_picture ? Storage::url($product->prod_picture) : null,
    //             'description' => $product->prod_description,
    //             'created_at' => $product->created_at,
    //             'type' => 'Product'
    //         ]))
    //         ->merge($user->services->map(fn($service) => [
    // 'title' => $service->services_title,
    // 'image' => $service->services_picture,
    // 'description' => $service->services_description,
    // 'created_at' => $service->created_at,
    // 'type' => 'Service'
    //         ]))
    //         ->merge($user->trades->map(fn($trade) => [
    //             'title' => $trade->trade_title,
    //             'image' => $trade->trade_picture,
    //             'description' => $trade->trade_description,
    //             'created_at' => $trade->created_at,
    //             'type' => 'Trade'
    //         ]))
    //         ->sortByDesc('created_at')
    //         ->values()
    //         ->toArray();

    //     return Inertia::render('Profile/ViewProfile', [
    //         'auth' => ['user' => $user],
    //         'activities' => $activities,
    //     ]);
    // }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, $id = null): Response
    {
        if ($id) {
            $user = User::findOrFail($id);
        } else {
            $user = User::findOrFail(Auth::id());
        }

        return Inertia::render('Profile/EditProfile', [
            'user' => $user,
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id = null)
    {
        $user = $id ? User::findOrFail($id) : Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|max:255',
            'home_address' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->except(['department', 'login_id', 'profile_picture']));

        return Inertia::render('Profile/ViewProfile', [
            'user' => $user,
        ])->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('Campus/Home');
    }
}
