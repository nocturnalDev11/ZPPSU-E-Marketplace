<?php

namespace App\Http\Controllers\Lists;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of all posts.
     */
    public function index()
    {
        $isAuthorized = Auth::check();

        $posts = Post::all()->map(function ($post) {
            $post->post_picture = $post->post_picture ? Storage::url($post->post_picture) : null;
            return $post;
        });

        return Inertia::render('Lists/Posts/Index', [
            'posts' => $posts,
            'isAuthorized' => $isAuthorized,
        ]);
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_title' => 'required|string|max:255',
            'post_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'post_list_type' => 'required|string',
            'post_content' => 'required|string|max:65535'
        ]);

        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('post_picture')) {
            $path = $request->file('post_picture')->store('post_pictures', 'public');
            $validatedData['post_picture'] = $path;
        }

        Post::create($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        $post->post_picture = $post->post_picture ? Storage::url($post->post_picture) : null;

        return Inertia::render('Lists/Posts/Show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);

        if (!$post || $post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Post not found or unauthorized.');
        }

        $post->post_picture = $post->post_picture ? Storage::url($post->post_picture) : null;

        return Inertia::render('Lists/Posts/Partials/Edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to update this post');
        }

        $validatedData = $request->validate([
            'post_title' => 'required|string|max:255',
            'post_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'post_list_type' => 'required|string',
            'post_content' => 'required|string|max:65535'
        ]);

        if ($request->hasFile('post_picture')) {
            if ($post->post_picture) {
                Storage::disk('public')->delete($post->post_picture);
            }

            $path = $request->file('post_picture')->store('post_pictures', 'public');
            $validatedData['post_picture'] = $path;
        }

        $post->update($validatedData);

        return redirect()->route('posts.show', $post->id)
            ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        if ($post->post_picture) {
            Storage::disk('public')->delete($post->post_picture);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
