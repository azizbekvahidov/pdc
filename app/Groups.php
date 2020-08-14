<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    public function course() {
        return $this->hasOne(Courses::class,'id','course_id');
    }

    public function students() {
        return $this->belongsToMany(User::class,'groups_students','group_id','user_id');
    }
}
