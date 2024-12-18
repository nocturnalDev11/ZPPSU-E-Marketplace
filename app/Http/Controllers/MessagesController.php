<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $users = User::where(function ($query) {
            $query->whereExists(function ($subQuery) {
                $subQuery->selectRaw(1)
                    ->from('messages')
                    ->whereRaw('messages.sender_id = users.id')
                    ->where('messages.recipient_id', Auth::id());
            })
                ->orWhereExists(function ($subQuery) {
                    $subQuery->selectRaw(1)
                        ->from('messages')
                        ->whereRaw('messages.recipient_id = users.id')
                        ->where('messages.sender_id', Auth::id());
                });
        })
            ->where('id', '!=', Auth::id())
            ->with(['sentMessages' => function ($query) {
                $query->where('recipient_id', Auth::id())->latest();
            }, 'receivedMessages' => function ($query) {
                $query->where('sender_id', Auth::id())->latest();
            }])
            ->get()
            ->map(function ($userItem) {
                $userItem->latestMessage = $userItem->sentMessages->merge($userItem->receivedMessages)
                    ->sortByDesc('created_at')
                    ->first();
                return $userItem;
            });

        return Inertia::render('Messages/Index', [
            'users' => $users
        ]);
    }

    public function conversation(Request $request, User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', Auth::id())
                ->where('recipient_id', $user->id)
                ->orWhere('sender_id', $user->id)
                ->where('recipient_id', Auth::id());
        })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                if ($message->content_link_image) {
                    $message->content_link_image_url = Storage::url($message->content_link_image);
                }
                return $message;
            });

        $users = User::where(function ($query) {
            $query->whereExists(function ($subQuery) {
                $subQuery->selectRaw(1)
                    ->from('messages')
                    ->whereRaw('messages.sender_id = users.id')
                    ->where('messages.recipient_id', Auth::id());
            })
                ->orWhereExists(function ($subQuery) {
                    $subQuery->selectRaw(1)
                        ->from('messages')
                        ->whereRaw('messages.recipient_id = users.id')
                        ->where('messages.sender_id', Auth::id());
                });
        })
            ->where('id', '!=', Auth::id())
            ->with(['sentMessages' => function ($query) {
                $query->where('recipient_id', Auth::id())->latest();
            }, 'receivedMessages' => function ($query) {
                $query->where('sender_id', Auth::id())->latest();
            }])
            ->get()
            ->map(function ($userItem) {
                $userItem->latestMessage = $userItem->sentMessages->merge($userItem->receivedMessages)
                    ->sortByDesc('created_at')
                    ->first();
                return $userItem;
            });

        return Inertia::render('Messages/Index', [
            'selectedUser' => $user,
            'messages' => $messages,
            'users' => $users,
            'currentUserId' => Auth::id(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/mpeg|max:10240',
        ]);

        $message = new Message();
        $message->sender_id = Auth::id();
        $message->recipient_id = $validated['recipient_id'];
        $message->content = $validated['content'];

        if ($request->hasFile('image')) {
            $message->image = $request->file('image')->store('images', 'public');
        }

        if ($request->hasFile('video')) {
            $message->video = $request->file('video')->store('videos', 'public');
        }

        $message->save();

        return back()->with('success', 'Message sent successfully!');
    }

    public function storeListInquiry(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'content' => 'required|string|max:255',
            'content_title' => 'nullable|string',
            'content_link' => 'nullable|url',
            'content_link_image' => 'nullable|string',
            'content_link_description' => 'nullable|string',
        ]);

        $user = Auth::user();

        $message = new Message([
            'sender_id' => $user->id,
            'recipient_id' => $validated['recipient_id'],
            'content' => $validated['content'],
            'content_title' => $validated['content_title'],
            'content_link' => $validated['content_link'],
            'content_link_image' => $validated['content_link_image'],
            'content_link_description' => $validated['content_link_description'],
        ]);

        $message->save();

        return redirect()->route('messages.index');
    }

    public function reply(Request $request, User $user)
    {
        $validated = $request->validate([
            'replyContent' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $reply = new Message();
        $reply->sender_id = Auth::id();
        $reply->recipient_id = $user->id;
        $reply->content = $validated['replyContent'];

        if ($request->hasFile('image')) {
            $reply->image = $request->file('image')->store('images', 'public');
        }

        $reply->save();

        return redirect()->route('messages.index', ['user' => $user->id])->with('success', 'Reply sent successfully!');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return back()->with('success', 'Message deleted successfully!');
    }
}
