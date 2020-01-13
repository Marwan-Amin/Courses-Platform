<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use BeyondCode\Comments\Traits\HasComments;

class Course extends Model
{
    use HasComments;
    
    protected $fillable = [
        'name','cover_image','price','start_at','end_at'
    ];
}
