<?php

<<<<<<< HEAD
use App\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


=======
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
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
    
=======
       
        $user = User::create([
            'Nid'=>'12345678',
        	'name' => 'Amr Samy', 
        	'email' => 'amr.saami@gmail.com',
            'password' => bcrypt('123456'),
            'email_verified_at'=>now()
        ]);
  
        $role = Role::create(['name' => 'Admin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
        $user->assignRole([$role->id]);
    }
}
