<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachersInfo extends Model
{
    protected $fillable = [
        'user_id',
        'info',
        'photo'
    ];

}
