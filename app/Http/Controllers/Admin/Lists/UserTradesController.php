<?php

namespace App\Http\Controllers\Admin\Lists;

use Inertia\Inertia;
use App\Models\Trade\Trade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserTradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trades = Trade::with('user')->get();

        foreach ($trades as $trade) {
            $trade->trade_picture = $trade->trade_picture ? Storage::url($trade->trade_picture) : null;
        }

        return Inertia::render('Admin/Lists/Trades/TradeTable', [
            'user' => Auth::user(),
            'trades' => $trades,
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
        $trade = Trade::findOrFail($id);

        if ($trade->trade_picture) {
            Storage::disk('public')->delete($trade->trade_picture);
        }

        $trade->delete();

        return redirect()->route('user-trade.index')->with('success', 'Product deleted successfully.');
    }
}
