<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function charts()
    {
        
        return view('charts' , [
            'males' =>  DB::table('users')->where('gender', '=', 'male')->get() ,
            'females' =>  DB::table('users')->where('gender', '=', 'female')->get() ,
            ]);
    }
}
