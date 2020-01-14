<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function charts()
    {    
    $userCourses = User::all();
    $studentId = [];
    foreach($userCourses as $user){
        $studentId [] = $user->id;
    }

    $numberCourses = [];
    $userName=[];
    for ($i=0 ; $i < count($studentId) ;$i++){

        $name=(User::find($studentId[$i]))->name;
        $total = count(DB::table('course_user')->where('user_id', '=', $studentId[$i])->get());
        $top_enrolled[] =  [ $name  => $total  ] ;
    }
    krsort($top_enrolled);
    $top_enrolled = array_slice($top_enrolled, 0, 10);
    return view('charts', [
        'males' =>  DB::table('users')->where('gender', '=', 'male')->where('roles', '=', 'student')->get() ,
         'females' =>  DB::table('users')->where('gender', '=', 'female')->where('roles', '=', 'student')->get() ,
         'top_enrolled' => $top_enrolled, 
    ]);
    
}
}