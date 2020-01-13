<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supporter extends User
{
    protected $fillable = [
        'Nid','name', 'email', 'password', 'gender','roles','avatar',
    ];

}
