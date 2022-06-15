<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Article::factory()->count(25)->create();
    }
}
