<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prod_picture',
        'prod_name',
        'prod_price',
        'prod_status',
        'prod_category',
        'prod_condition',
        'prod_description',
        'prod_quantity',
        'prod_payment_status',
        'edited_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
