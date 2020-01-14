<?php


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

