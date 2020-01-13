<?php

<<<<<<< HEAD
=======

>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        $permissions = [
            'list-teachers',
            'create-teacher',
            'edit-teacher',
            'delete-teacher',
            'list-courses',
            'create-course',
            'edit-course',
            'delete-course',
            'list-supporters',
            'create-supporter',
            'edit-supporter',
            'delete-supporter',
            'list-students',
            'create-student',
            'edit-student',
            'delete-student',
            'comment-approvement',
            'can-comment',
        ];

        foreach($permissions as $permission)
        {
            Permission::create([
                'name' => $permission,
            ]);
        }
        

    }
}
=======
       $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'course-list',
           'course-create',
           'course-edit',
           'course-delete',
           'supporter-list',
           'supporter-create',
           'supporter-edit',
           'supporter-delete'
        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
