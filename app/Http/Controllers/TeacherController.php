<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request,$value)
    {
        if ($value=='supporter')
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
            'roles'=>'supporter',
            'avatar' => $image,
            ]);
            $role = Role::firstOrCreate(['name' => 'supporter']);
            $permissions = DB::table('permissions')
                            ->where('id','=',17)->get();
           // dd($permissions);
            $role->syncPermissions($permissions);
       
            $user->assignRole([$role->id]);
        return redirect()->route('admin.index',["value"=>"supporter"])
                        ->with('success','User created successfully');
    }
    public function create(Request $request)
    {
           return view('admin.create');
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
            $user->gender = $request->gender;
            $user->avatar = $image;
            $user->save();
    
            return redirect()->route('admin.index',["value"=>"supporter"]);
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
        return redirect()->route('admin.index',["value"=>"supporter"]);
        /*return view('admin.index')
                        ->with('success','User deleted successfully');*/
    }
}
