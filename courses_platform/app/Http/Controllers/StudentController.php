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
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user =  DB::table('users')->where('email',$request->email)->first();
        try {
            if($user->email_verified_at == null){
                return response()->json(['Unauthenticated' => 'verify your email first'], 400);
            }
            else if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('user','token'));
    }

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


        return response()->json(compact('user','token'),201);
    }

    public function getAuthenticatedUser()
        {
                try {

                        if (! $user = JWTAuth::parseToken()->authenticate()) {
                                return response()->json(['user_not_found'], 404);
                        }

                } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                        return response()->json(['token_expired'], $e->getStatusCode());

                } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                        return response()->json(['token_invalid'], $e->getStatusCode());

                } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                        return response()->json(['token_absent'], $e->getStatusCode());

                }

                return response()->json(compact('user'));
        }
        public function verify($token){
            $user = User::where('verify_token',$token)->first();
            if($user){
                if($user->email_verified_at == null){
    
                    $user->email_verified_at = now();
                    $user->save();
                    return response()->json(['verified'=>'your email has been verified']);
                }else if($user->email_verified_at != null){
                    return response()->json(['verified'=>'your email has already verified']);
                }
            }else{
                return response()->json(['404'=>'Not Found']);
            }
        }
}
