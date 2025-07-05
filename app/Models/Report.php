<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
        protected $fillable=[
        'account_id',
        'animal_id', 
        'pet_name',
        'pet_age',
        'last_place',
        'pet_image',
        'description',
        'pet_state',
    ];
    public function account()
{
    return $this->belongsTo(\App\Models\Account::class, 'account_id');
}
public function animal()
{
    return $this->belongsTo(\App\Models\Animal::class, 'animal_id');
}
}
