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
     * Display a listing of the resource.
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
        //
    }
}
