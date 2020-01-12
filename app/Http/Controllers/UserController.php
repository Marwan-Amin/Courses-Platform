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
            'results' =>  DB::table('student_teacher_course')->select('student_id', DB::raw('count(*) as total'))->limit(3)->groupBy('student_id')->orderby('total', 'DESC')->get(),
            'join' => DB::table('users')
            ->join('student_teacher_course', 'users.id', '=', 'student_teacher_course.student_id')
            ->select('users.name')
            ->get()
            ]);
    }
}
