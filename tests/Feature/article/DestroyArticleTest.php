<?php

namespace Tests\Feature\article;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testArticleDestroySuccessfully()
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
        $this->deleteJson('/api/article/' . $id->id)
            ->assertStatus(200)
            ->assertJsonMissing($id->attributesToArray());
    }

    /**
     * @return void
     */
    public function testArticleDestroyFailed()
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
        $this->deleteJson('/api/category/' . $id)
            ->assertNotFound();
    }
}
