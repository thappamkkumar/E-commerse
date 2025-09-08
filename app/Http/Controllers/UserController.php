<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator;

//use models 
use App\Models\User;
use App\Models\Customer;
//use App\Models\Vendor;

use Exception;
class UserController extends Controller
{
    /*	In this controller all the functions are related to user registeration.
		sendOTP function is use to send otp to user 
		emailCheck function is use to check user entered email is unique within the user database table. It send false if email is already exist.
		addUser function is use to add user data into database table
	*/
	
	//Function to return login registration page
	function registerPage()
	{
		try
		{
			return view('register');
		}
		catch(Exception $e)
		{ 
			$message = $e->getMessage();
			return view('error', compact('message'));
		}
	}
	
	 
	 
	//Function to add new User
	function addUser(Request $request)
	{
	 ;
		 // ? Validate the data first
    $validator = Validator::make($request->all(), [
        'name'     => 'required',
        'email'    => 'required|unique:users,email',
        'password' => 'required', 
        'contact'  => 'required|max:15',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'false',
            'errors' => $validator->errors()
        ], 422);
    }

    $validated_data = $validator->validated();
		
		$userData = [
        'email'             => $validated_data['email'],
        'password'          => Hash::make($validated_data['password']),
        'mobile_number'     => $validated_data['contact'],
        'user_role'         => User::USER_ROLE,
        'email_verified_at' => now(),
    ];
		
		/*$validated_data=$request->except('_token');
		 
		$userData = [];
		$userData['email'] = $validated_data['email'];
		$userData['password'] = Hash::make($request->password);
		$userData['mobile_number'] = $validated_data['contact'];
		$userData['user_role'] = User::USER_ROLE;
		$userData['email_verified_at'] = now();*/
		
		try
		{
			
			$user = User::create($userData); 
			 

				$customerData = [];
				$customerData['user_id'] = $user->id; 
				$customerData['name'] = $validated_data['name']; 
				$customerData['area_street_sector_village'] = ""; 
				$customerData['flat_houseno_building_company'] = ""; 
				$customerData['landmark'] = ""; 
				$customerData['district'] = ""; 
				$customerData['state'] = ""; 
				$customerData['country'] = ""; 
				$customerData['pincode'] = ""; 
				$customerData['profile_image'] = "";  
				
				Customer::create($customerData);  
 			 
			$data = ['status' => 'true'];
			return response()->json($data);  
			//return redirect()->route('loginPage')->with('Success', 'Account is created successfully.');
				
		}
		catch(Exception $e)
		{
			//return redirect()->route('registerPage')->with('danger', $e->getMessage());
			$data = ['status' => 'false'];
			return response()->json($data);	
		}
		 
	}
	
}
