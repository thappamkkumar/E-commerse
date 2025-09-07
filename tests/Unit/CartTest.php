<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    
	//calculate discount
  public function test_discount_calculation()
	{
			$price = 1000;
			$discount = 0.1; // 10%
			$final = $price - ($price * $discount);

			$this->assertEquals(900, $final);
	}
	
	//calculate total price of items
	public function test_cart_items_total_price_calculation()
	{
		$cart = [
			["price" => 100, "quantity" => 2],
			["price" => 500, "quantity" => 5],
		];
		
		$total = 0;
		for($i = 0; $i < count($cart); $i++)
		{
			$product = $cart[$i];
			$total += $product['price'] * $product['quantity'];
		} 
		 
		
		$this->assertEquals(2700, $total);
		
	}
	
	
	
	//update quantity and check total
	public function test_cart_total_updates_when_quantity_changes()
	{
		$cart = [
			["price" => 100, "quantity" => 2],
			["price" => 500, "quantity" => 5],
		];
		
		$total = 0;
		forEach($cart as $item)
		{
			 
			$total += $item['price'] * $item['quantity'];
		}  
		$this->assertEquals(2700, $total);
		
		
		//quantity update
		
		$cart[1]['quantity'] = 3;
		
		$total = 0;
		forEach($cart as $item)
		{
			 
			$total += $item['price'] * $item['quantity'];
		}  
		$this->assertEquals(1700, $total);
		
		
	}
	
	//check cart is empty then total is also zero
	public function test_empty_cart_total_is_zero()
	{
		$cart = [
		 
		];
		
		$total = 0;
		forEach($cart as $item)
		{
			 
			$total += $item['price'] * $item['quantity'];
		}  
		$this->assertEquals(0, $total);
	}
	
	//add product add to cart if stock available
	public function test_product_can_be_added_if_stock_is_available()
	{
		$stock = 10;
		$req_qty = 5;
		
		$can_add = $req_qty <= $stock;

			$this->assertTrue($can_add);
			
	}
	
	//add product cannot to be add in cart if stock insufficient
	public function test_product_cannot_be_added_if_stock_is_insufficient()
	{
		$stock = 10;
		$req_qty = 15;
		
		$can_add = $req_qty <= $stock;

		$this->assertFalse($can_add);
			
	}
	
 

}
