<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Categories;

class CategoryTest extends TestCase
{
		use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
		
		
		//Get List of Categories
		public function test_get_list_of_category()
		{
			$user = User::factory()->create();
			$categories = Categories::factory()->count(5)->create();
			
			$this->actingAs($user);

			$response = $this->get('/categories');
			
			$response->assertStatus(200);
			
			foreach($categories as $category)
			{
				$response->assertSee($category->name);
			}
		}
		
		// Get products of selected category 
		public function test_get_products_of_selected_category()
		{
			$user = User::factory()->create();
			$category = Categories::factory()->create();
			
			$this->actingAs($user);
			
			$response = $this->get('/categoryProduct/'.$category->id);
			
			if ($response->status() >= 400) {
         // dd('Error: ' . $response->status(), $response->getContent());
       }
			
			$response->assertStatus(200);
			$response->assertSee($category->name);
			$response->assertSee((string)$category->gst);
			
		}
		
}
