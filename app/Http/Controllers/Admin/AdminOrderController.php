<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use Exception;
class AdminOrderController extends Controller
{
	//function for order search
	function orderSearch(Request $request)
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
			 

			$orders = Order::whereHas('user', function ($query) use ($searchName) {
				$query->where('email', 'like', '%' . $searchName . '%');
			})
			->orWhereHas('user.customers', function ($customerquery) use ($searchName) {
				$customerquery->where('name', 'like', '%' . $searchName . '%');
			})
			->orWhereHas('product', function ($productquery) use ($searchName) {
				$productquery->where('name', 'like', '%' . $searchName . '%');
			})
			->orderBy('id','DESC')->paginate(10);  
			
			return View('admin/orderList', compact('orders'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	//function for update order status
	
	function orderStatusUpdate(Request $request)
	{
		try
		{
			$order = Order::findorfail($request->order_id);
			$order->order_status = $request->order_status;
			$order->save();
			return redirect()->route("admin.orderDetail", ["order" => $order])->with('success', 'Order Status Is Updated Successfully.');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	//function for order detail 
	function orderDetail(Order $order)
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
			return View('admin/orderDetail', compact('order'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
    //function for order list
	function orderList()
	{
		try
		{
			if(session()->has('user_search_input'))
			{
				session()->forget('user_search_input');
				 
			}
			session(['user_back'=> [url()->full()] ]);
			
			$orders = Order::orderBy('id','DESC')->paginate(10);
			 return View('admin/orderList', compact('orders'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
}
