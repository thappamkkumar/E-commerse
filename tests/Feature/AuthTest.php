<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
		// use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
		
	
		//check registeration of user and check can login or authenticate
		public function test_user_can_register_with_valid_data()
		{
			 $this->withoutMiddleware();
			$response = $this->post('/addUser',[
				'name' => 'Mukesh',
				'email' => 'mukesh@example.com',
				'password' => 'mukesh;06',
				'contact' => '987654321033',  
			]);
			
			//dump($response->json());
		
			//check database for new user
		 	$this->assertDatabaseHas('users', ['email'=>'mukesh@example.com']);
			 
		}
	
		
}
