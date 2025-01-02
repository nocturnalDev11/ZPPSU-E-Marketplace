<?php

namespace App\Http\Controllers\User\Lists;

use Inertia\Inertia;
use App\Models\Trade\Trade;
use Illuminate\Http\Request;
use App\Models\Trade\TradeRating;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TradeController extends Controller
{
    /**
     * Display a listing of the trade.
     */
    public function index()
    {
        $trades = Trade::all()->map(function ($trade) {
            $trade->trade_picture = $trade->trade_picture ? Storage::url($trade->trade_picture) : null;
            return $trade;
        });

        return Inertia::render('User/Lists/Trades/Index', [
            'trades' => $trades,
        ]);
    }

    /**
     * Store a newly created trade in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'trade_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'trade_title' => 'required|string|max:255',
            'trade_category' => 'required|string',
            'trade_description' => 'required|string|max:65535',
            'trade_status' => 'required|string',
            'trade_type' => 'required|string',
            'trade_value' => 'required|numeric',
            'trade_conditions' => 'required|string|max:65535',
            'trade_duration' => 'required|date',
        ]);

        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('trade_picture')) {
            $path = $request->file('trade_picture')->store('trade_pictures', 'public');
            $validatedData['trade_picture'] = $path;
        }

        Trade::create($validatedData);

        return redirect()->route('trades.index')->with('success', 'Trade created successfully!');
    }

    public function rate(Request $request)
    {
        $request->validate([
            'rating_value' => 'required|numeric|min:1|max:5',
            'rating_text' => 'nullable|string',
            'trades_id' => 'required|exists:trades,id',
            'parent_id' => 'nullable|exists:ratings,id',
        ]);

        TradeRating::create([
            'user_id' => Auth::id(),
            'trades_id' => $request->trades_id,
            'parent_id' => $request->parent_id,
            'rating_value' => $request->rating_value,
            'rating_text' => $request->rating_text,
        ]);

        return back()->with('success', 'Rating added successfully.');
    }

    public function reply(Request $request)
    {
        $request->validate([
            'rating_text' => 'nullable|string',
            'trades_id' => 'required|exists:trades,id',
            'parent_id' => 'nullable|exists:ratings,id',
        ]);

        TradeRating::create([
            'user_id' => Auth::id(),
            'trades_id' => $request->trades_id,
            'parent_id' => $request->parent_id,
            'rating_text' => $request->rating_text,
        ]);

        return back()->with('success', 'Reply added successfully.');
    }

    /**
     * Display the specified trade.
     */
    public function show(string $id)
    {
        $trade = Trade::with(['user', 'ratings.user'])->findOrFail($id);

        $trade->trade_picture = $trade->trade_picture ? Storage::url($trade->trade_picture) : null;

        $ratings = $trade->ratings()
                    ->whereNull('parent_id')
                    ->with('replies.user')
                    ->latest()
                    ->get();

        $relatedTrades = Trade::where('trade_category', $trade->trade_category)
                            ->where('id', '!=', $id)
                            ->take(5)
                            ->get()
                            ->map(function ($relatedTrade) {
                                $relatedTrade->trade_picture = $relatedTrade->trade_picture ? Storage::url($relatedTrade->trade_picture) : null;
                                return $relatedTrade;
                            });

        return Inertia::render('User/Lists/Trades/Show', [
            'user' => Auth::user(),
            'user_id' => Auth::id(),
            'trade' => $trade,
            'ratings' => $ratings,
            'relatedTrades' => $relatedTrades,
        ]);
    }

    /**
     * Show the form for editing the specified trades.
     */
    public function edit(string $id)
    {
        $trade = Trade::find($id);

        if (!$trade || $trade->user_id !== Auth::id()) {
            return redirect()->route('trades.index')->with('error', 'Trade not found or unauthorized.');
        }

        $trade->trade_picture = $trade->trade_picture ? Storage::url($trade->trade_picture) : null;

        return Inertia::render('User/Lists/Trades/Edit', [
            'trade' => $trade,
        ]);
    }

    /**
     * Update the specified trade in storage.
     */
    public function update(Request $request, string $id)
    {
        $trade = Trade::findOrFail($id);

        if (Auth::id() !== $trade->user_id) {
            return redirect()->route('trades.index')->with('error', 'You are not authorized to update this trading.');
        }

        $validatedData = $request->validate([
            'trade_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'trade_title' => 'required|string|max:255',
            'trade_category' => 'required|string',
            'trade_description' => 'required|string|max:65535',
            'trade_status' => 'required|string',
            'trade_type' => 'required|string',
            'trade_value' => 'required|numeric',
            'trade_conditions' => 'required|string|max:65535',
            'trade_duration' => 'required|date',
        ]);

        $trade_picture = $trade->trade_picture;

        if ($request->hasFile('trade_picture')) {
            Storage::delete('public/' . $trade->trade_picture);
            $trade_picture = $request->file('trade_picture')->store('trade_pictures', 'public');
        }

        $trade->update(array_merge($validatedData, [
            'trade_picture' => $trade_picture,
        ]));

        return redirect()->route('trades.show', $trade->id)
            ->with('success', 'Trade updated successfully!');
    }

    /**
     * Remove the specified trade from storage.
     */
    public function destroy(string $id)
    {
        $trade = Trade::findOrFail($id);

        if (Auth::id() !== $trade->user_id) {
            return redirect()->route('trades.index')->with('error', 'Unauthorized access.');
        }

        if ($trade->trade_picture) {
            Storage::disk('public')->delete('public/' . $trade->trade_picture);
        }

        $trade->delete();

        return redirect()->route('trades.index')->with('success', 'Trades deleted successfully.');
    }
}
