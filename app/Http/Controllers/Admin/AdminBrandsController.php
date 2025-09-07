<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands; 
use Exception;
class AdminBrandsController extends Controller
{ 
	//Function for brands list
	function brandList()
	{
		try
		{
			if(session()->has('user_search_input'))
			{
				session()->forget('user_search_input');
				 
			}
			session(['user_back'=> [url()->full()] ]);
			  
			$brands = Brands::orderBy('id','DESC')->paginate(10);
			return View('admin/brandList', compact('brands'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	// function to add new brand
	function addNewBrand(Request $request)
	{
		$validated_data = $request->validate([ 
			'name'=>'required',
			'image'=>'required|image|mimes:jpeg,png,jpg', 	 
			 
		]);
		try  
		{ 
			// Create new Brand
			$brand = new Brands();
			$brand->name = $validated_data['name'];
			$brand->save();
			
			//get brand name
			$brandName=  str_replace(' ', '_',  $brand->name);
		
			// Generate unique filename for image file
			$fileName =  $brandName.'_image_'.$brand->id.'.'. $request->image->extension();

			// Store image
		 // $request->file('image')->move(public_path('brands'), $fileName);
			$request->image->storeAs('brands', $fileName, 'public');
			
			// Store image name in brand data
			$brand->image = $fileName;
			$brand->save();
			 return redirect()->route('admin.brandList')->with('success', 'New Brand Is Added Successfully.'); 
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
		//Function for brand detail view
	function brandDetail(Brands $brand)
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
			
			$brand->image = $brand->image
				? url(Storage::url('brands/' . $brand->image))  
				: null;
			
			
			return View('admin/brandDetail', compact('brand'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		} 
	}
	
	
	//Function for de-activate and active 
	function brandDeactive(Brands $brand)
	{
		try
		{
			$brand->is_active = $brand->is_active ^ 1;
			$brand->save();
			if($brand->is_active == 0)
			{
				return redirect()->route("admin.brandDetail", ["brand" => $brand])
				->with('success', 'Brand Is De-activated Successfully.'); 
			}
			else
			{
				return redirect()->route("admin.brandDetail", ["brand" => $brand])
				->with('success', 'Brand Is activated Successfully.');  
			} 
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}


	//Function for brand detail update 
	function brandDetailUpdate(Request $request)
	{
		$validated_data = $request->validate([ 
			'name'=>'required',
			 
		]);
		try
		{
			$brand = Brands::findorfail($request->brand_id);
			$brand->update($validated_data);
			return redirect()->route("admin.brandDetail", ["brand" => $brand])->with('success', 'Brand Is Updated Successfully.'); 
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	//Function for brand detail update 
	function brandImageUpdate(Request $request)
	{
		$validated_data = $request->validate([ 
		'image'=>'required|image|mimes:jpeg,png,jpg', 
		]);
		try
		{
			$brand = Brands::findorfail($request->brand_id);
			//check image is exist or not. if exist then delete from directory first before updating image
			$existingImage= $brand->image;
			/*$ImageExists = public_path("brands/$existingImage");
			if(file_exists($ImageExists) && !empty($existingImage)) {
				unlink("brands/$existingImage");
			}*/
			$imagePath = 'brands/' . $existingImage;
			if (Storage::disk('public')->exists($imagePath)) {  
				Storage::disk('public')->delete($imagePath);
			} 
			
			// Get brand name
			$brandName=  str_replace(' ', '_',  $brand->name);
			
			// Generate unique filename for image
			$imageName = $brandName.'_image_'.$brand->id.'.'.$request->image->extension();
			// Store image
			//$request->file('image')->move(public_path('brands'), $imageName);
			$request->image->storeAs('brands', $imageName, 'public');
			
			
			$brand->image =  $imageName;
			$brand->save();
			return redirect()->route("admin.brandDetail", ["brand" => $brand])->with('success', 'Brand Is Updated Successfully.'); 
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
	
	
}
