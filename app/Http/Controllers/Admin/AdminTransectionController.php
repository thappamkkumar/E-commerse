<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction;
use Exception;
class AdminTransectionController extends Controller
{
	//function for transection detail 
	function transectionDetail(Transaction $transection)
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
			
			 
			 //return $transection;
			return View('admin/transectionDetail', compact('transection'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	//function for transection search
	function transectionSearch(Request $request)
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
			 

			$transections = Transaction::whereHas('user', function ($query) use ($searchName) {
				$query->where('email', 'like', '%' . $searchName . '%');
			})
			->orWhereHas('user.customers', function ($customerquery) use ($searchName) {
				$customerquery->where('name', 'like', '%' . $searchName . '%');
			})
			->orWhereHas('product', function ($productquery) use ($searchName) {
				$productquery->where('name', 'like', '%' . $searchName . '%');
			})
			->orWhere('transaction_id', $searchName)
			->orderBy('id','DESC')->paginate(10);  
			
			return View('admin/transectionList', compact('transections'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
    //function for transection list
	function transectionList()
	{
		try
		{
			if(session()->has('user_search_input'))
			{
				session()->forget('user_search_input');
				 
			}
			session(['user_back'=> [url()->full()] ]);
			
			$transections = Transaction::orderBy('id','DESC')->paginate(10);
			 return View('admin/transectionList', compact('transections'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
}
