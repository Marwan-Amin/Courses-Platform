<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class Teacher extends User
{
    protected $fillable = [
        'Nid','name', 'email', 'password', 'gender','roles','avatar',
    ];

    public function courses()
    {
        return $this->morphToMany('App\Course', 'student_teacher_course');
    }
    
}
