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
    public function testExample()
    {
        $faker = app(\Faker\Generator::class);
        $category=[
            'name' => $faker->name(),
            'type' => 'multiple',
            'parent_id'=>null,
        ];
        Category::factory()->count(10)->create();


        $response=$this->post('/api/category',$category);

        $response->assertCreated();
        //dd($response->getContent());

    }
   /* public function testCategoryStoreSuccessfully()
    {

        $faker = app(\Faker\Generator::class);
        $category=[
            'name' => $faker->name(),
            'type' => 'multiple',
            'parent_id'=>null,
            ];
        //Category::factory()->count(10)->create();
        //$responseGet = $this->get('/api/category',$category,);
        //$responseGet->assertOk();
        //$responseGet->assertSessionDoesntHaveErrors();
        //$responseGet->assertStatus(200);
        $this->post('/api/category',$category,);
        $this->assertDatabaseHas('categories',['type' => 'multiple']);

    }*/
}
