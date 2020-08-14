<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login','name', 'surname', 'email', 'tel', 'password','role_id', 'teacher_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function answers() {
        return $this->hasMany('App\UserAnswer', 'user_id', 'id');
    }

    public function questions() {
        return $this->hasMany('App\Questions','user_id','id');
    }

    public function teachers() {
        return $this->belongsToMany(User::class, "teacher_students","student_id","teacher_id");
    }

    public function info() {
        return $this->hasOne(TeachersInfo::class,"user_id", "id");
    }

    public function group() {
        return $this->belongsToMany(Groups::class,"groups_students","user_id","group_id");
    }

    public function groupStatus() {
        return $this->hasMany(GroupsStudents::class,'user_id','id');
    }

}
