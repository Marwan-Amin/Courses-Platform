<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function index(Request $request,$value)
    {
        //dd($value);
       if($value=='all')
       {
        $users = User::orderBy('created_at','DESC')->paginate(5);
        return view('admin.index',compact('users','value'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
       }
        else if ($value=='teacher')
        {
            $users = DB::table('users')->where('roles', '=', 'teacher')->paginate(5);
            return view('admin.index',compact('users','value'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
        }
        else if ($value=='supporter')
        {
            return view('admin.index', [
                'users' => DB::table('users')->where('roles', '=', 'supporter')->paginate(5),'value'=>$value
            ])->with('i', ($request->input('page', 1) - 1) * 5);
        }
        else if ($value=='student')
        {
            return view('admin.index', [
                'users' => DB::table('users')->where('roles', '=', 'student')->paginate(5),'value'=>$value
            ])->with('i', ($request->input('page', 1) - 1) * 5);
        }
        else if ($value=='admin')
        {
            return view('admin.index', [
                'users' => DB::table('users')->where('roles', '=', 'admin')->paginate(5),'value'=>$value
            ])->with('i', ($request->input('page', 1) - 1) * 5);
        }
            
    }
        /**
     * Store a newly created resource in storage.123456789123456789
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = '';
        if(request()->avatar)
        {
            $image = Storage::putfile('images',$request->file('avatar'));
            $request->avatar->move(public_path('images'),$image);
        }
        $user = User::create([
            'Nid'=>$request->Nid,
        	'name' => $request->name, 
        	'email' => $request->email,
            'password' => $request->password,
            'gender'=>$request->gender,
            'roles'=>$request->role,
            'birth_date'=>$request->birth,
            'avatar' => $image,
            ]);
            $role = Role::firstOrCreate(['name' => $request->role]);
            $range_id = $request->role=="teacher"?[5,13]:[17,17];
            $permissions = DB::table('permissions')
                            ->whereBetween('id',$range_id)->get();
           // dd($permissions);
            $role->syncPermissions($permissions);
       
            $user->assignRole([$role->id]);
        return redirect()->route('admin.index',["value"=>"all"])
                        ->with('success','User created successfully');
    }
    public function create_user(Request $request)
    {
           return view('admin.create_user');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        //dd($user);
        return view('admin.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        //$roles = Role::pluck('name','name')->all();
        //$userRole = $user->roles->pluck('name','name')->all();


        return view('admin.edit',compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image = '';
        $image = request()->avatar;
        if(request()->avatar)
        {
            $image = Storage::putfile('images',$request->file('avatar'));
            $request->avatar->move(public_path('images'),$image);
        }
            $user=User::findOrFail($id);
            $user->Nid = $request->Nid;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->roles = $request->role;
            $user->gender = $request->gender;
            $user->avatar = $image;
            $user->save();

            $role = Role::firstOrCreate(['name' => $request->role]);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->removeRole($role->id);
            
            $range_id = $request->role=="teacher"?[5,13]:[17,17];
            $permissions = DB::table('permissions')
                            ->whereBetween('id',$range_id)->get();
           // dd($permissions);
            $role->syncPermissions($permissions);
       
            $user->assignRole([$role->id]);
    
            return redirect()->route('admin.index',["value"=>"all"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = 'all';
        User::find($id)->delete();
        return redirect()->route('admin.index',["value"=>"all"]);
    }
    

    public function supp()
    {
       // $supporters = DB::table('users')->where('roles', '=', 'supporter')->get();
        //$courses = DB::table('courses')->get();
        dd(DB::table('users')->where('roles', '=', 'supporter')->get()); 
        return view('admin.supp',
           ['supporters'=> DB::table('users')->where('roles', '=', 'supporter')->get()],
           ['courses'=>DB::table('courses')->get() ]);
    }
}
