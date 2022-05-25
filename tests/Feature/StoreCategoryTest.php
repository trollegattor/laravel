<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
class StoreCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryStoreSuccessfully()
    {
        $faker = app(\Faker\Generator::class);


        $category=[
            'name' => $faker->name(),
            'type' => 'multiple',
            'parent_id'=>null,
            ];
        //Category::factory()->count(10)->create();
        $response = $this->post('/api/category',$category,);

        $response->assertOk();
    }
}
