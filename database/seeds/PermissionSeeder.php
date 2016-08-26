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
            'name' => 'manage-permissions',
            'gb' => [
                'title' => 'Manage permissions',
                'description' => 'Can manage permissions'
            ]
        ]);

        $permission = Permission::create([
            'name' => 'manage-roles',
            'gb' => [
                'title' => 'Manage roles',
                'description' => 'Can manage roles'
            ]
        ]);

        $permission = Permission::create([
            'name' => 'manage-admin-users',
            'gb' => [
                'title' => 'Manage admin users',
                'description' => 'Can manage admin users'
            ]
        ]);

        $permission = Permission::create([
            'name' => 'manage-pages',
            'gb' => [
                'title' => 'Manage pages',
                'description' => 'Can manage pages'
            ]
        ]);

        $permission = Permission::create([
            'name' => 'manage-galleries',
            'gb' => [
                'title' => 'Manage galeries',
                'description' => 'Can manage galleries'
            ]
        ]);

        /*$permission = Permission::create([
            'name' => 'manage-categories',
            'gb' => [
                'title' => 'Manage categories',
                'description' => 'Can manage categories'
            ]
        ]);

        $permission = Permission::create([
            'name' => 'manage-tags',
            'gb' => [
                'title' => 'Manage tags',
                'description' => 'Can manage tags'
            ]
        ]);

        $permission = Permission::create([
            'name' => 'manage-posts',
            'gb' => [
                'title' => 'Manage posts',
                'description' => 'Can manage posts'
            ]
        ]);*/
    }
}
