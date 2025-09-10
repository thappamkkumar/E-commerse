<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'user_id'             => User::factory(),
            'product_id'          => Product::factory(),
            'transaction_id'      => strtoupper(Str::random(12)),
            'status'              => $this->faker->randomElement(['pending', 'success', 'failed']),
            'amount'              => $this->faker->randomFloat(2, 100, 1000),
            'transaction_details' => $this->faker->sentence(),
        ];
    }
}
