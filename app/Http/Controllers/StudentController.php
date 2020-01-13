<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Http\Requests\StudentApiValidation;
use App\Notifications\GreetStudent;
use Carbon;

class StudentController extends Controller
{

        public function verify($token){
            $user = User::where('verify_token',$token)->first();
            if($user){
                if($user->email_verified_at == null){
    
                    $user->email_verified_at = now();
                    $user->save();
                    $user->notify(new GreetStudent);
                    return response()->json(['verified'=>'your email has been verified']);
                }else if($user->email_verified_at != null){
                    return response()->json(['verified'=>'your email has already verified']);
                }
            }else{
                return response()->json(['404'=>'Not Found']);
            }
        }

       public function edit(StudentApiValidation $request,$id){
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        return response()->json(compact('user'));

       }

       public function enroll($courseId){
           $student = User::find(auth()->user()->id);
           
           
        
            $teacher_supporter_course = DB::table('teacher_supporter_course')->where('course_id',$courseId)->first();
            DB::table('student_teacher_course')->insert(
                ['student_id' => auth()->user()->id, 'teacher_id' => $teacher_supporter_course->teacher_id,'course_id' =>$courseId]
            );
        }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticatedUser()
    {
        return response()->json(auth()->user());
    }

    public function comment($courseId)
    {
        if(auth()->user()){
            $course = Course::find($courseId); 
            if($course){
                    $course->comment(request()->body);
                
                return response()->json(['message'=>'Your Comment has been Listed To Be Approved']);
 
            }else{
                return response()->json(['message'=>'This Course not exist']);

            }
        }else{
            return response()->json(['Time out'=>'Token Has Been Expired Please Relogin']);

        }
        
        
        
    }


    public function listCourses(){
        $StudentInfo = [];
            if(auth()->user()){
                $courses_student =  DB::table('users')
                ->join('student_teacher_course', 'users.id', '=', 'student_teacher_course.student_id')
               ->join('courses', 'courses.id', '=', 'student_teacher_course.course_id')
                ->where('student_teacher_course.student_id','=',auth()->user()->id)
            ->select('courses.name as course','courses.start_at','courses.end_at','courses.price','users.name as student','student_teacher_course.teacher_id as teacher_id','student_teacher_course.course_id as course_id')
                ->get();
                
                foreach($courses_student as $courseInfo){
                    $teacher = User::where('id',$courseInfo->teacher_id)->get();  
                    $course = Course::find($courseInfo->course_id);
                    foreach($course->comments as $comment){
                        $StudentInfo[] = ['Course Info'=>$courseInfo,'Teacher Info'=>$teacher,'course comment'=>$comment->comment];

                    }
               
                }
                return response()->json(['Student Infos' => $StudentInfo]);

                }else{
                    return response()->json(['Time out'=>'Token Has Been Expired Please Relogin']);
    
                }
            }
           
    }


