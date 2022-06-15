<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCategoryTest extends TestCase
{
    private array $data = [
        'type' => Category::CATEGORY_TYPES['MULTI'],
        'name' => 'News',
        'parent_id' => Category::PARENT_ID['NULL'],
    ];
    private array $newData = [
        'name' => 'Sport News',
        'type' => 'multiple',
        'parent_id' => null,
    ];
    use RefreshDatabase, WithFaker;

    /**
     * @return void
     */
    public function testCategoryStoreCreate()
    {
        Category::query()->create($this->data);
        $id = Category::query()
            ->where('name', '=', 'News')
            ->first();
        $newId = $id->id + 1;
        $this->post('/api/category', $this->newData)
            ->assertExactJson(['data' => [
                'id' => $newId,
                'name' => 'Sport News',
                'type' => 'multiple',
                'parent_id' => null,
            ]]);
    }

    /**
     * @return void
     */
    public function testCategoryStoreSuccessfulValid()
    {
        $this->postJson('/api/category', $this->newData)
            ->assertJsonMissingValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidFirst()
    {
        $category = [
            'parent_id' => 'error',
        ];
        $this->postJson('/api/category', $category)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidSecond()
    {
        $category = [
            'name' => 111,
            'type' => 111,
            'parent_id' => [],
        ];
        $this->postJson('/api/category', $category)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidThird()
    {
        $category = [
            'name' => $this->faker->realTextBetween(201, 300),
            'type' => 'error',
            'parent_id' => 1,
        ];
        $this->postJson('/api/category', $category)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);

    }
}
