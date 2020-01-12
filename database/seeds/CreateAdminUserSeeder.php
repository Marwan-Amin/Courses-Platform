<?php

use App\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


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
            'Nid' => 'qwqw1122',
        	'name' => 'Marwan Amin Mohamed', 
        	'email' => 'marwanadmin@gmail.com',
            'password' => bcrypt('123456'),
            'gender' => 'male',
            'avatar' => '',
            'roles' => 'admin'
        ]);
  
        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::whereBetween('id',[1,4])->get();
  
        $role->syncPermissions($permissions);
    
        $user->assignRole([$role->id]);
    }
}
