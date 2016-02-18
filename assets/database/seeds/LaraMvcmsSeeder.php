<?php

use Illuminate\Database\Seeder;

class LaraMvcmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(GallerySeeder::class);
    }
}
