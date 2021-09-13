<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kalnoy\Nestedset\NodeTrait;
use App\Events\ModelCreated;
class Comment extends Model
{
    use NodeTrait, HasFactory, Notifiable;

    protected $fillable = [
        'body',
        'post_id',
        'user_id',
    ];

    //notifier just a l'ajout d'un commentaire
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    //un commentaire fait par  un seul user
    public  function  user()
    {
        return $this->belongsTo(User::class);
    }

    //un commentaire appartient à un post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
