<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    public function answers() {
        return $this->hasMany(Answers::class,'question_id', 'id');
    }

    public function subject() {
        return $this->hasOne(Subjects::class,'id','subject_id');
    }

    public function user() {
        return $this->hasOne(User::class,'id','user_id');
    }
}
