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
        $category = Category::factory()->create(['name' => 'News','type'=>'multiple']);

        $article = [
            'category_id' => $category->id,
            'title' => $faker->sentence(3),
            'content' => $faker->paragraph(),
            'author' => Article::ARTICLE_AUTHOR[array_rand(Article::ARTICLE_AUTHOR)],
        ];


        //$response = $this->get('api/article', $article);
        //$response->assertOk();
        //$this->get('api/article', $article)->assertOk();
        //$this->get('api/article', $article)->assertOk();
        $response=$this->postJson('api/article', $article);
            $response
                ->assertStatus(201)
                ->assertJson(['created'=>true,]);

        //$response->assertJsonStructure();
        //$response->assertJson(['data' => $article]);
    }
}
