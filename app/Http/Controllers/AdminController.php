<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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

            return view('admin.index', [
                'users' => DB::table('users')->where('roles', '=', 'teacher')->get(),'value'=>$value
            ])->with('i', ($request->input('page', 1) - 1) * 5);
        }
        else if ($value=='supporter')
        {

            return view('admin.index', [
                'users' => DB::table('users')->where('roles', '=', 'supporter')->get(),'value'=>$value
            ])->with('i', ($request->input('page', 1) - 1) * 5);
        }
        else if ($value=='student')
        {

            return view('admin.index', [
                'users' => DB::table('users')->where('roles', '=', 'student')->get(),'value'=>$value
            ])->with('i', ($request->input('page', 1) - 1) * 5);
        }
        else if ($value=='admin')
        {

            return view('admin.index', [
                'users' => DB::table('users')->where('roles', '=', 'admin')->get(),'value'=>$value
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
        $user = User::create([
            'Nid'=>$request->Nid,
        	'name' => $request->name, 
        	'email' => $request->email,
            'password' => $request->password,
            'gender'=>$request->gender,
            'roles'=>$request->role,
            ]);
            $role = Role::firstOrCreate(['name' => $request->role]);
            $range_id = $request->role=="teacher"?[5,13]:[17,17];
            $permissions = DB::table('permissions')
                            ->whereBetween('id',$range_id)->get();
           // dd($permissions);
            $role->syncPermissions($permissions);
       
            $user->assignRole([$role->id]);
        return redirect()->route('admin.index')
                        ->with('success','User created successfully');
    }
    public function create_user(Request $request)
    {
           return view('admin.create_user');
    }
    
    public function view_teacher(Request $request)
    {
           return view('admin.view_teacher', [
                'users' => DB::table('users')->where('roles', '=', 'teacher')->get()
            ]);
    }
    
    ///////////////////////////////////////////////////////////////
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
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
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();


        return view('users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
    
}
