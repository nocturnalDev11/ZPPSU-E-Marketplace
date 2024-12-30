<?php

namespace App\Models\Service;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'services_id',
        'parent_id',
        'rating_text',
        'rating_value'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ServiceRating::class, 'parent_id')->with('replies');
    }
}
