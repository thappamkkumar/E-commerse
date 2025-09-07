<?php

namespace Database\Factories;
use App\Models\Payment;
use App\Models\User;
use App\Models\Order;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	 protected $model = Payment::class;
    public function definition(): array
    {
		$faker = \Faker\Factory::create(); // Create Faker instance
        return [
			'user_id' => function () {
				return User::factory()->create()->id;
			},
			'order_id' => function () {
				return Order::factory()->create()->id;
			},
			'amount' => $faker->randomFloat(2, 0, 10000),
			'created_at' => now(),
			'updated_at' => now(),
		];
    }
}
