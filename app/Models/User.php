<?php

namespace App\Models;

use App\Events\ModelCreated;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //notifier just a l'inscription d'un user
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'valid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //un user a plusieurs posts

    public  function posts()
    {
        return $this->hasMany(Post::class);
    }

    //un user a plusieurs commentaires
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //Pour savoir si un user est admin
    public  function  isAdmin()
    {
        return $this->role === 'admin';
    }
}
