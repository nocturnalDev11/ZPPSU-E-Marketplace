<?php

namespace App\Http\Controllers\User\Lists\Trades;

use Illuminate\Http\Request;
use App\Models\Trade\TradeRating;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TradeRatingController extends Controller
{
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

    public function destroy(string $id)
    {
        $rating = TradeRating::find($id);

        if (!$rating) {
            abort(404);
        }

        if ($rating->user_id !== Auth::id() && $rating->trade->user_id !== Auth::id()) {
            abort(403);
        }

        $rating->delete();

        return redirect()->back()->with('success', 'Rating deleted successfully.');
    }
}
