<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	 protected $model = Transaction::class;
    public function definition(): array
    {
		$faker = \Faker\Factory::create(); // Create Faker instance
        return [
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'product_id' => function () {
            return Product::inRandomOrder()->first()->id;
        },
        'transaction_id' => $faker->uuid,
        'status' => $faker->randomElement(['success', 'pending', 'failed']),
        'amount' => $faker->randomFloat(2, 10, 1000),
        'transaction_details' => json_encode([
                'description' => $faker->sentence,
                'date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            ]),
        'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
        'updated_at' => now(),
    ];
    }
}
