<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddRootCategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \Kaban\Models\Category::create( [
            'title'      => 'همه',
            'slug'       => 'همه',
            'author_id'  => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status'     => \Kaban\General\Enums\EPostStatus::approved,
        ] );
    }
}
