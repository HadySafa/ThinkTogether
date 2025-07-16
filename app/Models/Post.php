<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Eloquent Relationships
    public function user()
    {
        return $this->belongsTo(User::class); // author
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
