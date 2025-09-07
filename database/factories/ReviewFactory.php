<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	 protected $model = Review::class;
    public function definition(): array
    {
		$faker = \Faker\Factory::create(); // Create Faker instance
        return [
			'user_id' => User::inRandomOrder()->first()->id,
			'product_id' => Product::inRandomOrder()->first()->id,
			'review' => $faker->paragraph(),
			'rating' => $faker->numberBetween(1, 5),
			'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
			'updated_at' => $faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}
