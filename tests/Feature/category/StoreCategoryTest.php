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
        $response = $this->postJson('/api/category', $category)->json();

        $errors = $response['errors'];
        $nameErrorMessage = array_shift($errors['name']);
        $typeErrorMessage = array_shift($errors['type']);
        $parentIdErrorMessage = array_shift($errors['parent_id']);

        $this->assertSame('The name field is required.', $nameErrorMessage);
    }
}
