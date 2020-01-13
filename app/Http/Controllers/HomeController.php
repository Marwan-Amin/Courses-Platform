<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD

=======
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
<<<<<<< HEAD
=======

>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
<<<<<<< HEAD
        return view('home');
    }
=======
        
        return view('home');
    }
    public function verify($token)
    {
        dd('almalk');
       $user = User::where('verify_token',$token)->first();
        if($user){
            if($user->verify == 0){
                dd($token);

                $user->verify = 1;
                $user->save();
                return redirect('home');
            }else if($user->verify == 1){
                echo "your email already verified";
            }else{
                return view('404');
            }
            
        }else{
            return view('404');
        }
    }
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
}
