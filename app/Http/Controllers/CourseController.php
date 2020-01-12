<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Http\Requests\CourseValidation;
use Illuminate\Support\Facades\Storage;


class CourseController extends Controller
{
    function index() 
    {
        return view('Courses.index',[
            'Courses' => Course::all() 
        ]);
    }

    function create() 
    {
        return view('Courses.create');
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
        $course->save();
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

        return redirect()->route('courses.index');
    }

    function destroy($course)
    {
        $delaa = Course::find($course);
        $delaa->delete();
        return redirect()->route('courses.index');
    }

}
