<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;
class CustomerProfileController extends Controller
{
    //function for user profile view
	function userProfile()
	{
		try
		{
			$prepage=session('user_back');
			$pre=$prepage[count($prepage)-1];
			if($pre!==url()->full())
			{
				$prepage[]=url()->full();
			}
			session(['user_back'=> $prepage ]);
			 
			return View('customer/userProfile');
		}
		catch(Exception $e)
		{ 
			$message = $e->getMessage();
			return View('error', compact('message'));
		} 
		
	}
	//function for change user profile image
	public function change_profile_image(Request $request)
	{  
		 $validated_data = $request->validate([
			'profile_image'=>'required|mimes:jpg,jpeg,png',
			 
		]);
		try
		{
			$user = auth()->user()->customers; 
			$existingProfile = $user->profile_image;
			  
			
			//check the profile image exist. if true then delete 
			$imagePath = 'user_profile/' . $existingProfile;
			if (Storage::disk('public')->exists($imagePath)) {  
				Storage::disk('public')->delete($imagePath);
			} 
			
			//get user email and generate name for image
			$user_email=strstr(auth()->user()->email,'@',true);		 
			$imageName=$user_email.'_profile_image.'.$request->profile_image->extension();
			
			$request->profile_image->storeAs('user_profile', $imageName, 'public');
			
			
			
			$validated_data['profile_image']=$imageName;
			$user->update($validated_data);
			
			
			
			return redirect()->route('userProfile')->with('success', 'Profile Image Is Changed Successfully.');
		 
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		} 
	}
	//function for change password
	public function change_user_password(Request $request)
	{
		
		if(Hash::check($request->password,auth()->user()->password))
		{
			
			$validated_data=$request->validate([
				'new_password'=>['required',Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
				'password_confirm' => 'required|same:new_password',
			]);
			try
			{
				$validated_data['password']=Hash::make($request->new_password);
				 
				auth()->user()->update(['password'=>$validated_data['password']]);
				Auth::logout();
				$request->session()->invalidate();
				$request->session()->regenerateToken();
				return redirect('/');
			}
			catch(Exception $e)
			{
				$message = $e->getMessage();
				return View('error', compact('message'));
			}
		}
		else
		{
			return redirect()->route('userProfile')->with('danger', 'Current Password is not exist in our database.');
		}
	}
	//function for update profile detail
	public function update_details(Request $request)
	{
		$validated_data = $request->validate([
			'name'=>'required',
			'email'=>'required|email', 
			'contact'=>'numeric|nullable', 
			 
		]);
		try
		{
			 
			auth()->user()->update(['mobile_number'=>$validated_data['contact']]);
			auth()->user()->customers->update(['name'=>$validated_data['name']]);
			
			return redirect()->route('userProfile')->with('success', 'User Profile Updated Successfully!');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
				return View('error', compact('message'));
		}
	}
	
	
	//function for update address
	function updateAddress(Request $request)
	{
		$validated_data = $request->validate([
			'area_street_sector_village'=>'required',
			'flat_houseno_building_company'=>'required',
			'landmark'=>'required',
			'district'=>'required',
			'state'=>'required',
			'country'=>'required',
			'pincode'=>'required',
		]);
		try
		{	 
			$user = auth()->user();
			$user->customers->update($validated_data);
			 
			return redirect()->route('userProfile')->with('success', 'User Address Is Updated Successfully!');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
				return View('error', compact('message'));
		}
	}
}
