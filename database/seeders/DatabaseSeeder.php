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
            'name' => 'News'
        ]);
        $aboutUsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'About us'
        ]);
        $contactsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'Contacts'
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
        Article::factory()->create([
            'category_id' => $aboutUsCategory->id,
            'author' => Article::ARTICLE_AUTHOR['ADMIN'],
        ]);
        Article::factory()->create([
            'category_id' => $contactsCategory->id,
            'author' => Article::ARTICLE_AUTHOR['ADMIN'],
        ]);
        Article::factory()->count(100)->create(['category_id' => $newsCategory->id]);
    }
}
