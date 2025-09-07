<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use Exception;
use Carbon\Carbon;
class AdminPaymentController extends Controller
{
	//function for payment search
	function paymentSearch(Request $request)
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
			
			$searchName = null;
			if(isset($request->userSearchInput))
			{ 
				$searchName = $request->userSearchInput;
				session(['user_search_input'=> $searchName ]);
			}
			else
			{
				$searchName=session('user_search_input'); 
			}
			 

			$payments = Payment::whereHas('user', function ($query) use ($searchName) {
				$query->where('email', 'like', '%' . $searchName . '%');
			})
			->orWhereHas('user.vendors', function ($customerquery) use ($searchName) {
				$customerquery->where('name', 'like', '%' . $searchName . '%');
			}) 
			->orderBy('id','DESC')->paginate(10);  
			
			 return View('admin/paymentList', compact('payments'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
    //function for payment list
	function paymentList()
	{
		try
		{
			if(session()->has('user_search_input'))
			{
				session()->forget('user_search_input');
				 
			}
			session(['user_back'=> [url()->full()] ]);
			
			$payments = Payment::orderBy('id','DESC')->paginate(10);
			 
			 return View('admin/paymentList', compact('payments'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
}
