<?php

namespace Tests\Feature\menu;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreMenuTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMenuStoreCreate()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $firstSubCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'About Ukraine',
            'parent_id' => $newsCategory->id,
        ]);
        $aboutUsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'About us',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $contactsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'Contacts',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $aboutUsMenu = Menu::query()->create([
            'category_id' => $aboutUsCategory->id,
            'title' => 'About us',
        ]);
        $newId = $aboutUsMenu->id + 1;
        $this->post('/api/menu', [
            'category_id' => $newsCategory->id,
            'title' => 'News',
        ])
            ->assertExactJson(['data' => [
                'id' => $newId,
                'category_id' => $newsCategory->id,
                'title' => 'News',
            ]]);
    }

    /**
     * @return void
     */
    public function testMenuStoreSuccessfulValid()
    {
        $newsCategory = Category::query()->create
        ([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $this->postJson('/api/menu',
            [
                'category_id' => $newsCategory->id,
                'title' => 'News'
            ])
            ->assertJsonMissingValidationErrors(['category_id', 'title']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidFirst()
    {
        $newsCategory = Category::query()->create
        ([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $this->postJson('/api/menu', [])
            ->assertJsonValidationErrors(['category_id', 'title']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidSecond()
    {
        $newsCategory = Category::query()->create
        ([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $this->postJson('/api/menu', [
            'category_id' => $newsCategory->id + 1,
            'title' => 123456
        ])
            ->assertJsonValidationErrors(['category_id', 'title']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidThird()
    {
        $newsCategory = Category::query()->create
        ([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $this->postJson('/api/menu', [
            'category_id' => $newsCategory->id,
            'title' => $this->faker->realTextBetween(201, 300)
        ])
            ->assertJsonValidationErrors(['title']);
    }
}
