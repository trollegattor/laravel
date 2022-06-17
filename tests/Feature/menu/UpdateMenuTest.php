<?php

namespace Tests\Feature\menu;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateMenuTest extends TestCase
{
    use RefreshDatabase, WithFaker;
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
    public function testMenuUpdateSuccessfulValid()
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
            ->assertJsonMissingValidationErrors(['category_id', 'title']);
    }

    /**
     * @return void
     */
    public function testMenuUpdateFailedValidFirst()
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
        $newData = [];
        $id = Menu::query()
            ->where('id', '!=', null)
            ->where('title', '!=', 'About us')
            ->first();
        $this->patchJson('/api/menu/' . $id->id, $newData)
            ->assertJsonValidationErrors(['category_id', 'title']);
    }

    /**
     * @return void
     */
    public function testMenuUpdateFailedValidSecond()
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
        $count=Category::query();
        for($i=1; $count!==null; $i++)
        {
            $count=Category::query()->where('id','=',$i)->first();
            $id=$i;
        }
        $newData = [
            'category_id' => $id,
            'title' => 123456,
        ];
        $id = Menu::query()
            ->where('id', '!=', null)
            ->where('title', '!=', 'About us')
            ->first();
        $this->patchJson('/api/menu/' . $id->id, $newData)
            ->assertJsonValidationErrors(['category_id', 'title']);
    }

    /**
     * @return void
     */
    public function testMenuUpdateFailedValidThird()
    {
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
            'title' => $this->faker->realTextBetween(201, 300),
        ];
        $id = Menu::query()
            ->where('id', '!=', null)
            ->where('title', '!=', 'About us')
            ->first();
        $this->patchJson('/api/menu/' . $id->id, $newData)
            ->assertJsonValidationErrors(['title']);
    }

    /**
     * @return void
     */
    public function testMenuUpdateFailed()
    {
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
        $count=Menu::query();
        for($i=1; $count!==null; $i++)
        {
            $count=Menu::query()->where('id','=',$i)->first();
            $id=$i;
        }
        $this->patchJson('/api/menu/' . $id, $newData)
            ->assertNotFound();
    }
}
