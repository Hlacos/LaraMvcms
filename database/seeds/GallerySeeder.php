<?php

use Illuminate\Database\Seeder;
use Hlacos\LaraMvcms\Models\Gallery;

class GallerySeeder extends Seeder {

    public function run() {
        $root = Gallery::create(['title' => 'root', 'is_directory' => 1, 'parent_id' => null]);
    }

}
