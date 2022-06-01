<?php

namespace Tests\Feature\category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCategoryTest extends TestCase
{
    private array $category = [
        'name' => 'Sport News',
        'type' => 'multiple',
        'parent_id' => null,
    ];
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @param $category
     * @return void
     */
    public function testCategoryStoreCreate()
    {
        $this->post('/api/category', $this->category)
            ->assertExactJson(['data' => [
                'id' => 1,
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
        $this->postJson('/api/category', $this->category)
            ->assertJsonMissingValidationErrors(['name', 'type', 'parent_id']);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValidFirst()
    {
        $category = [
            'name' => null,
            'type' => null,
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
            'name' => $this->faker->realTextBetween(201,300),
            'type' => 'error',
            'parent_id' => 1,
        ];
        $this->postJson('/api/category', $category)
            ->assertJsonValidationErrors(['name', 'type', 'parent_id']);

    }
}
