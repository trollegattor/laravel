<?php

namespace Tests\Feature\menu;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowMenuTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMenuShowSuccessfulGet()
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
        Menu::factory()->count(10)->create([
            'category_id' => $aboutUsCategory->id,
        ]);
        $count = Menu::query()->where('id', '!=', null)->first();
        $this->getJson('/api/menu/' . $count->id)
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testMenuShowFailedGet()
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
        Menu::factory()->count(10)->create([
            'category_id' => $aboutUsCategory->id,
        ]);
        $count = Menu::query();
        for ($i = 1; $count !== null; $i++) {
            $count = Menu::query()->where('id', '=', $i)->first();
            $id = $i;
        }
        $this->getJson('/api/menu/' . $id)
            ->assertNotFound();
    }
}
