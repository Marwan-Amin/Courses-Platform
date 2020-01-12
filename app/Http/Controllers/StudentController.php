<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Mail\MailtrapSending;
use Mail;
use DB;
use App\Http\Requests\StudentApiValidation;
use App\Notifications\GreetStudent;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StudentController extends Controller
{
    

    public function register(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'Nid'=>'required|unique:users'
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }
        
        $user = User::create([
            'Nid' => $request->get('Nid'),

            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'verify_token'=>Str::random(32),
            'roles' => 'student'
        ]); 
        $token = JWTAuth::fromUser($user);
        Mail::to($user->email)->send(new MailtrapSending($user));
        $role = Role::firstOrCreate(['name' => 'student']);
    $permissions = DB::table('permissions')->where('name','list-courses')->get();

    $role->syncPermissions($permissions);
    $user->assignRole([$role->id]);

        return response()->json(compact('user','token'),201);
    }

    
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
      dd('aa');
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
       }
    


    public function __construct()
    {
    }

  
    
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        $user =  User::where('email', $request->email)->get();

            if($user[0]->email_verified_at == null){
                return response()->json(['Unauthenticated' => 'verify your email first'], 400);
            }
        
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token,auth()->user());
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

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh(),auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token,$user)
    {
        return response()->json([
            'user'=>$user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
