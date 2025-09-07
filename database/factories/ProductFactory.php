<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Product;
use App\Models\Categories;
use App\Models\User;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $images = $this->faker->optional()->randomElements(['image1.jpg', 'image2.jpg', 'image3.jpg'], $this->faker->numberBetween(1, 3));
        $imagesSerialized = $images ? json_encode($images) : null;

        return [
            'categories_id' => Categories::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => $this->faker->name,
            'slug' => $this->faker->unique()->slug,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'sale_price' => $this->faker->optional()->randomFloat(2, 5, 500),
            'delivery_charges' => $this->faker->optional()->randomFloat(2, 5, 500),
            //'gst' => $this->faker->optional()->randomFloat(2, 5, 500),
            'description' => $this->faker->sentence,
            'specification' => $this->faker->paragraph,
            'stock' => $this->faker->numberBetween(0, 100),
            'video_url' => $this->faker->optional()->url,
            'images' => $imagesSerialized,
            'thumnail' => $this->faker->optional()->imageUrl(),
            'is_active' => $this->faker->boolean(90), // 90% chance of being true
        ];
    }
}
