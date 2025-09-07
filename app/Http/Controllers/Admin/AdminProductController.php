<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\User;
use Exception;
class AdminProductController extends Controller
{
	//function for product de-activate and activate
	function productDeactivate(Product $product)
	{
		try
		{ 
			$product->is_active= $product->is_active ^ 1;
			$product->save();
			if($product->is_active == 0)
			{ 
				return redirect()->route("admin.productDetail", ["product" => $product])->with('success', 'Product Is De-actived Successfully.');
			}
			else
			{
				return redirect()->route("admin.productDetail", ["product" => $product])->with('success', 'Product Is Actived Successfully.');
			}	
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		};		
	}
	
	
	//function for product search
	function productSearch(Request $request)
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
			$products = Product::where('name', 'like', "%$searchName%")->orderBy('id','DESC')->paginate(10);
			return View('admin/productSearch', compact('products'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	//Function for product details
	function productDetail(Product $product)
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
			
			$product->specification = json_decode($product->specification);
			
			$product->thumnail = $product->thumnail
			? url(Storage::url('product_thumnail/' . $product->thumnail))  
			: null;
				
			$images = json_decode($product->images); 
			if (is_array($images)) {
					foreach ($images as $key => $image) {
							$images[$key] = $image
									? url(Storage::url('product_images/' . $image))
									: null;
					}
			}
			$product->images = $images;

			$rating_list = $product->reviews->take(20);
			foreach ($rating_list as $review) {
							$review->user->customers->profile_image = $review->user->customers->profile_image
									? url(Storage::url('user_profile/' . $review->user->customers->profile_image))
									: null;
					}
			$product->reviews = $rating_list;
			
			return View('admin/productDetail', compact('product'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
  
	//Function for product list
	function productList($filterType, $filterName)
	{
		try
		{
			if(session()->has('user_search_input'))
			{
				session()->forget('user_search_input');
				 
			}
			$prepage=session('user_back');
			$pre=$prepage[count($prepage)-1];
			if($pre!==url()->full())
			{
				$prepage[]=url()->full();
			}
			session(['user_back'=> $prepage ]);
			
			$products;
			 $allProduct=0;
			if($filterType == 'brand')
			{ 
				$products = Product::where('brand_id',$filterName)->orderBy('id','DESC')->paginate(10); 
			}
			elseif($filterType == 'category')
			{  
				$products = Product::where('categories_id',$filterName)->orderBy('id','DESC')->paginate(10);
			}
			else
			{ 
				$products = Product::orderBy('id','DESC')->paginate(10);
				$allProduct=1;
			}
			 
			$categories = Categories::distinct()->get();
			$brands = Brands::distinct()->get();			
			return View('admin/productList', compact('products','categories','brands','allProduct'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	
	
	
	
	//function for product de-activate and activate
	function addProduct( )
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
			$categories = Categories::where('is_active', 1)->get();
			$brands = Brands::where('is_active', 1)->get();
			return View('admin/addProduct', compact('categories','brands'));
			
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}	
	}
	
	
	
	//function for store a product
	function storeProduct(Request $request)
	{
		// for specification and session 
		$specification=[];
		$request->session()->forget('specification_data');
		for($i=1;$i<=$request->total_specification;$i++)
		{
			$heading="specification_heading_".$i;
			$detail="specification_detail_".$i;
			 
			if(!empty($request->$heading) || $request->$heading!=="" || $request->$heading!=" ")
			{
				$specification[]= $request->$heading;
				$specification[]= $request->$detail;
			} 
			 		
		}
		session(['specification_data'=>$specification]);
		// Validate form data
		$validatedData = $request->validate([
			'name' => 'required|string|max:255',
			'categories_id' => 'required|exists:categories,id',
			'brand_id' => 'required|exists:brands,id',
			'slug' => 'required|string|unique:products|max:255',
			'price' => 'required|numeric|min:0',
			'stock' => 'required|numeric|min:0',
			'sale_price' => 'nullable|numeric|lt:price|min:0',
			'delivery_charges' => 'nullable|numeric|lt:price|min:0',
			'description' => 'required|string',
			'video_url' => 'required',
			'thumnail' => 'required|image|mimes:jpeg,png,jpg',  
			'images'=>'required|array|max:10',
			'images.*'=>'mimes:jpg,jpeg,png',
		]);
		// Create new product
		$product = new Product();
		$product->name = $validatedData['name'];
		$product->slug = str_replace(' ', '-',  $validatedData['slug']);
		$product->categories_id = $validatedData['categories_id'];
		$product->brand_id = $validatedData['brand_id'];
		 
		$product->price = $validatedData['price'];
		$product->stock = $validatedData['stock'];
		$product->sale_price = $validatedData['sale_price'];
		$product->delivery_charges = $validatedData['delivery_charges'] ?? 0;
		$product->description = $validatedData['description'];
		$product->video_url = $validatedData['video_url'];
		$product->specification = json_encode($specification);
		$product->save();
		
		$productName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->name);

		
		// Generate unique filename for thumbnail
		$thumbnailName =  $productName.'_thumbnail_'.$product->id.'.'. $request->thumnail->extension();

		// Store thumbnail
		//$thumbnailPath = $request->file('thumnail')->move(public_path('product_thumnail'), $thumbnailName);
		$request->thumnail->storeAs('product_thumnail', $thumbnailName, 'public');
			
			
		// Store thumbnail name in validated data
		$validatedData['thumnail'] = $thumbnailName;

		// Store images
		$imagePaths = [];$count_image=1;
		if ($request->hasFile('images'))
		{
			foreach ($request->file('images') as $image) {
				// Generate unique filename for each image
				$imageName =  $productName.'_image_'.$product->id.'_'. $count_image++ . '.' . $image->extension();
				 
				//$imagePath = $image->move(public_path('product_images'), $imageName);
				$image->storeAs('product_images', $imageName, 'public');
		
				$imagePaths[] = $imageName;
			}
		}

		// Store image names in validated data
		$validatedData['images'] = $imagePaths;

		

		 
		
		$product->thumnail = $thumbnailName;
		$product->images = json_encode($imagePaths); 
		$product->save();
		// Delete the specification_data session variable if it exists
			if (session()->has('specification_data')) {
				session()->forget('specification_data');
			}
		return redirect()->route('admin.productList', ['filterType'=>'product', 'filterName'=>'all'])->with('success', 'Product added Successfully.');
	
	}
	 
	
	
	//function for update specification Updated
	function productSpecificationUpdate(Request $request)
	{
		try
		{ 
			$product = Product::findOrFail($request->product_id);
			// for specification and session 
			$specification=[]; 
			for($i=1;$i<=$request->total_specification;$i++)
			{
				$heading="specification_heading_".$i;
				$detail="specification_detail_".$i;
				 
				if(!empty($request->$heading) || $request->$heading!=="" || $request->$heading!=" ")
				{
					$specification[]= $request->$heading;
					$specification[]= $request->$detail;
				} 
						
			}
			 
			$product->specification = json_encode($specification);
			$product->save();
			return redirect()->route("admin.updateProduct", ["product" => $product])->with('success', 'Product Specification Is Updated Successfully.');
			
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}	
	}


	//function for update product vedio urldecode
	function productVedioUrlUpdate(Request $request)
	{ 
		$validatedData = $request->validate([ 
			'video_url' => 'required',
			 
		]);
		try
		{ 
			$product = Product::findOrFail($request->product_id);
			$product->video_url =  $validatedData['video_url'];
			$product->save();
			return redirect()->route("admin.updateProduct", ["product" => $product])->with('success', 'Product Vedio Url Is Updated Successfully.');
			
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}	
	}
	

	//function for update product description
	function productDescriptionUpdate(Request $request)
	{
		// Validate form data
		$validatedData = $request->validate([
			'description' => 'required|string', 
		]);
		try
		{ 
			$product = Product::findOrFail($request->product_id);
			$product->description = $validatedData['description'];
			$product->save();
			return redirect()->route("admin.updateProduct", ["product" => $product])->with('success', 'Product Description Is Updated Successfully.');
			
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}	
	}
	

	//function for update product basic detail
	function productBasicDetailUpdate(Request $request)
	{
		// Validate form data
		$validatedData = $request->validate([
			'name' => 'required|string|max:255',
			'categories_id' => 'required|exists:categories,id',
			'brand_id' => 'required|exists:brands,id',
			'slug' => 'required|string',
			'price' => 'required|numeric|min:0',
			'stock' => 'required|numeric|min:0',
			'sale_price' => 'nullable|numeric|lt:price|min:0',
			'delivery_charges' => 'nullable|numeric|lt:price|min:0',
			 
		]);
		try
		{ 
			$product = Product::findOrFail($request->product_id);
			$product->name = $validatedData['name'];
			if($product->slug == $validatedData['slug'])
			{
				$product->slug = str_replace(' ', '-',  $validatedData['slug']);
			}
			$product->categories_id = $validatedData['categories_id'];
			$product->brand_id = $validatedData['brand_id'];
			$product->price = $validatedData['price'];
			$product->stock = $validatedData['stock'];
			$product->sale_price = $validatedData['sale_price'];
			$product->delivery_charges = $validatedData['delivery_charges'] ?? 0;
			 
			 
			$product->save();
			return redirect()->route("admin.updateProduct", ["product" => $product])->with('success', 'Product Basic Detail Is Updated Successfully.');
			
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}	
	}


	//function for delete all image of product
	function deleteProductAllImage(Product $product)
	{
		try
		{   
			$product = Product::findOrFail($product->id);
			//Selrct image that going to Updated
			$productImages = json_decode($product->images); 
			
			if (!empty($productImages)) 
			{
				foreach ($productImages as $existingImage)
				{  
					/*$imageExists = public_path("product_images/$existingImage");
					if(file_exists($imageExists) && !empty($existingImage)) {
						unlink("product_images/$existingImage");
					}*/
					
					$imagePath = 'product_images/' . $existingImage;
					if (Storage::disk('public')->exists($imagePath)) {  
						Storage::disk('public')->delete($imagePath);
					} 
				}
			}
			  
			$product->images = null;
			$product->save();
			return redirect()->route("admin.updateProduct", ["product" => $product])->with('success', 'Product Images Are Deleted Successfully.');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}


	//function for add images if product has less then 10
	function productImagesADD(Request $request)
	{
		try
		{  
			//get product with request product id
			$product = Product::findOrFail($request->product_id);
			//Select image that going to Updated
			$productImages = json_decode($product->images); 
			 
			
			$countImage = (empty($product->images))? 10 : 10 - count($productImages);
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
		
		$validatedData = $request->validate([ 
			'images'=>'required|array|max:'.$countImage,
			'images.*'=>'mimes:jpg,jpeg,png',
		]);
		
		try
		{  
			 // Get product name
			//$productName=  str_replace(' ', '_',  $product->name);
			$productName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $product->name);

			// Store images
			$count_image=(empty($product->images))? 1 : count($productImages)+1;
			if ($request->hasFile('images')) {
				foreach ($request->file('images') as $image) {
					// Generate unique filename for each image
					$imageName = $productName.'_image_'.$product->id.'_'. $count_image++ . '.' . $image->extension();
					 
					//$imagePath = $image->move(public_path('product_images'), $imageName);
					$image->storeAs('product_images', $imageName, 'public');
			
					
					$productImages[] = $imageName;
				}
			}
			$product->images = $productImages;
			$product->save();
			return redirect()->route("admin.updateProduct", ["product" => $product])->with('success', 'Product Image Is Add Successfully.');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	

	//function for product images Update
	function productImagesUpdate(Request $request)
	{
		$validatedData = $request->validate([ 
			'image' => 'required|image|mimes:jpeg,png,jpg', 
			 
		]);
		try
		{  
			//get product with request product id
			$product = Product::findOrFail($request->product_id);
			//Selrct image that going to Updated
			$productImages = json_decode($product->images);
			$pre_image = $productImages[$request->pre_image - 1];
			
			//check image is exist or not. if exist then delete from directory first before updating image
		 /*	$existingImage= $pre_image;
			$imageExists = public_path("product_images/$existingImage");
			if(file_exists($imageExists) && !empty($existingImage)) {
				unlink("product_images/$existingImage");
			}*/
			$imagePath = 'product_images/' . $pre_image;
			if (Storage::disk('public')->exists($imagePath)) {  
				Storage::disk('public')->delete($imagePath);
			} 
		 	
			// Get product name
			//$productName=  str_replace(' ', '_',  $product->name);
			$productName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $product->name);

			
			// Generate unique filename for each image
			$imageName = $productName.'_image_'.$product->id.'_'. $request->pre_image . '.' . $request->image->extension();
			//$imagePath = $request->image->move(public_path('product_images'), $imageName);
			$request->image->storeAs('product_images', $imageName, 'public');
			
			$productImages[$request->pre_image - 1] = $imageName; 
			$product->images = $productImages;
			$product->save();
		

			return redirect()->route("admin.updateProduct", ["product" => $product])->with('success', 'Product Image Is Updated Successfully.');
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	

	//function for product thumanil Update
	function productThumnailUpdate(Request $request)
	{
		$validatedData = $request->validate([ 
			'thumnail' => 'required|image|mimes:jpeg,png,jpg', 
			 
		]);
		try
		{ 
			
			$product = Product::findOrFail($request->product_id);
			//check thumnail is exist or not. if exist then delete from directory first before updating thumnail
			$existingThumnail= $product->thumnail;
			/*$thumnailExists = public_path("product_thumnail/$existingThumnail");
			if(file_exists($thumnailExists) && !empty($existingThumnail)) {
				unlink("product_thumnail/$existingThumnail");
			}*/
			
			$imagePath = 'product_thumnail/' . $existingThumnail;
			if (Storage::disk('public')->exists($imagePath)) {  
				Storage::disk('public')->delete($imagePath);
			} 
			
			
			
			// Get product name
			//$productName=  str_replace(' ', '_',  $product->name);
			$productName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $product->name);

			// Generate unique filename for thumbnail
			$thumbnailName = $productName.'_thumbnail_'.$product->id.'.'.$request->thumnail->extension();
			// Store thumbnail
			//$thumbnailPath = $request->file('thumnail')->move(public_path('product_thumnail'), $thumbnailName);
			$request->thumnail->storeAs('product_thumnail', $thumbnailName, 'public');
			
			
			$product->thumnail =  $thumbnailName;
			$product->save();
			return redirect()->route("admin.updateProduct", ["product" => $product])->with('success', 'Product Thumbnail Is Updated Successfully.');
			
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}		
	}


	//function for update product-
	function updateProduct(Product $product)
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
			 
			$product->specification = json_decode($product->specification);
			$categories = Categories::where('is_active', 1)->get();
			$brands = Brands::where('is_active', 1)->get();
			
			$product->thumnail = $product->thumnail
			? url(Storage::url('product_thumnail/' . $product->thumnail))  
			: null;
				
			$images = json_decode($product->images); 
			if (is_array($images)) {
					foreach ($images as $key => $image) {
							$images[$key] = $image
									? url(Storage::url('product_images/' . $image))
									: null;
					}
			}
			$product->images = $images;

			
			return View('admin/productUpdate', compact('product', 'categories','brands'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}		
	}
	
	
}
