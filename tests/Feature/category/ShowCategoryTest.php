<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCategoryTest extends TestCase
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
    public function testCategoryShowSuccessfulGet()
    {
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $count=Category::query()->where('id','!=', null)->first();
        $this->getJson('/api/category/'.$count->id)
            ->assertStatus(200);
    }

    /**
     * @return void
     *
     */
    public function testCategoryFailedShowGet()
    {
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $count=Category::query();
        for($i=1; $count!==null; $i++)
        {
            $count=Category::query()->where('id','=',$i)->first();
        }
        $response = $this->getJson('/api/category/'.$i);
        $response->assertNotFound();
    }
}
