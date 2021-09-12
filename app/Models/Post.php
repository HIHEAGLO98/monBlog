<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'seo_title',
        'excerpt',
        'body',
        'meta_description',
        'meta_keywords',
        'active',
        'image',
        'user_id',
    ];

    //un post appartient à un user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // un post a plusieurs categories
    public  function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    //un post a plusieurs tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //un post a plusieurs commentaires

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //récupérer les commentaires valides (en fait les commentaires qui ont été rédigés par un utilisateur validé) :
    public function validComments()
    {
        return $this->comments()->whereHas('user', function ($query) {
            $query->whereValid(true);
        });
    }
}
