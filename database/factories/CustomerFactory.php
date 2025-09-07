<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Generator as Faker;
use App\Models\Customer;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Customer::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'user_id' => User::factory(),
            'name' => $faker->name,
            'area_street_sector_village' => $faker->streetAddress,
            'flat_houseno_building_company' => $faker->buildingNumber,
            'landmark' => $faker->optional()->word,
            'district' => $faker->city,
            'state' => $faker->state,
            'country' => $faker->country,
            'pincode' => $faker->postcode,
            'profile_image' => null, // Assuming no profile image for now
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
