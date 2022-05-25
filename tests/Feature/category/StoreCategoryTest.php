<?php

namespace Tests\Feature\category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCategoryTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryStoreCreate()
    {
        $faker = app(\Faker\Generator::class);
        $category = [
            'name' => $faker->name(),
            'type' => 'multiple',
            'parent_id' => null,
            ];
        $response = $this->post('/api/category', $category);
        $response->assertCreated();
    }

    /**
     * @return void
     */
    public function testCategoryStoreValid()
    {
        $faker = app(\Faker\Generator::class);
        $category = [
            'name' => $faker->name(),
            'type' => 'multiple',
            'parent_id' => null,
            ];
        $response = $this->post('/api/category', $category);
        $response->assertJson(['data'=>$category]);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValid()
    {
        $faker = app(\Faker\Generator::class);
        $category = [
            'name' => $faker->name(),
            'type' => 'error',
            'parent_id' => null,
            ];
        $response = $this->post('/api/category', $category);
        $response->assertJsonValidationErrors();
    }
}
