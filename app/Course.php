<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'cover_image', 'price', 'start_at','end_at','teacher_id'
    ];

    public function teacher()
    {
        return $this->morphedByMany('App\Teacher', 'student_teacher_course');
    }

    public function student()
    {
        return $this->morphedByMany('App\Student', 'student_teacher_course');
    }

}
