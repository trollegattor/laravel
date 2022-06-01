<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCategoryTest extends TestCase
{
    public array $data=[
        'id'=>1,
        'type' => Category::CATEGORY_TYPES['MULTI'],
        'name' => 'News',
        'parent_id'=>Category::PARENT_ID['NULL'],
        ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryShowSuccessfulGet()
    {
        Category::query()->create($this->data);
        $response = $this->getJson('/api/category/1');
        $response->assertStatus(200);
    }
    /*public function testCategoryFailedShowGet()
    {
        Category::query()->create($this->data);
        $response = $this->get('/api/category/3');
        $response->assertStatus(404);
    }*/
}
