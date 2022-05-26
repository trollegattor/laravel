<?php

namespace Tests\Feature\category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryStoreCreate()
    {
        $category = [
            'name' => 'Sport News',
            'type' => 'multiple',
            'parent_id' => null,
            ];
        $this->post('/api/category', $category)
            ->assertExactJson(['data'=>[
                'id'=>1,
                'name' => 'Sport News',
                'type' => 'multiple',
                'parent_id' => null,
            ]]);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValid()
    {
        $category = [
            'name' => null,
            'type' => null,
            'parent_id' => 'error',
            ];
        $this->postJson('/api/category', $category)
            ->dump()
            ->assertJsonValidationErrors('name')
            ->assertJsonValidationErrors('type')
            ->assertJsonValidationErrors('parent_id');



    }
}
