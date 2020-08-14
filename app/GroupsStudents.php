<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupsStudents extends Model
{
    protected $fillable = ["group_id", "user_id", "user_status"];

    public function groups() {
        return $this->hasMany(Groups::class, 'id','group_id');
    }
}
