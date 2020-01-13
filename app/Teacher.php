<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends User
{
    protected $fillable = [
        'Nid','name', 'email', 'password', 'gender','roles','avatar',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
