<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'user_id'                  => User::factory(),
            'name'                     => $this->faker->name(),
            'area_street_sector_village' => $this->faker->streetAddress(),
            'flat_houseno_building_company' => $this->faker->buildingNumber(),
            'landmark'                 => $this->faker->word(),
            'district'                 => $this->faker->city(),
            'state'                    => $this->faker->state(),
            'country'                  => $this->faker->country(),
            'pincode'                  => $this->faker->postcode(),
            'profile_image'            => $this->faker->imageUrl(200, 200, 'people', true),
        ];
    }
}
