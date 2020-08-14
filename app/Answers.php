<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    public function question(){
        return $this->hasOne(Questions::class, 'id', 'question_id');
    }

    public function answer($id){
        return $id;
    }

}
