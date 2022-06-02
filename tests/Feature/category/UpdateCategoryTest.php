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
    public array $newData = [
        'type' => Category::CATEGORY_TYPES['MULTI'],
        'name' => 'Sport',
        'parent_id' => 1
    ];

    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryUpdateSuccessful()
    {
        $id = 2;
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $response = $this->patchJson('/api/category/' . $id, $this->newData);
        $response->assertExactJson(['data' => [
            'id' => $id,
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'Sport',
            'parent_id' => 1
        ]]);
    }
}
