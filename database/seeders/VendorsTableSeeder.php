<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the number of records you want to create
        $numberOfRecords = 10;

        // Create Vendor instances using the factory
        Vendor::factory()->count($numberOfRecords)->create();
    }
}
