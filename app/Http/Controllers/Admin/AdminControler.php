<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;


//models

use App\Models\User;  
use App\Models\Customer; 
use App\Models\Product; 
use App\Models\Order;  
use App\Models\Transaction; 
use App\Models\Admin; 

use Exception;
class AdminControler extends Controller
{
	//function for chnage home page image
	function homeImageChange(Request $request)
	{
		$validated_data = $request->validate([ 
			'homeImage'=>'required', 
		]);
		try
		{
			$data = Admin::take(1)->get();
			$data = $data[0];
			//check the logo in exist in folder
			//if exist than delete
			$existingImage = $data->homeImage;
			$Exists = public_path("images/$existingImage");
			if(file_exists($Exists) && !empty($existingImage) ) {
				unlink("images/$existingImage");
			}
			$imageName = 'homeImage.'.$request->homeImage->extension();
			//move image to folder
			$request->homeImage->move(public_path('images/'), $imageName);
			$validated_data['homeImage'] = $imageName;
			$data->update($validated_data);
			return redirect()->route("admin.profile" )->with('success', 'Home Page Image Is Updated Successfully.');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	//function for update home page details
	function homePageDetail(Request $request)
	{
		$validated_data = $request->validate([
			'homeHeading'=>'required',
			'homeDiscount'=>'required|numeric', 
		]);
		try
		{
			$data = Admin::take(1)->get();
			$data = $data[0];
			 
			$data->update($validated_data);
			return redirect()->route("admin.profile" )->with('success', 'Home Page Detail Is Updated Successfully.');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	//function for update payment gateway details
	function updatePaymentGatewayDetail(Request $request)
	{
		$validated_data = $request->validate([
			'merchantId'=>'required',
			'saltKey'=>'required', 
		]);
		try
		{
			$data = Admin::take(1)->get();
			$data = $data[0]; 
			$data->update($validated_data);
			return redirect()->route("admin.profile" )->with('success', 'Payment Gateway Detail Is Updated Successfully.');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	//function for basic details
	function basicDetail(Request $request)
	{
		$validated_data = $request->validate([
			'webSiteName'=>'required',
			'email'=>'required|email',
			'contact'=>'required|numeric',
			'address'=>'required',
			'addressMapUrl'=>'required|url',
			'instagram'=>'required|url',
			'facebook'=>'required|url',
			'youtube'=>'required|url',
			 
		]);
		try
		{
			$data = Admin::take(1)->get();
			$data = $data[0]; 
			$data->update($validated_data);
			return redirect()->route("admin.profile" )->with('success', 'Basic Detail Is Updated Successfully.' );
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	//function for logo change
	function logoChange(Request $request)
	{
		$validated_data = $request->validate([ 
			'logo'=>'required', 
		]);
		try
		{
			$data = Admin::take(1)->get();
			$data = $data[0];
			//check the logo in exist in folder
			//if exist than delete
			$existingLogo = $data->logo;
			$Exists = public_path("logo/$existingLogo");
			if(file_exists($Exists) && !empty($existingLogo) ) {
				unlink("logo/$existingLogo");
			}
			$imageName = 'logo.'.$request->logo->extension();
			//move image to folder
			$request->logo->move(public_path('logo/'), $imageName);
			$data->logo = $imageName;
			$data->save();
			return redirect()->route("admin.profile" )->with('success', 'Logo Is Changed Successfully.');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	//function for profile view
	function profile()
	{
		try
		{
			if(session()->has('user_search_input'))
			{
				session()->forget('user_search_input');
				 
			}
			session(['user_back'=> [url()->full()] ]);
			$data = Admin::take(1)->get();
			$data = $data[0];
			return View('admin.profile', compact('data'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
    //function for dashboard
	function dashboard()
	{
		try
		{
			if(session()->has('user_search_input'))
			{
				session()->forget('user_search_input');
				 
			}
			session(['user_back'=> [url()->full()] ]);
			
			$users=User::count();
			$customers=Customer::count(); 
			$products=Product::count();
			$orders=Order::count();
			$transection=Transaction::count();
			
			$records_total=[
					'users'=>$users, 
					'customers'=>$customers, 
					'products'=>$products,
					'orders'=>$orders,
					
					'transection'=>$transection,
				];
			
			//get user according to months
			$user_list_by_month=User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
						->whereYear('created_at', date('Y'))
						->groupBy('month')
						->orderBy('month')
						->get();
			$userDataByMonth=[]; 
			for($i=1; $i<=12; $i++)
			{ 
				$count=0;
				foreach($user_list_by_month as $order)
				{
					if($order->month == $i)
					{
						$count=$order->count;
					}
				}
				 
				$userDataByMonth[]=$count;
			} 	
			 //get customer according to months
			$customer_list_by_month=Customer::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
						->whereYear('created_at', date('Y'))
						->groupBy('month')
						->orderBy('month')
						->get();
			$customerDataByMonth=[]; 
			for($i=1; $i<=12; $i++)
			{ 
				$count=0;
				foreach($customer_list_by_month as $order)
				{
					if($order->month == $i)
					{
						$count=$order->count;
					}
				}
				 
				$customerDataByMonth[]=$count;
			} 	
			 
			//get products according to months
			$product_list_by_month=Product::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
						->whereYear('created_at', date('Y'))
						->groupBy('month')
						->orderBy('month')
						->get();
			$productDataByMonth=[]; 
			for($i=1; $i<=12; $i++)
			{ 
				$count=0;
				foreach($product_list_by_month as $order)
				{
					if($order->month == $i)
					{
						$count=$order->count;
					}
				}
				 
				$productDataByMonth[]=$count;
			} 	
			//get orders according to months
			$order_list_by_month=Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
						->whereYear('created_at', date('Y'))
						->groupBy('month')
						->orderBy('month')
						->get();
						 
			$orderDataByMonth=[]; 
			for($i=1; $i<=12; $i++)
			{ 
				$count=0;
				foreach($order_list_by_month as $order)
				{
					if($order->month == $i)
					{
						$count=$order->count;
					}
				}
				 
				$orderDataByMonth[]=$count;
			} 	 
			  
			return View('admin.dashboard', compact('records_total', 'userDataByMonth',
			'customerDataByMonth',  'productDataByMonth', 'orderDataByMonth'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}


	//function for changing or updating admin password
	function changeAdminPassword(Request $request)
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
			return redirect()->route('admin.profile')->with('danger', 'Current Password is not exist in our database.');
		}
	}
}
