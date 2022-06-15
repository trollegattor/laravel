<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Category::factory()->count(3)->create();
    }
}
