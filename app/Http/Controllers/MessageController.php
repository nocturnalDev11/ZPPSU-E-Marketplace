<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // Get all conversations for the user, including latest messages
        // Get all sent messages for the user
        $sentMessages = Message::where('sender_id', $user->id)
            ->with(['sender', 'recipient'])
            ->get();

        // Get all received messages for the user
        $receivedMessages = Message::where('recipient_id', $user->id)
            ->with(['sender', 'recipient'])
            ->get();

        // Merge the sent and received messages
        $messages = $sentMessages->merge($receivedMessages);

        // Group messages by the other participant in the conversation
        $conversations = $messages->groupBy(function ($message) use ($user) {
            // Determine the other participant (sender or recipient)
            return $message->sender_id == $user->id ? $message->recipient_id : $message->sender_id;
        });

        return Inertia::render('Messages/Index', [
            'conversations' => $conversations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        $message = new Message([
            'sender_id' => $user->id,
            'recipient_id' => $validated['recipient_id'],
            'content' => $validated['content'],
            'image' => $request->file('image') ? $request->file('image')->store('messages') : null
        ]);

        $message->save();

        return redirect()->route('messages.index');
    }

    public function storeListInquiry(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'content' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        $message = new Message([
            'sender_id' => $user->id,
            'recipient_id' => $validated['recipient_id'],
            'content' => $validated['content'],
        ]);

        $message->save();

        return redirect()->route('messages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($recipientId)
    {
        $user = Auth::user(); // Logged-in user

        // Retrieve messages between the logged-in user and the recipient
        $messages = Message::where(function ($query) use ($user, $recipientId) {
            $query->where('sender_id', $user->id)
                ->where('recipient_id', $recipientId);
        })->orWhere(function ($query) use ($user, $recipientId) {
            $query->where('sender_id', $recipientId)
                ->where('recipient_id', $user->id);
        })
            ->with(['sender', 'recipient']) // Include sender and recipient
            ->orderBy('created_at', 'asc') // Order by creation time
            ->get();

        // Get recipient details
        $recipient = User::findOrFail($recipientId);

        return Inertia::render('Messages/Conversation', [
            'messages' => $messages,
            'recipient' => $recipient,
        ]);
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
