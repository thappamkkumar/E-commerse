<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;

class CartTest extends TestCase
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
		
		//user can add product to cart 
		public function test_user_can_add_product_to_cart()
		{
			//create user 
			$user = User::factory()->create();
			//create product
			$product = Product::factory()->create(); 
			 
			//simulate the user as auth user 
			$this->actingAs($user);
			
			//call route for add product into cart  
			$response = $this->get('/addToCart/'. $product->id);
			
			$response->assertStatus(302);
			$response->assertSessionHas('success', 'Product added to cart successfully.');
			 
			
		}
		
		//user can increate quantity of product in cart 
		public function test_user_can_increase_quantity_of_product_in_cart()
		{
			$user = User::factory()->create();
			$this->actingAs($user);
			
			$product = Product::factory()->create( );
			$cart = Cart::factory()->create( );
			 
			 
			$response = $this->get('/increaseQuantity/'. $cart->id);
			$response->assertStatus(302);
			
			  
		}
		
		//user can increate quantity of product in cart 
		public function test_quantity_less_then_to_stock()
		{
			$user = User::factory()->create();
			$this->actingAs($user);
			
			$product = Product::factory()->create(['stock'=>2]);
			$cart = Cart::factory()->create([
				'user_id'=> $user->id,
				'product_id'=>$product->id,
				'quantity'=>2,
			]);
			
			$cur_quantity = $cart->quantity;
			 
			$response = $this->get('/increaseQuantity/'. $cart->id);
			$response->assertStatus(302);
			
			$cart->refresh();
			
			$this->assertEquals($cart->quantity, $cur_quantity);
			
			
		}

		//user can increate quantity of product in cart 
		public function test_user_can_decrease_quantity_of_product_in_cart()
		{
			$user = User::factory()->create();
			$this->actingAs($user);
			
			$product = Product::factory()->create( );
			$cart = Cart::factory()->create( );
			 
			 
			$response = $this->get('/decreaseQuantity/'. $cart->id);
			$response->assertStatus(302);
			 
		}
		
		//remove product from cart 
		public function test_remove_product_from_cart()
		{
			$user = User::factory()->create();
			$this->actingAs($user);
			
			
			$products = Product::factory()->count(3)->create();
			$cartItemToRemove = Cart::factory()->create([
					'user_id' => $user->id,
					'product_id' => $products[1]->id,
			]);
			
			// Create other cart items to ensure only the specified one is removed.
			Cart::factory()->create(['user_id' => $user->id]);
			Cart::factory()->create(['user_id' => $user->id]);

			// 2. Action: Hit the endpoint to remove the cart item.
			$response = $this->get('/removeCart/' . $cartItemToRemove->id);
			
			$response->assertStatus(302);
			
			$this->assertDatabaseMissing('carts', ['id'=>$cartItemToRemove->id]);
			$response->assertRedirect(route('userCartList'));
			$response->assertSessionHas('success');
		}
		
		
		//list of product in cart 
		public function test_cart_listing_page()
		{
			$user = User::factory()->create();
			$this->actingAs($user);
			
			$products = Product::factory()->count(10)->create();
			 
			 
			Cart::factory()->count(10)->create(['user_id' => $user->id]); 
			
			$response = $this->get('/cartList');
			
			$response->assertStatus(200);
			$response->assertViewIs('customer.cartList');//check the view 
			$response->assertViewHas('cartList'); //check the view data
			
			$cartList = $response->viewData('cartList');
			
			$this->assertCount(10, $cartList);
			$this->assertEquals($user->id, $cartList->first()->user_id);
			
			foreach($cartList as $cartItem)
			{
				$response->assertSee($cartItem->product->name);
			}
			
			$this->assertEquals('http://localhost/cartList', session('user_back')[0]);//check back session current url is cart list page url
			
		}
}
