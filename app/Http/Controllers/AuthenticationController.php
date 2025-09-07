<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; 
use Illuminate\Validation\Rules\Password; 
//use models 
use App\Models\User;

use Exception;
class AuthenticationController extends Controller
{
    /*	In this controller all the functions are related to user Authentication.
		loginPage function is use to return login view.
		authenticate function is use to Authentication.
		logoutPage function is use to return view to confirm logout.
		logout function is use to logout.
		 
	*/
	
	//Function to return login registration page
	function loginPage()
	{
		try
		{
			return View('login');
		}
		catch(Exception $e)
		{ 
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	//function for authenticatio onf user
	public function authenticate(Request $request)
	{
		$credentials = $request->validate([
			'email'=>'required|email',
			'password'=>'required',
			]);
			
		try
		{
			$remember=$request->remember;
			$password=Hash::make($request->password);
			$user=User::where('email', $request->email)->first();
			if($user!=null)
			{
			 
				if($user->is_active===1)
				{
					if(Auth::attempt($credentials, $remember))
					{
						$request->session()->regenerate();
						
						if(auth()->user()->user_role == User::USER_ROLE)
						{ 
							if(empty(session('user_back')))
							{
								return redirect()->intended('/');
							}
							else
							{
								$back=session('user_back');
								$pre=$back[count($back)-1];
								  
								return redirect()->intended($pre);
							} 
							
						} 
						elseif(auth()->user()->user_role == User::ADMIN_ROLE)
						{
							return redirect()->route('admin.dashboard');
							 
						}
						else 
						{
							return redirect()->intended('/');
							 
						}
					}
					else
					{
						//return back()->with('danger','The provided credentials do not match our records.');
						return redirect()->route('loginPage')->with('danger', 'The provided credentials do not match our records.');
					}
				}
				else
				{
					return redirect()->route('loginPage')->with('danger', 'User ID is not allowed to login.');
				} 
			}
			else
			{
				return redirect()->route('loginPage')->with('danger', 'User not found.');
			} 
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	
	//Function use to return logout page/view
	function logoutPage()
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
			return View('logout');
		}
		catch(Exception $e)
		{ 
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
		
	}
	//function use to logout user
	function logout(Request $request)
	{
		try
		{
			 
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
}
