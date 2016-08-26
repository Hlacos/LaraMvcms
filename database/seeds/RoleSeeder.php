<?php

use Illuminate\Database\Seeder;
use Hlacos\LaraMvcms\Models\Role;
use Hlacos\LaraMvcms\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'administrator',
            'gb' => [
                'title' => 'Administrator',
                'description' => 'Can use administration menu'
            ]
        ]);

        $role->addPermissionByName('manage-permissions');
        $role->addPermissionByName('manage-roles');
        $role->addPermissionByName('manage-admin-users');

        $role->addPermissionByName('manage-pages');
        $role->addPermissionByName('manage-entries');
        $role->addPermissionByName('manage-galleries');

        /*$role->addPermissionByName('manage-categories');
        $role->addPermissionByName('manage-tags');
        $role->addPermissionByName('manage-posts');*/
    }
}
