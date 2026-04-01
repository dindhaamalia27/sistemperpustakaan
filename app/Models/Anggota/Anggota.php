<?php

namespace App\Models\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'anggota';

    public $timestamps = false; //

   protected $fillable = [
    'name',
    'email',
    'password',
    'role'
   ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
