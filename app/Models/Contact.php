<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\ModelCreated;
class Contact extends Model
{
    use HasFactory, Notifiable;

    protected  $fillable = [
        'name',
        'email',
        'message',
    ];
    //notifier just a l'ajout  d'un contact
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    //Get user of the Contact
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
