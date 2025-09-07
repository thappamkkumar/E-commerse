<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
		
		
		//calculating average of product rating 
		public function test_product_rating_average_calculation()
		{
			$rating = [2,5,3,5,2,1,3,2,1,4,5];
			$avg = array_sum($rating) / count($rating);
			
			$this->assertEquals(3,$avg);
		}
		
		
		//check product is available
		public function test_product_availability_status()
		{
			$stock = 0;
			$isAvailable  = $stock > 0;
			$this->assertFalse($isAvailable);//it will pass when isAvailable is false, mean 0 stock
		
			$stock = 5;
			$isAvailable  = $stock > 0;
			$this->assertTrue($isAvailable);//it will pass when isAvailable is true, mean have stock
		
		}
}
