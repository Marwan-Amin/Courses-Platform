<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    public function courses()
    {
        return $this->morphToMany('App\Course', 'student_teacher_course');
    }

    
}
