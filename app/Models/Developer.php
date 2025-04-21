<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // hii lazima iwe Authenticatable
use Illuminate\Notifications\Notifiable;

class Developer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username','email','password','api_key'
    ];

    protected $hidden = [
        'password','api_key','remember_token',
    ];

    // relations...
     public function users()
    {
        return $this->hasMany(User::class);
    }
}