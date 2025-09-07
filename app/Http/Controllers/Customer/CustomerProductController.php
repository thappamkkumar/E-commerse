<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Review;
use App\Models\Categories;

use Exception;
class CustomerProductController extends Controller
{
    /*
		this controller have function related to customer product operations.
		productSearch function is use to search product
		product rating function is use to rate or review the product
		productDetail function is use to get product detail
		productListForUser is use to get product list and view of product nav/meneu
		categoriesList for category list
		categoryProductForUser for product of specific category
	*/

	//function for product of specific category
	function categoryProduct(Categories $category)
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
			$products = $category->products()->paginate(18);
			$categoryName = $category->name;
			
			foreach ($products as  $product) {
					$product->thumnail = $product->thumnail
					? url(Storage::url('product_thumnail/' . $product->thumnail))  
					: null;
			}
			
			return view('customer/categoryProduct', compact('products', 'categoryName'));
		}
		catch(Exception $e)
		{ 
			$message = $e->getMessage();
			return View('error', compact('message'));
		} 
	}
	

	//function for category list
	function categoriesList()
	{
		try
		{
			session(['user_back'=> [url()->full()] ]);
			if(session()->has('user_search_input'))
			{
				session()->forget('user_search_input');
				 
			}
			
			$categories = Categories::where('is_active',1)->orderBy('id','DESC')->paginate(50);
			 
			return view('customer/categoriesList', compact('categories'));
		 
		}
		catch(Exception $e)
		{ 
			$message = $e->getMessage();
			return View('error', compact('message'));
		} 
	}


	//function is use to get product list and view of product
	function productListForUser()
	{
		try
		{
			session(['user_back'=> [url()->full()] ]);
			if(session()->has('user_search_input'))
			{
				session()->forget('user_search_input');
				 
			}
			
			$products = Product::where('is_active',1)->orderBy('id','DESC')->paginate(20);
			
			foreach ($products as  $product) {
					$product->thumnail = $product->thumnail
					? url(Storage::url('product_thumnail/' . $product->thumnail))  
					: null;
			}
			
			
			return view('customer/productList', compact('products'));
		 
		}
		catch(Exception $e)
		{ 
			$message = $e->getMessage();
			return View('error', compact('message'));
		} 
	}
	
	
	//function for product details.
	function productDetail(Product $productCode)
	{	
		try
		{ 
			$userID = auth()->user()->id;
			//session delete that are created when buying product
			if(session()->has('user_address'))
			{
				session()->forget('user_address');
				 
			}
			 
			if(session()->has('order_product_detail'))
			{
				session()->forget('order_product_detail');
				 
			}
			//for back button
			$prepage=session('user_back');
			$pre=$prepage[count($prepage)-1];
			if($pre!==url()->full())
			{
				$prepage[]=url()->full();
			}
			session(['user_back'=> $prepage ]);
			
			 
			//just asign productCode to product
			$product=$productCode;
			//decode json to use in view tenmple
		 
			$images= json_decode($product->images);
			 if (is_array($images)) {
					foreach ($images as $key => $image) {
							$images[$key] = $image
									? url(Storage::url('product_images/' . $image))
									: null;
					}
			}
			$product['images']= $images;
			
				//decode json to use in view tenmple
			$product->specification = json_decode($product->specification);
			
			
			
			// get avg of product rating 
			//$productAvgRating = ceil($product->reviews->avg('rating'));
			//check the user has saved the product into cart or not
			//$cartTrue = auth()->user()->carts->where('product_id',$product->id)->count() > 0;
			
			$rating_list = $product->reviews->take(20);
			foreach ($rating_list as $review) {
							$review->user->customers->profile_image = $review->user->customers->profile_image
									? url(Storage::url('user_profile/' . $review->user->customers->profile_image))
									: null;
					}
			$product->reviews = $rating_list;
			//return auth()->user()->reviews->where('product_id',$product->id);
			/*foreach($rating_list as $rating_review)
			{
				if(count($rating_review->user->customers) > 0)
				{
				echo $rating_review->user->customers[0]->profile_image;echo"</br>";
				}
			}*/
			 
			 //Add product discount
			  if($product->sale_price != null || $product->sale_price != 0)
			  {
				$product['discount'] = round((1 - $product->sale_price / $product->price) * 100);
			  }
			  else
			  {
				  $product['discount'] = 0;
			  }
			 /*if($product->sale_price != null || $product->sale_price != 0)
			  {
				$product['gst'] = round((1 - $product->category->gst / $product->sale_price) * 100);
			  }
			  else
			  {
				  $product['gst'] = round((1 - $product->category->gst / $product->price) * 100);
			  }*/
				if ($product->sale_price != null && $product->sale_price != 0) {
					// Calculate GST amount based on sale price
						$product['gst'] = round($product->sale_price * ($product->category->gst / 100), 2);
				} else {
						// Calculate GST amount based on regular price
						$product['gst'] = round($product->price * ($product->category->gst / 100), 2);
				}

			 $sameProducts = Product::where('categories_id',$product->categories_id )->where('is_active','=',1)->take(6)->get();
			
			foreach ($sameProducts as  $sameProduct) {
					$sameProduct->thumnail = $sameProduct->thumnail
					? url(Storage::url('product_thumnail/' . $sameProduct->thumnail))  
					: null;
			}
			
			return view('customer/productDetail',compact('product', 'rating_list', 'sameProducts'));
	 	}
		catch(Exception $e)
		{
			 
			$message = $e->getMessage();
			return View('error', compact('message'));
		} 
	}
	
	
	//function for add rating
	function productRating(Request $request)
	{
		try
		{
			if(Auth::check())
			{
				$validated_data = $request->validate([
					'review'=>'required|string|max:100', 
				]);
				$validated_data['user_id']=auth()->user()->id;
				$validated_data['product_id']=$request->product_id;
				if($request->rating>0)
				{
					$validated_data['rating']=$request->rating;
				}
				else
				{
					$validated_data['rating']=1;
				}
				$user_rating=Review::where('user_id', '=', auth()->user()->id)->where('product_id', '=', $request->product_id)->first();
				if(empty($user_rating))
				{
					$result=Review::create($validated_data);
				}
				else
				{
					 $user_rating->update($validated_data);
				}
				
				return redirect()->route('productDetail',['productCode'=>$request->product_id])->with('success', 'Rating Is Added  Successfully.');
			}
			else 
			{
				return redirect()->route('user_login')->with('danger', 'Login For Rating The Project.');
			}
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	

	//function is use to search product
	function productSearch(Request $request)
	{
		try
		{
			 $search = $request->search_input ?? session('user_search_input');
        session(['user_search_input' => $search]);

        $products = Product::query()
            ->where('is_active', 1)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('slug', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('category', function ($catQuery) use ($search) {
                            $catQuery->where('name', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('brand', function ($brandQuery) use ($search) {
                            $brandQuery->where('name', 'LIKE', '%' . $search . '%');
                        });
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate(18);
			
			 
			$prepage=session('user_back');
			$pre=$prepage[count($prepage)-1];
			$cur_page=$products->url($products->currentPage());
			if($pre!==$cur_page)
			{
				$prepage[]=$cur_page;
			}
			session(['user_back'=> $prepage ]);
			
			foreach ($products as  $product) {
					$product->thumnail = $product->thumnail
					? url(Storage::url('product_thumnail/' . $product->thumnail))  
					: null;
			}
			
			return view('customer/productSearch', compact('products'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
		 
	}


}
