<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Eloquent Relationships
    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    protected $fillable = ['name','post_id'];
    public $timestamps = false;
}
