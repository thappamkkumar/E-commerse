<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
			 $name = $this->faker->words(2, true);
         return [
            'categories_id' => Categories::factory(),
            'brand_id'      => Brands::factory(),
            'name'          => ucfirst($name),
            'slug'          => Str::slug($name . '-' . $this->faker->unique()->numberBetween(1, 9999)),
            'price'         => $this->faker->randomFloat(2, 100, 5000),
            'sale_price'    => $this->faker->randomFloat(2, 50, 4000),
             'description'   => $this->faker->paragraph(),
            'specification' => $this->faker->sentence(),
            'stock'         => $this->faker->numberBetween(1, 100),
            'video_url'     => $this->faker->url(),
            'images'        => json_encode([$this->faker->imageUrl(640, 480, 'products', true)]),
            'thumnail'      => $this->faker->imageUrl(640, 480, 'thumb', true),
            'is_active'     => 1,
        ];
    }
}
