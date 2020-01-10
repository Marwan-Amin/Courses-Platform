<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminController extends Controller
{
    public function index(Request $request)
    {
       $data = User::orderBy('created_at','DESC')->paginate(5);
        return view('admin.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'Nid'=>$request->Nid,
        	'name' => $request->name, 
        	'email' => $request->email,
            'password' => $request->password,
            'gender'=>$request->gender,
            'roles'=>$request->role,
            ]);
            $role = Role::firstOrCreate(['name' => $request->role]);
   
            $permissions = DB::table('permissions')
                            ->whereBetween('id',[5,13])->get();
           // dd($permissions);
            $role->syncPermissions($permissions);
       
            $user->assignRole([$role->id]);
        return redirect()->route('admin.index')
                        ->with('success','User created successfully');
    }
    
}
