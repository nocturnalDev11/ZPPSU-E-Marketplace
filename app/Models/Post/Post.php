<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_picture',
        'post_title',
        'post_list_type',
        'post_category',
        'post_status',
        'post_content',
        'edited_at',
    ];

    /**
     * Define the relationship to comments.
     * One Post has many Comments.
     */
    public function comments()
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }

    /**
     * Define the relationship to the User (if applicable).
     * One Post belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
