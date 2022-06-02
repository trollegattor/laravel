<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyCategoryTest extends TestCase
{
    public array $data=[
        'type' => Category::CATEGORY_TYPES['MULTI'],
        'name' => 'News',
        'parent_id'=>Category::PARENT_ID['NULL'],
    ];
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $id = 2;
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $response = $this->deleteJson('/api/category/' . $id);
        dump($response);

        $response->assertStatus(200);
        $response->assertExactJson(['data' => []]);
    }
}
