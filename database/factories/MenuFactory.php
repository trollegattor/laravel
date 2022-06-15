<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class MenuFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Menu::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence(3),
        ];
    }
}
