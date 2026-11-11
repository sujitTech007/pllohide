<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'image',
    ];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Each comment belongs to a post (optional)
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
