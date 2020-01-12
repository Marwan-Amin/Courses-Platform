<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'cover_image', 'price', 'start_at','end_at',
    ];
}
