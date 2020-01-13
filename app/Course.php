<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use BeyondCode\Comments\Traits\HasComments;


class Course extends Model
{
    use HasComments;

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
