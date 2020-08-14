<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $fillable = ['name', 'description', 'subject_id'];

    public function groups() {
        return $this->hasMany(Groups::class,'course_id','id');
    }
}
