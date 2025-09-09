<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class UserProfileTest extends TestCase
{
    // use RefreshDatabase;
		
		//Authenticated user can view profile
		public function test_authenticated_user_can_view_profile()
		{
			$user = User::where('email', 'komal123@email.com')->first();
			 
			//simmulate the user
			$this->actingAs($user);
			
			$response = $this->get('/profile');
			//dd($response);
			$response->assertStatus(200);
			$response->assertSee($user->email);
			$response->assertSee($user->mobile_number);
		}
		
		// Unauthorized user cannot access profile page 
		public function test_unauthorized_user_cannot_access_profile_page()
		{
			 
			
			$response = $this->get('/profile');
			$response->assertRedirect('/login');
		}
		
		
		//Authenticated user can update profile info  
		public function test_authenticated_user_can_update_profile()
		{
			 
			$user = User::where('email', 'komal123@email.com')->first();
			 
			//simmulate the user
			$this->actingAs($user);
			
			$newData = [
				'name'=>'komal sharma',
				'contact'=>'9090908976',
				
			];
			$response = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)->post('updateUserProfileDetails', $newData);
			if ($response->status() >= 400) {
					//dd('Error: '.$response->status(), $response->getContent());
			}
			  
      $response->assertSessionHas('success', 'User Profile Updated Successfully!');
			
			$user->refresh();//refresh user from db
			
			$this->assertEquals('komal sharma', $user->customers->name);
			$this->assertEquals('9090908976', $user->mobile_number);
			
		}
		
		
		
		
}
