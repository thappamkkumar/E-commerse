<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriesFactory extends Factory
{
    protected $model = Categories::class;

    public function definition()
    {
        return [
            'name'      => $this->faker->unique()->word(),
            'slug'      => $this->faker->unique()->slug(),
            'gst'       => $this->faker->numberBetween(5, 18),
            'is_active' => true,
        ];
    }
}
