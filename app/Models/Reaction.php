<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    // Eloquent Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    protected $fillable = ['reaction', 'post_id', 'user_id'];
    public $timestamps = false;
}
