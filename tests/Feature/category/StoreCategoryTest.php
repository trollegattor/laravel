<?php

namespace Tests\Feature\category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCategoryTest extends TestCase
{
    use RefreshDatabase;
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
        $response = $this->postJson('/api/category', $category);
        $response->dumpSession();
        $response->assertJson(['data'=>$category]);
    }

    /**
     * @return void
     */
    public function testCategoryStoreFailedValid()
    {
        $faker = app(\Faker\Generator::class);
        $category = [
            'name' => null,
            'type' => null,
            'parent_id' => 22,
            ];
        $response = $this->postJson('/api/category', $category);
        $response->dump();
        $response->assertJsonValidationErrors('name');
        //$response->assertJsonValidationErrors('name');
        //$response->assertJsonValidationErrors('parent_id');
        $a='https://laravel.demiart.ru/test-refactoring/';
    }
}
