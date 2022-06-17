<?php

namespace Tests\Feature\article;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateArticleTest extends TestCase
{
    use RefreshDatabase, WithFaker;
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

    /**
     * @return void
     */
    public function testArticleUpdateSuccessfulValid()
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
            ->assertJsonMissingValidationErrors([
                'category_id',
                'title',
                'content',
                'author'
            ]);
    }

    /**
     * @return void
     */
    public function testArticleUpdateFailedValidFirst()
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

        $this->patchJson('/api/article/' . $id->id, [])
            ->assertJsonValidationErrors([
                'category_id',
                'title',
                'content',
                'author'
            ]);
    }

    /**
     * @return void
     */
    public function testArticleUpdateFailedValidSecond()
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
        $count = Category::query();
        for ($i = 1; $count !== null; $i++)
        {
            $count = Category::query()->where('id', '=', $i)->first();
            $cat_id = $i;
        }
        $this->patchJson('/api/article/' . $id->id, [
            'category_id' => $cat_id,
            'title' => 123,
            'content' => 123,
            'author' => 123,
        ])
            ->assertJsonValidationErrors([
                'category_id',
                'title',
                'content',
                'author'
            ]);
    }

    /**
     * @return void
     */
    public function testArticleUpdateFailedValidThird()
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
            'title' => $this->faker->realTextBetween(201, 300),
            'content' => $this->faker->realTextBetween(15001, 15101),
            'author' => 'error',
        ])
            ->assertJsonValidationErrors([
                'title',
                'content',
                'author'
            ]);
    }

    /**
     * @return void
     */
    public function testArticleUpdateFailed()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        Article::factory()->count(10)->create(['category_id' => $newsCategory->id]);

        $count=Article::query();
        for($i=1; $count!==null; $i++)
        {
            $count=Article::query()->where('id','=',$i)->first();
            $id=$i;
        }
        $this->patchJson('/api/article/' . $id, [
            'category_id' => $newsCategory->id,
            'title' => 'Last news',
            'content' => 'Hello from Stepan',
            'author' => Article::ARTICLE_AUTHOR['ADMIN'],
        ])
            ->assertNotFound();
    }
}
