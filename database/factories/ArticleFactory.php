<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ArticleFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Article::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(),
            'author' => Article::ARTICLE_AUTHOR[array_rand(Article::ARTICLE_AUTHOR)]
        ];
    }
}
