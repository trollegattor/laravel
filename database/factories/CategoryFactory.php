<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Category::class;

    /**
     * @return array|mixed[]
     */
    public function definition()
    {
        $type = ['single', 'multiple'];

        return [
            'name' => $this->faker->name(),
            'type' => 'multiple',
            'parent_id'=>Category::where('name','News')->value('id'),
        ];
    }
}
