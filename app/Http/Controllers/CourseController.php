<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Http\Requests\CourseValidation;
use BeyondCode\Comments\Traits\HasComments;
use Illuminate\Support\Facades\Storage;
use DB;

class CourseController extends Controller
{
    use HasComments;
    
    function index() 
    {
        $coursesinfo = DB::table('courses')
        ->join('users','users.id','=','courses.teacher_id') 
        
        ->select('users.name as teacher_name','courses.name as course_name','courses.price','courses.start_at','courses.end_at','courses.id')->get();
        
       
        return view('Courses.index',[
            'Courses' => $coursesinfo
        ]);
    }

    function create() 
    {
       // $teachers = DB::table('users')->where('roles', '=', 'teacher')->get();
       // dd($teachers);
        return view('Courses.create',['teachers'=> DB::table('users')->where('roles', '=', 'teacher')->get()]);
    }

    function store(CourseValidation $request)
    {
        
        $course = new Course;
        $course->name = $request->name;
        $course->price = $request->price*100;
        
        $image='';
        if(request()->image){
            $image =  Storage::putfile('images', $request->file('image'));
            $request->image->move(public_path('images'), $image);
        } 

        $course->cover_image = $image;
        
        $course->start_at = request()->start_at;
        $course->end_at = request()->end_at;

        $course->teacher_id = request()->teacher;
        $teacher = DB::table('users')->where('id', '=', request()->teacher)->first();  
      
        $course->save();
        $coursesinfo = DB::table('courses')
        ->join('users','users.id','=','courses.teacher_id') 

        ->select('users.name as teacher_name','courses.name as course_name','courses.price','courses.start_at','courses.end_at','courses.id')->get();
        
        return redirect()->route('courses.index');
    }

    function show($course)
    {
        $aaaa = Course::find($course);
        $array1 = array ("aaaa"=> $aaaa);
        return view ("Courses.view",$array1);    
    }

    function edit($course)
    {
        $aabb = Course::find($course);
        $array2 = array ("aabb"=> $aabb);
        return view("Courses.edit", $array2);
    }

    function update($id)
    {
        $data = Course::find($id);
        $data->name = request()->name;
        $image='';
        $image = request()->cover_images;
        
        if(request()->image){
            $image =  Storage::putfile('images', request()->file('image'));
            request()->image->move(public_path('images'), $image);
        } 

        $data->cover_image = $image;
        $data->price= request()->price*100;
        $data->start_at= request()->start_at;
        $data->end_at= request()->end_at;
        $data->save();

        $coursesinfo = DB::table('courses')
        ->join('users','users.id','=','courses.teacher_id') 

        ->select('users.name as teacher_name','courses.name as course_name','courses.price','courses.start_at','courses.end_at','courses.id')->get();
        return redirect()->route('courses.index');

    }

    function destroy($course)
    {
        $delaa = Course::find($course);
        $delaa->delete();
        return redirect()->route('courses.index');
    }

}
