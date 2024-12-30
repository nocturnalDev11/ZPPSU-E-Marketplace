<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProfileController extends Controller
{
    /**
     * Helper method to retrieve a user by ID or default to the authenticated user.
     */
    private function getUser($id = null)
    {
        return $id ? User::findOrFail($id) : Auth::user();
    }

    /**
     * Display the user's profile.
     */
    // public function show($id = null)
    // {
    //     $profileUser = $this->getUser($id);
    //     $profileUser->profile_picture = $profileUser->profile_picture ? Storage::url($profileUser->profile_picture) : null;

    //     $authUser = Auth::user();

    //     $posts = $profileUser->posts ?? collect();

    //     $activities = $posts->map(function ($post) {
    //         return [
    //             'title' => $post->post_title,
    //             'image' => $post->post_picture,
    //             'description' => $post->post_content,
    //             'created_at' => $post->created_at,
    //             'route' => route('posts.show', $post->id),
    //             'type' => 'Post',
    //         ];
    //     })->sortByDesc('created_at')->values();

    //     return Inertia::render('User/Profile/View', [
    //         'auth' => [
    //             'user' => $authUser,
    //         ],
    //         'profileUser' => $profileUser,
    //         'activities' => $activities,
    //         'posts' => $posts,
    //         'postCount' => $posts->count(),
    //     ]);
    // }

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
                'type' => 'Post',
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
            ->merge($products)
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
            'productCount' => $products->count(),
            // 'serviceCount' => $services->count(),
            // 'tradeCount' => $trades->count(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, $id = null): Response
    {
        $user = $this->getUser($id);

        return Inertia::render('User/Profile/Edit', [
            'user' => $user,
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, $id = null): RedirectResponse
    {
        $user = $id ? User::findOrFail($id) : $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit', ['id' => $user->id]);
    }

    public function updateProfilePicture(Request $request, $id = null)
    {
        $user = $id ? User::findOrFail($id) : Auth::user();

        $request->validate([
            'profile_picture' => 'nullable|image',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
            $user->save();
        }

        return redirect()->route('profile.show', $user->id)->with('success', 'Profile picture updated successfully.');
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

        return Redirect::to('/');
    }
}
