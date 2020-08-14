<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'user_answer';

    protected $fillable = ['user_id', 'subject_id', 'start', 'end', 'created_at', 'updated_at'];

    public function user() {
        return $this->hasOne('App/User','id','user_id');
    }


    public function questions() {
        return $this->hasMany(SelectedQuestions::class,'user_answer_id','id');
    }
}
