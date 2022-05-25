<?php

use App\Models\Article;
use App\Models\Category;
use Tests\TestCase;

class StoreArticlesTest extends TestCase
{
    /**
     * @return void
     */
    public function testArticleStoreSuccessfully()
    {
        /** @var \Faker\Generator $faker */
        $faker = app(\Faker\Generator::class);
        $category = Category::factory()->create(['name' => 'News']);

        $article = [
            'category_id' => $category->id,
            'title' => $faker->title,
            'content' => $faker->sentence,
            'author' => Article::ARTICLE_AUTHOR[array_rand(Article::ARTICLE_AUTHOR)],
        ];

        $response = $this->post('api/article', $article);
        $response->assertJsonStructure();
        $response->assertJson(['data' => $article]);
    }
    public function testBasicTest()
    {
        $responce=$this->get('/api/category');
        $responce->assertStatus(200);
    }
}
