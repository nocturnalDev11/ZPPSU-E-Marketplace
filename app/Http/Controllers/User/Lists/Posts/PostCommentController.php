<?php

namespace App\Http\Controllers\User\Lists\Posts;

use Illuminate\Http\Request;
use App\Models\Post\PostComment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    public function comment(Request $request)
    {
        $request->validate([
            'comment_text' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        PostComment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
            'comment_text' => $request->comment_text,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    public function destroy(string $id)
    {
        $comment = PostComment::find($id);

        if (!$comment) {
            abort(404);
        }

        if ($comment->user_id !== Auth::id() && $comment->post->user_id !== Auth::id()) {
            abort(403);
        }

        $comment->delete();

        return redirect()->back()->with('success', 'comment deleted successfully.');
    }
}
