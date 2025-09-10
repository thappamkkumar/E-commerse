<?php

namespace Database\Factories;

use App\Models\Brands;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandsFactory extends Factory
{
    protected $model = Brands::class;

    public function definition()
    {
        return [
            'name'      => $this->faker->company(),
            'image'     => $this->faker->imageUrl(200, 200, 'brand', true),
            'is_active' => true,
        ];
    }
}
