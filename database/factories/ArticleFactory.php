<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Article::class;

    /**
     * @inheritDoc
     */
    public function definition()
    {
        return [
            //'category_id' => Category::factory(),
            'category_id' =>(Category::first() == Null)?Category::factory():Category::where('parent_id','!=',null)
                ->pluck('id')
                ->random(1)[0],
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(),
            'author' =>Article::ARTICLE_AUTHOR[array_rand(Article::ARTICLE_AUTHOR)]
        ];
    }
}
