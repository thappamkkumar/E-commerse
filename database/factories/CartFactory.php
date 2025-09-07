<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	protected $model = Cart::class;
    public function definition(): array
    {
		$faker = \Faker\Factory::create(); // Create Faker instance
       return [
        'user_id' => rand(1, 10), // Assuming you have users with IDs from 1 to 10
        'product_id' => rand(1, 20), // Assuming you have products with IDs from 1 to 20
        'quantity' => $faker->numberBetween(1, 10),
        'created_at' => now(),
        'updated_at' => now(),
		];
    }
}
