<?php

namespace App\Models\Trade;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TradeRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trades_id',
        'parent_id',
        'rating_text',
        'rating_value'
    ];

    public function trade(): BelongsTo
    {
        return $this->belongsTo(Trade::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(TradeRating::class, 'parent_id')->with('replies');
    }
}
