<?php

namespace App\Http\Controllers\Lists;

use Inertia\Inertia;
use App\Models\Trade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TradeController extends Controller
{
    /**
     * Display a listing of the trades.
     */
    public function index()
    {
        $isAuthorized = Auth::check();

        $trades = Trade::all()->map(function ($trade) {
            $trade->trade_picture = $trade->trade_picture ? Storage::url($trade->trade_picture) : null;
            return $trade;
        });

        return Inertia::render('Lists/Trades/Index', [
            'trades' => $trades,
            'isAuthorized' => $isAuthorized,
        ]);
    }

    /**
     * Store a newly created resource in trades.
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

    /**
     * Display the specified trades.
     */
    public function show(string $id)
    {
        $isAuthorized = Auth::check();

        $trade = Trade::with('user')->find($id);
        $trade->trade_picture = $trade->trade_picture ? Storage::url($trade->trade_picture) : null;

        $relatedTrades = Trade::where('trade_category', $trade->trade_category)
            ->where('id', '!=', $id)
            ->take(5)
            ->get();

        $relatedTrades = $relatedTrades->map(function ($relatedTrade) {
            $relatedTrade->trade_picture = $relatedTrade->trade_picture ? Storage::url($relatedTrade->trade_picture) : null;
            return $relatedTrade;
        });

        return Inertia::render('Lists/Trades/Show', [
            'user' => Auth::user(),
            'trade' => $trade,
            'relatedTrades' => $relatedTrades,
            'isAuthorized' => $isAuthorized
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

        return Inertia::render('Lists/Trades/Edit', [
            'trade' => $trade,
        ]);
    }

    /**
     * Update the specified trades in storage.
     */
    public function update(Request $request, string $id)
    {
        $trade = Trade::findOrFail($id);

        if (Auth::id() !== $trade->user_id) {
            return redirect()->route('trades.index')->with('error', 'You are not authorized to update this trading.');
        }

        $validatedData = $request->validate([
            // 'trade_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'trade_title' => 'required|string|max:255',
            'trade_category' => 'required|string',
            'trade_description' => 'required|string|max:65535',
            'trade_status' => 'required|string',
            'trade_type' => 'required|string',
            'trade_value' => 'required|numeric',
            'trade_conditions' => 'required|string|max:65535',
            'trade_duration' => 'required|date',
        ]);

        $trade->update($validatedData);

        return redirect()->route('trades.show', $trade->id)
            ->with('success', 'Trade updated successfully!');
    }

    /**
     * Remove the specified trades from storage.
     */
    public function destroy(string $id)
    {
        $trade = Trade::findOrFail($id);

        if (Auth::id() !== $trade->user_id) {
            return redirect()->route('trades.index')->with('error', 'Unauthorized access.');
        }

        if ($trade->trade_picture) {
            Storage::disk('public')->delete($trade->trade_picture);
        }

        $trade->delete();

        return redirect()->route('trades.index')->with('success', 'Trades deleted successfully.');
    }
}
