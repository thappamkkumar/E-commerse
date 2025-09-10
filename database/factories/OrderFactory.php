<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'order_number'     => strtoupper(Str::random(10)),
            'user_id'          => User::factory(),
            'transaction_id'   => Transaction::factory(),
            'product_id'       => Product::factory(),
            'address'          => $this->faker->address(),
            'price'            => $this->faker->randomFloat(2, 100, 1000),
            'delivery_charges' => $this->faker->randomFloat(2, 10, 50),
            'gst'              => $this->faker->numberBetween(5, 18),
            'order_status'     => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered']),
            'quantity'         => $this->faker->numberBetween(1, 5),
        ];
    }
}
