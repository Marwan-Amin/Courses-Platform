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
use Carbon\Carbon;
use App\Http\Requests\StudentApiValidation;
use App\Notifications\GreetStudent;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StudentCardenalityController extends Controller
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
            'roles' => 'student',
            'last_login'=>Carbon::now()
        ]); 
        $token = JWTAuth::fromUser($user);
        Mail::to($user->email)->send(new MailtrapSending($user));
        $role = Role::firstOrCreate(['name' => 'student']);
    $permissions = DB::table('permissions')->where('name','list-courses')->get();

    $role->syncPermissions($permissions);
    $user->assignRole([$role->id]);

        return response()->json(compact('user','token'),201);
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
        $lastLogin = User::find(auth()->user()->id);
        $lastLogin->last_login = now();
        $lastLogin->save();
        return $this->respondWithToken($token,auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
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


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh(),auth()->user());
    }

}
