<?php

namespace Tests\Feature\article;

use App\Models\Article;
use App\Models\Category;
use Tests\TestCase;

class ShowArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticleShowSuccessfulGet()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        Article::factory()->count(10)->create(['category_id' => $newsCategory->id]);
        $count = Article::query()->where('id', '!=', null)->first();
        $this->getJson('/api/article/' . $count->id)
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testArticleShowFailedGet()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        Article::factory()->count(10)->create(['category_id' => $newsCategory->id]);
        $count = Article::query();
        for ($i = 1; $count !== null; $i++) {
            $count = Article::query()->where('id', '=', $i)->first();
            $id = $i;
        }
        $this->getJson('/api/article/' . $id)
            ->assertNotFound();

    }
}
