<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id'=>Category::PARENT_ID['NULL'],
        ]);
        $aboutUsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'About us',
            'parent_id'=>Category::PARENT_ID['NULL'],
        ]);
        $contactsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'Contacts',
            'parent_id'=>Category::PARENT_ID['NULL'],
        ]);
        $aboutUsMenu = Menu::query()->create([
            'category_id' => $aboutUsCategory->id,
            'title' => 'About us',
        ]);
        $newsMenu = Menu::query()->create([
            'category_id' => $newsCategory->id,
            'title' => 'News',
        ]);
        $contactsMenu = Menu::query()->create([
            'category_id' => $contactsCategory->id,
            'title' => 'Contacts',
        ]);
        Category::factory()->count(10)->create();
        Article::factory()->create([
            'category_id' => $aboutUsCategory->id,
            'author' => Article::ARTICLE_AUTHOR['ADMIN'],
        ]);
        Article::factory()->create([
            'category_id' => $contactsCategory->id,
            'author' => Article::ARTICLE_AUTHOR['ADMIN'],
        ]);
        Article::factory()->count(100)->create();
    }
}
