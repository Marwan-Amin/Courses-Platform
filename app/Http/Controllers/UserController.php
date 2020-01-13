<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function charts()
    {
    
        
    //     $userCourses = User::all();
    // dd($userCourses[1]->course) ;
        return view('charts' , [
            'males' =>  DB::table('users')->where('gender', '=', 'male')->where('roles', '=', 'student')->get() ,
            'females' =>  DB::table('users')->where('gender', '=', 'female')->where('roles', '=', 'student')->get() ,
            'results' =>  DB::table('users')->select('name', DB::raw('count(*) as total'))->limit(3)->groupBy('id')->orderby('total', 'DESC')->get(),
           
    }
}
