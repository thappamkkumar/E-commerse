<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Vendor;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Vendor::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'name' => $faker->company,
            'brand_name' => $faker->company,
            'categories' => ['category1', 'category2', 'category3'],
            'gstin' => $faker->unique()->numerify('#############'),
            'city' => $faker->city,
            'state' => $faker->state,
            'country' => $faker->country,
            'pincode' => $faker->postcode,
            'landmark' => $faker->optional()->streetAddress,
            'payment_id' => $faker->unique()->numerify('#############'),
            'brand_logo' => $faker->imageUrl(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
