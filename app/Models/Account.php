<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $fillable=[
        'username',
        'password', 
        'email',
        'phone_number',
        'profile_picture',
    ];
}
