<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
<<<<<<< HEAD
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

=======
use Illuminate\Support\Str;
use App\Mail\MailtrapSending;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
use DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
<<<<<<< HEAD
        $this->middleware('guest');
=======
        $this->middleware('auth ');
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
<<<<<<< HEAD
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
=======
        
        return Validator::make($data, [
            'Nid'=>['required','min:8','max:8','unique:users'],
            
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
<<<<<<< HEAD
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
=======
        Validator::make($data, [
            'Nid'=>['required','min:8','max:8','unique:users'],
            
        ]);
        $user =  User::create([
            'Nid' =>$data['Nid'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'verify_token'=>Str::random(32),
            'gender'=>$data['gender'],
            'roles'=>$data['role'],
            'last_login'=> Carbon::now()

        ]);
        Mail::to($user->email)->send(new MailtrapSending($user));
        $role = Role::firstOrCreate(['name' => $data['role']]);
            $permossion_ids=$data['role'] == 'teacher'?[5,13]:[18,18];
        $permissions = DB::table('permissions')->whereBetween('id',$permossion_ids)->get();
  
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        return $user;
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
    }
}
