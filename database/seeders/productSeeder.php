<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Brands;
use App\Models\Products; 
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Config;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$img =['img1.jpg','img2.jpg','img3.jpg','img4.jpg','img5.jpg','img6.jpg','img7.jpg','img8.jpg','img9.jpg','img10.jpg','img11.jpg','img12.jpg','img13.jpg','img14.jpg','img15.jpg','img16.jpg','img17.jpg'];
		
		$faker = Faker::create();
        foreach(range(1, 17) as $value){
            Products::create([
                'name' => $faker->randomElement(Brands::pluck('name')) . ' Watch',
                'price' => $faker->numberBetween($min = 5000, $max = 100000),
                'sale_price' => $faker->numberBetween($min = 500, $max = 4999),
                //'color' => $faker->colorName,
                'brand_id' => $faker->randomElement(Brands::pluck('id')),
                'product_code' => $faker->numerify('LV-#####'),
                'stock' => $faker->randomDigit(),
                'description' => $faker->text($maxNbChars = 200),
				  
                'thumnail' => $faker->randomElement($img),
                'is_active' => $faker->randomElement(['1', '0']),
            ]);
        }
    }
}
