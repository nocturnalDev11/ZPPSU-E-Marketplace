<?php

namespace App\Http\Controllers\Admin\Lists;

use Inertia\Inertia;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->get();

        foreach ($posts as $post) {
            $post->post_picture = $post->post_picture ? Storage::url($post->post_picture) : null;
        }

        return Inertia::render('Admin/Lists/Posts/PostTable', [
            'user' => Auth::user(),
            'posts' => $posts,
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
        $post = Post::findOrFail($id);

        if ($post->post_picture) {
            Storage::disk('public')->delete($post->post_picture);
        }

        $post->delete();

        return redirect()->route('user-post.index')->with('success', 'Product deleted successfully.');
    }
}
