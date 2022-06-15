<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CategoryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Category::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        $type = ['single', 'multiple'];

        return [
            'name' => $this->faker->name(),
            'type' => 'multiple',
            'parent_id'=>Category::query()->where('name','News')->value('id'),
        ];
    }
}
