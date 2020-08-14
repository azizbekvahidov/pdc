<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'subject';

    protected $fillable = ['subject'];

    public function questions() {
        return $this->hasMany(Questions::class,'subject_id','id');
    }

    public function themes() {
        return $this->hasMany(Themes::class, 'subject_id', 'id');
    }
}
