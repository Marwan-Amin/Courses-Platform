<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Carbon;

class CreateAdminUserSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'Nid'=>'123456789',
        	'name' => 'salma', 
        	'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'gender'=>'female',
            'roles'=>'Admin',
            'email_verified_at'=>now(),
            'avatar'=>'image',

        ]);
  
        $role = Role::create(['name' => 'Admin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);
    }
}
