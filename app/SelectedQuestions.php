<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectedQuestions extends Model
{
    protected $fillable = ['selected_questions_id', 'answer_id'];

    public function question() {
        return $this->hasOne(Questions::class,'id','question_id');
    }

    public function userAnswer() {
        return $this->hasOne(UserAnswer::class, 'id','user_answer_id');
    }
}
