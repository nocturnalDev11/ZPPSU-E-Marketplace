<?php

namespace App\Models\Service;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'services_picture',
        'services_title',
        'services_status',
        'services_fee',
        'services_category',
        'services_description',
        'avg_rating',
        'edited_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(ServiceRating::class, 'services_id');
    }
}
