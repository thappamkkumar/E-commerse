<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
		
		// calculate tax price 
		public function test_tax_calculation()
		{
			$amount = 1000;
			$tax = 18;
			$tax_amount = $amount * ($tax / 100);
			
			$this->assertEquals(180,$tax_amount);
			
		}
}
