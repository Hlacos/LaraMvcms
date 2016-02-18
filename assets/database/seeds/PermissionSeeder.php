<?php

use Illuminate\Database\Seeder;
use Hlacos\LaraMvcms\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create([
            'title' => 'manage-permissions',
            'gb' => [
                'title' => 'Manage permissions',
                'description' => 'Can manage permissions'
            ]
        ]);

        $permission = Permission::create([
            'title' => 'manage-roles',
            'gb' => [
                'title' => 'Manage roles',
                'description' => 'Can manage roles'
            ]
        ]);

        $permission = Permission::create([
            'title' => 'manage-admin-users',
            'gb' => [
                'title' => 'Manage admin users',
                'description' => 'Can manage admin users'
            ]
        ]);

        $permission = Permission::create([
            'title' => 'manage-pages',
            'gb' => [
                'title' => 'Manage pages',
                'description' => 'Can manage pages'
            ]
        ]);

        $permission = Permission::create([
            'title' => 'manage-enties',
            'gb' => [
                'title' => 'Manage entries',
                'description' => 'Can manage entries'
            ]
        ]);

        $permission = Permission::create([
            'title' => 'manage-galleries',
            'gb' => [
                'title' => 'Manage galeries',
                'description' => 'Can manage galleries'
            ]
        ]);
    }
}
