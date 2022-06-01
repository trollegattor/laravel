<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCategoryTest extends TestCase
{
    public array $data=['type' => Category::CATEGORY_TYPES['MULTI'],
        'name' => 'News',
        'parent_id'=>Category::PARENT_ID['NULL'],];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryShowGet()
    {
        $newsCategory = Category::query()->create($this->data);
        $response = $this->get('/api/category/1');
        dump($response);

        $response->assertStatus(200);
    }
}
