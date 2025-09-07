<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Cart;
use App\Models\Product;

//use App\Jobs\CartJob;
use Exception;
class CustomerCartController extends Controller
{
    
	//Function for cart list view
	function cartList()
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
			$cartList = auth()->user()->carts()->orderby('id','DESC')->paginate(10);
			
			foreach ($cartList as  $cart) {
					$cart->product->thumnail = $cart->product->thumnail
					? url(Storage::url('product_thumnail/' . $cart->product->thumnail))  
					: null;
			}
			
			return View('customer/cartList', compact('cartList'));
			 
		}
		catch(Exception $e)
		{ 
			$message = $e->getMessage();
			return View('error', compact('message'));
		} 
	}
	
	
	//function use to add product into cart list 
	function addToCart(Product $productData)
	{ 
		try
		{
			$data['user_id']=auth()->user()->id;
			$data['product_id']=$productData->id;
			$data['quantity']=1;
			$cart = Cart::create($data);
			 
			//$cart=Cart::where('user_id','=',auth()->user()->email)->where('products_id','=',$request->id)->first(); 
			//$mailAddress=auth()->user()->email;
			//dispatch(new CartJob($mailAddress, $cart));
			//return redirect()->route('productDetail',['productCode'=>$productData])->with('success', 'Product Is Added To Cart  Successfully.');
			 return redirect()->back()->with('success', 'Product added to cart successfully.');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	
	//function for increase Quantity in cart
	function increaseQuantity(Cart $cart)
	{
		try
		{ 
			 
			$cart->quantity=$cart->quantity + 1;
			$cart->save();
			return redirect()->route('userCartList')->with('success', 'Quantity Is Updated Successfully.');
			
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	
	//function for decrease Quantity in cart
	function decreaseQuantity(Cart $cart)
	{
		try
		{ 
			if($cart->quantity>0)
			{
				$cart->quantity=$cart->quantity - 1;
			}
			else
			{
				return redirect()->route('userCartList');
			}
			$cart->save();
			return redirect()->route('userCartList')->with('success', 'Quantity Is Updated Successfully.');
			
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}


	//function for remove product from Cart
	function removeCart(Cart $cart)
	{
		try
		{
			$cart->delete(); 
			return redirect()->route('userCartList', [], 301)->with('success', 'Cart Is Deleted  Successfully.');
			 
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
}
