<?php

namespace Tests\Feature\article;

use App\Models\Article;
use App\Models\Category;
use Tests\TestCase;

class UpdateArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticleUpdateSuccessful()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        Article::factory()->count(10)->create(['category_id' => $newsCategory->id]);
        $id = Article::query()
            ->where('id', '!=', null)
            ->first();

        $this->patchJson('/api/article/' . $id->id, [
            'category_id' => $newsCategory->id,
            'title' => 'Last news',
            'content' => 'Hello from Stepan',
            'author' => Article::ARTICLE_AUTHOR['ADMIN'],
        ])
            ->assertJson(['data' => [
                'id' => $id->id,
                'category_id' => $newsCategory->id,
                'title' => 'Last news',
                'content' => 'Hello from Stepan',
                'author' => Article::ARTICLE_AUTHOR['ADMIN'],
            ]]);
    }
}
