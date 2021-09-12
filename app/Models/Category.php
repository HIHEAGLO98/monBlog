<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
    ];
    public $timestamps = false;

    //une categorie a plusieurs posts
    public  function  posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
