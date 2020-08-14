<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{

    protected $fillable = ['name', 'description', 'files', 'url', 'subject_id', 'status', 'screen'];

    public function subject() {
        return $this->hasOne(Subjects::class, 'id', 'subject_id');
    }
}
