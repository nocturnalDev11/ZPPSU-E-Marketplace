<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserManagementController extends Controller
{
    /**
     * Helper method to retrieve a user by ID or default to the authenticated user.
     */
    private function getUser($id = null)
    {
        return $id ? User::findOrFail($id) : Auth::user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get();

        foreach ($users as $user) {
            $user->profile_picture = $user->profile_picture ? Storage::url($user->profile_picture) : null;
        }

        return Inertia::render('Admin/Users/UserManagement', [
            'users' => $users,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id = null)
    {
        $profileUser = $this->getUser($id);
        $profileUser->profile_picture = $profileUser->profile_picture ? Storage::url($profileUser->profile_picture) : null;

        // Fetch the logged-in user
        $authUser = Auth::user();

        $posts = collect($profileUser->posts()->get())->map(function ($post) {
            return [
                'title' => $post->post_title,
                'image' => $post->post_picture ? Storage::url($post->post_picture) : null,
                'description' => $post->post_content,
                'created_at' => $post->created_at,
                'route' => route('posts.show', $post->id),
                'type' => 'Post'
            ];
        });

        $products = $profileUser->products->map(fn($product) => [
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

        // $services = $profileUser->services->map(fn($service) => [
        //     'title' => $service->services_title,
        //     'status' => $service->services_status,
        //     'category' => $service->services_category,
        //     'image' => $service->services_picture ? Storage::url($service->services_picture) : null,
        //     'description' => $service->services_description,
        //     'fee' => $service->services_fee,
        //     'created_at' => $service->created_at,
        //     'route' => route('services.show', $service->id),
        //     'type' => 'Service'
        // ]);

        // $trades = $profileUser->trades->map(fn($trade) => [
        //     'title' => $trade->trade_title,
        //     'image' => $trade->trade_picture,
        //     'description' => $trade->trade_description,
        //     'created_at' => $trade->created_at,
        //     'type' => 'Trade'
        // ]);

        $activities = collect()
            ->merge($posts)
            // ->merge($products)
            // ->merge($services)
            // ->merge($trades)
            ->sortByDesc('created_at')
            ->values()
            ->toArray();

        return Inertia::render('User/Profile/View', [
            'auth' => [
                'user' => $authUser,
            ],
            'profileUser' => $profileUser,
            'activities' => $activities,
            'posts' => $posts,
            'products' => $products,
            // 'services' => $services,
            // 'trades' => $trades,
            'postCount' => $posts->count(),
            // 'productCount' => $products->count(),
            // 'serviceCount' => $services->count(),
            // 'tradeCount' => $trades->count(),
        ]);
    }
}
