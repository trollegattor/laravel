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
}
