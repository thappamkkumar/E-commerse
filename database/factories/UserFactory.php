<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'email'         => $this->faker->unique()->safeEmail(),
            'password'      => bcrypt('password'), // default password
            'mobile_number' => $this->faker->phoneNumber(),
            'user_role'     => User::USER_ROLE,
            'is_active'     => User::USER_ACTIVE,
            'remember_token'=> Str::random(10),
        ];
    }

    public function admin()
    {
        return $this->state([
            'user_role' => User::ADMIN_ROLE,
        ]);
    }

    public function inactive()
    {
        return $this->state([
            'is_active' => User::USER_DEACTIVE,
        ]);
    }
}
