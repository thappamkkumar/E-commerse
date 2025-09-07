<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		$faker = \Faker\Factory::create(); // Create Faker instance
        return [
			'order_number' => $faker->unique()->uuid,
			'user_id' => function () {
				return User::factory()->create()->id;
			},
			'product_id' => function () {
				return Product::factory()->create()->id;
			},
			'address' => $faker->address,
			'price' => $faker->randomFloat(2, 10, 500),
			'delivery_charges' => $faker->randomFloat(2, 5, 50),
			'gst' => $faker->randomFloat(2, 1, 10),
			'order_status' => $faker->randomElement(['pending', 'processing', 'completed']),
			'quantity' => $faker->numberBetween(1, 10),
			'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
			'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
			'transaction_id' => function () {
				return Transaction::inRandomOrder()->first()->id;
			},
		];
    }
}
