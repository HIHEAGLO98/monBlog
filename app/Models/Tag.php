<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag',
        'slug',

    ];
    public $timestamps = false;

    //un tag a plusieurs posts
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
