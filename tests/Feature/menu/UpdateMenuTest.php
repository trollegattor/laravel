<?php

namespace Tests\Feature\menu;

use App\Models\Category;
use App\Models\Menu;
use Tests\TestCase;

class UpdateMenuTest extends TestCase
{
    /**
     * @return void
     */
    public function testMenuUpdateSuccessful()
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
        $newData = [
            'category_id' => $contactsCategory->id,
            'title' => 'New contacts',
        ];
        $id = Menu::query()
            ->where('id', '!=', null)
            ->where('title', '!=', 'About us')
            ->first();
        $this->patchJson('/api/menu/' . $id->id, $newData)
            ->assertExactJson(['data' => [
                'id' => $id->id,
                'category_id' => $contactsCategory->id,
                'title' => 'New contacts',
            ]]);
    }
}
