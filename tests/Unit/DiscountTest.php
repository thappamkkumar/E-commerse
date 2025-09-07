<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DiscountTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
		
		//apply discount on orignal price
		public function test_percentage_discount_is_applied_correctly()
		{
			$orignal_price = 1000;
			$discount = 20;
			
			$final_price = $orignal_price - ($orignal_price * ($discount/100));
			
			$this->assertEquals(800, $final_price);
		}
	
}
