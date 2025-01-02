<?php

namespace App\Models\Trade;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trade_picture',
        'trade_title',
        'trade_category',
        'trade_description',
        'trade_status',
        'trade_type',
        'trade_value',
        'trade_conditions',
        'trade_duration',
        'edited_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(TradeRating::class, 'trades_id');
    }
}
