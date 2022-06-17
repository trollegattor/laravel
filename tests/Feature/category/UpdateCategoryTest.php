<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    public array $data = [
        'type' => Category::CATEGORY_TYPES['MULTI'],
        'name' => 'News',
        'parent_id' => Category::PARENT_ID['NULL'],
    ];
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryUpdateSuccessful()
    {
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $parentId = Category::query()
            ->where('name', '=', 'News')
            ->first();
        $newData = [
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'Sport',
            'parent_id' => $parentId->id
        ];
        $id = Category::query()
            ->where('id', '!=', null)
            ->where('name', '!=', 'News')
            ->first();
        $this->patchJson('/api/category/' . $id->id, $newData)
            ->assertExactJson(['data' => [
                'id' => $id->id,
                'type' => Category::CATEGORY_TYPES['MULTI'],
                'name' => 'Sport',
                'parent_id' => $parentId->id,
            ]]);
    }

    /**
     * @return void
     */
    public function testCategoryUpdateSuccessfulValid()
    {
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $parentId = Category::query()
            ->where('name', '=', 'News')
            ->first();
        $newData = [
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'Sport',
            'parent_id' => $parentId->id
        ];
        $id = Category::query()
            ->where('id', '!=', null)
            ->where('name', '!=', 'News')
            ->first();

        $this->patchJson('/api/category/' . $id->id, $newData)
            ->assertJsonMissingValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryUpdateFailedValidFirst()
    {
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $newData = [
            'parent_id' => 'error',
        ];
        $id = Category::query()
            ->where('id', '!=', null)
            ->where('name', '!=', 'News')
            ->first();

        $this->patchJson('/api/category/' . $id->id, $newData)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryUpdateFailedValidSecond()
    {
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $newData = [
            'name' => 111,
            'type' => 111,
            'parent_id' => [],
        ];
        $id = Category::query()
            ->where('id', '!=', null)
            ->where('name', '!=', 'News')
            ->first();
        $this->patchJson('/api/category/' . $id->id, $newData)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryUpdateFailedValidThird()
    {
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $newData = [
            'name' => $this->faker->realTextBetween(201, 300),
            'type' => 'error',
            'parent_id' => Category::query()
                ->where('id', '!=', null)
                ->where('name', '!=', 'News')
                ->first(),
        ];
        $id = Category::query()
            ->where('id', '!=', null)
            ->where('name', '!=', 'News')
            ->first();
        $this->patchJson('/api/category/' . $id->id, $newData)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryUpdateFailed()
    {
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $parentId = Category::query()
            ->where('name', '=', 'News')
            ->first();
        $newData = [
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'Sport',
            'parent_id' => $parentId->id
        ];
        $count=Category::query();
        for($i=1; $count!==null; $i++)
        {
            $count=Category::query()->where('id','=',$i)->first();
            $id=$i;
        }
        $this->patchJson('/api/category/' . $id, $newData)
            ->assertNotFound();
    }
}
