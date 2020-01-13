<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Course extends Model
{
    protected $fillable = [
        'name', 'cover_image', 'price', 'start_at' , 'end_at'
    ];

    public function user(){
        return $this->belongsToMany('App\User','course_user' , 'couser_id' , 'user_id');
    }
}
