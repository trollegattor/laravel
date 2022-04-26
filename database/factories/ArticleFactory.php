<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Article::class;

    public function definition()
    {
        $author=array('admin','user');
        return [
            'category_id'=>rand(1,3),
            'title'=>$this->faker->sentence(3),
            'content'=>$this->faker->paragraph(),
            'author'=>$author[array_rand($author)]

        ];
    }
}
