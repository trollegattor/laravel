<?php

namespace Tests\Feature\article;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreArticleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticleStoreCreate()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $aboutUsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['SINGLE'],
            'name' => 'About us',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        Article::factory()->count(10)->create(['category_id' => $newsCategory->id]);
        $this->post('/api/article', [
            'category_id' => $aboutUsCategory->id,
            'title' => 'Last news',
            'content' => 'Hello from Stepan',
            'author' => Article::ARTICLE_AUTHOR['ADMIN'],
        ])
            ->assertJson(['data' => [
                'category_id' => $aboutUsCategory->id,
                'title' => 'Last news',
                'content' => 'Hello from Stepan',
                'author' => Article::ARTICLE_AUTHOR['ADMIN']
            ]]);
    }

    /**
     * @return void
     */
    public function testArticleStoreSuccessfulValid()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $this->postJson('/api/article', [
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
    public function testArticleStoreFailedValidFirst()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $this->postJson('/api/article', [])
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
    public function testArticleStoreFailedValidSecond()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $count = Category::query();
        for ($i = 1; $count !== null; $i++)
        {
            $count = Category::query()->where('id', '=', $i)->first();
            $id = $i;
        }
        $this->postJson('/api/article', [
            'category_id' => $id,
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
    public function testArticleStoreFailedValidThird()
    {
        $newsCategory = Category::query()->create([
            'type' => Category::CATEGORY_TYPES['MULTI'],
            'name' => 'News',
            'parent_id' => Category::PARENT_ID['NULL'],
        ]);
        $this->postJson('/api/article', [
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
}
