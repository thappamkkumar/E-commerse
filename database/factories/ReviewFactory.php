<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'user_id'    => User::factory(),
            'product_id' => Product::factory(),
            'review'     => $this->faker->sentence(),
            'rating'     => $this->faker->numberBetween(1, 5),
        ];
    }
}
