<?php

<<<<<<< HEAD
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Http\Requests\CourseValidation;
use Illuminate\Support\Facades\Storage;
use DB;

class CourseController extends Controller
{
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
        // dd($aabb);
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
        // $data->save();

        $coursesinfo = DB::table('courses')
        ->join('users','users.id','=','courses.teacher_id') 

        ->select('users.name as teacher_name','courses.name as course_name','courses.price','courses.start_at','courses.end_at','courses.id')->get();
        dd($coursesinfo);
        return redirect()->route('courses.index');

    }

    function destroy($course)
    {
        $delaa = Course::find($course);
        $delaa->delete();
        return redirect()->route('courses.index');
    }

}
=======


namespace App\Http\Controllers;


use App\Course;
use Illuminate\Http\Request;


class CourseController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:course-list|course-create|course-edit|course-delete', ['only' => ['index','show']]);
         $this->middleware('permission:course-create', ['only' => ['create','store']]);
         $this->middleware('permission:course-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:course-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('adafdadf');
        
        $courses = Course::latest()->paginate(5);
        return view('courses.index',compact('courses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);


        Course::create($request->all());


        return redirect()->route('course.index')
                        ->with('success','Course created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('courses.show',compact('course'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit',compact('course'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);


        $course->update($request->all());


        return redirect()->route('courses.index')
                        ->with('success','course updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();


        return redirect()->route('courses.index')
                        ->with('success','course deleted successfully');
    }
}
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
