<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
      'developer_id','phone','status','uid',
      'remaining_days','email','password','username'
    ];
    protected $hidden = ['password'];
}
