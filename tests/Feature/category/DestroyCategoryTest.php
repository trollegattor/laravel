<?php

namespace Tests\Feature\category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyCategoryTest extends TestCase
{
    public array $data = [
        'type' => Category::CATEGORY_TYPES['MULTI'],
        'name' => 'News',
        'parent_id' => Category::PARENT_ID['NULL'],
        ];
    use RefreshDatabase, WithFaker;

    /**
     * @return void
     */
    public function testCategoryDestroySuccessfully()
    {
        Category::query()->create($this->data);
        Category::factory()->count(10)->create();
        $id = Category::query()->where('id', '!=', null)->first();
        $this->deleteJson('/api/category/' . $id->id)
            ->assertStatus(200)
            ->assertJsonMissing($id->attributesToArray());
    }
}
