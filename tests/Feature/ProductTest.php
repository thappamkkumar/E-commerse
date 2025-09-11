<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class ProductTest extends TestCase
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
		
		//Product listing page loads with products
		public function test_product_listing_page_loads_with_products()
		{
			 
			 
			// Arrange: creates 3 products   auto-attached
			$products = Product::factory()->count(3)->create();
			
			$user = User::factory()->create();
			
			$this->actingAs($user);//simmulate or fake logged user
			
			
			// Act
			$response = $this->get('/productList');
			
			//hold or dd if any error
			if ($response->status() >= 400) {
          //dd('Error: ' . $response->status(), $response->getContent());
       }
			// Assert
			$response->assertStatus(200);
			foreach ($products as $product) {
					$response->assertSee($product->name);
			}
			 
		}
		
		// Product detail page loads for a valid product
		public function test_product_detail_page_loads_for_valid_product()
		{ 
			//create a product using product model and factory
			$product = Product::factory()->create( );
			//create a user 
			$user = User::factory()->create();
			
			$this->actingAs($user);//simmulate or fake logged user
			
			//Act or call route to get product detail
			$response = $this->get('/productDetail/' . $product->id);
			
			  
			 
			//check status
			$response->assertStatus(200);
			//check response product data
			$response->assertSee($product->name);
			$response->assertSee((string)$product->price);
			$response->assertSee((string)$product->sale_price);
			$response->assertSee($product->description); 
			$response->assertSee($product->is_active);
		}
		
		//Invalid product ID returns 404
		public function test_invalid_product_id_returns_404()
    {
			$user = User::factory()->create();
			
			$this->actingAs($user);
			
			$response = $this->get('/productDetail/03fe');
			
			$response->assertStatus(404);
			
			
		}
		
		// User can search products by name/keyword
		public function test_user_can_search_products_by_name_or_keyword()
		{
				// Create products
        $matchingProduct = Product::factory()->create([
            'name' => 'Red Shoes',
            'is_active' => 1,
        ]);

        $nonMatchingProduct = Product::factory()->create([
            'name' => 'Blue Shirt',
            'is_active' => 1,
        ]);
				
				//create user
				$user = User::factory()->create();
				$this->actingAs($user);
				
				$response = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)->post('/productSearch',['search_input'=>'Red Shoes']);
				//$response = $this->withSession(['user_search_input'=>'Red Shoes'])->get('/productSearch' );
				
				//hold or dd if any error
				if ($response->status() >= 400) {
						dd('Error: ' . $response->status(), $response->getContent());
				 }
				 
				 
				$response->assertStatus(200);
				
        // Assert: matching product appears
        $response->assertSee($matchingProduct->name);

        // Assert: non-matching product does not appear
        $response->assertDontSee($nonMatchingProduct->name);
				
		 }
		
		//upload review for selected product 
		public function test_upload_review_for_selected_product()
		{
			$user = User::factory()->create();
			$product = Product::factory()->create();
			$reviewData = [
				'product_id' => $product->id,
				'rating' => 5,
				'review' => 'This product is so good. It use best material and good quality. It is best by cost and quality.It is under budget and not so much costly as compare to other brands.It is durable and comfertable.And also key for attraction.This product is so good. It use best material and good quality. It is best by cost and quality.It is under budget and not so much costly as compare to other brands.It is durable and comfertable.And also key for attraction.This product is so good. It use best material and good quality. It is best by cost and quality.It is under budget and not so much costly as compare to other brands.It is durable and comfertable.And also key for attraction.',
				
			];
			
			$this->actingAs($user);
			
			$response = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)->post('/productRating', $reviewData);
			if ($response->status() >= 400) {
					 dd('Error: '.$response->status(), $response->getContent());
			}
			 
			$response->assertStatus(200);
			$response->assertSee($product->id);
		}
			
		
		
}
