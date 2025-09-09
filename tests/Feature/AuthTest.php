<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash; 
use Tests\TestCase;
use App\Models\User;

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
		
		// User can log in with correct credentials
		public function test_user_can_login_with_correct_credentials()
		{
				$this->withoutMiddleware();
				$credentials = [
					'email'=>'mukesh@example.com',
					'password'=>'mukesh;06',
				];
				
				 // Try to log in with correct credentials
				$response = $this->withSession([])->post('/authenticate',$credentials);
				
				//dd(session()->all()); 
				$response->assertStatus(200);

				$user = User::where('email', $credentials['email'])->first();
					 
				//  User should be authenticated
				$this->assertAuthenticatedAs($user);
				
					  
		}
		
		//User cannot log in with wrong password
		public function test_user_cannot_login_with_wrong_password()
		{
			$this->withoutMiddleware();
				$credentials = [
					'email'=>'mukesh@example.com',
					'password'=>'mukesh;06s',
				];
			
			// Try to log in with correct credentials
				$response = $this->withSession([])->post('/authenticate',$credentials);
				
				  
				// Assert ? user should NOT be authenticated
        $this->assertGuest();
				
				// Assert ? flash error message is set
        $response->assertSessionHas('danger', 'The provided credentials do not match our records.');
		}
	
	
		//Logged-in user can log out successfully
		public function test_logged_in_user_can_logout_successfully()
		{
			
			$this->withoutMiddleware();
			$credentials = [
									'email'=>'mukesh@example.com',
									'password'=> Hash::make('mukesh;06'),
									];
									
			$user = User::where('email', $credentials['email'])
			 ->first();
			
			$this->actingAs($user);//simulate login user

			$response = $this->get('/logout');
			 
			if ($response->status() >= 400) {
					dd('Error: '.$response->status(), $response->getContent());
			}
			//assert user is logged out 
			$this->assertGuest();
			
			//alternative check 
			$this->assertFalse(auth()->check());
			
		}
		
}
