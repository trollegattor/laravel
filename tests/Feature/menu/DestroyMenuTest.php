<?php

namespace Tests\Feature\menu;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyMenuTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @return void
     */
    public function testCategoryDestroySuccessfully()
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
        $id = Menu::query()->where('id', '!=', null)->first();
        $this->deleteJson('/api/menu/' . $id->id)
            ->assertStatus(200)
            ->assertJsonMissing($id->attributesToArray());
    }
    public function testCategoryDestroyFailed()
    {
        $aboutUsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'About us',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $aboutUsMenu = Menu::query()->create([
            'category_id' => $aboutUsCategory->id,
            'title' => 'About us',
        ]);
        Menu::factory()->count(10)->create([
            'category_id' => $aboutUsCategory->id,
        ]);
        $count=Menu::query();
        for($i=1; $count!==null; $i++)
        {
            $count=Menu::query()->where('id','=',$i)->first();
            $id=$i;
        }
        $this->deleteJson('/api/menu/' . $id)
            ->assertNotFound();
    }
}
