<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Categories;

use Exception;
class AdminCategoriesController extends Controller
{
	//Function for de-activate and active 
	function categoryDeactive(Categories $category)
	{
		try
		{
			$category->is_active = $category->is_active ^ 1;
			$category->save();
			if($category->is_active == 0)
			{
				return redirect()->route("admin.categoryDetail", ["category" => $category])
				->with('success', 'Categories Is De-activated Successfully.'); 
			}
			else
			{
				return redirect()->route("admin.categoryDetail", ["category" => $category])
				->with('success', 'Categories Is activated Successfully.');  
			}
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}

	//Function for category detail update 
	function categoryDetailUpdate(Request $request)
	{
		$validated_data = $request->validate([ 
			'name'=>'required',
			'slug'=>'required',			
			'gst'=>'required',			
			 
			 
		]);
		try
		{
			$categories = Categories::findorfail($request->category_id);
			$categories->update($validated_data);
			return redirect()->route("admin.categoryDetail", ["category" => $categories])->with('success', 'Categories Is Updated Successfully.'); 
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}


	//Function for category detail view
	function categoryDetail(Categories $category)
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
			return View('admin/categoryDetail', compact('category'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		} 
	}


	//Function for add new category
	function addNewCategory(Request $request)
	{
		$validated_data = $request->validate([ 
			'name'=>'required',
			'slug'=>'required',			
			'gst'=>'required',			
			 
			 
		]);
		try  
		{ 
			  Categories::create($validated_data); 
			 return redirect()->route('admin.categoryList')->with('success', 'New Categories Is Added Successfully.'); 
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}
  
	
	//Function for category list
	function categoryList()
	{
		try
		{
			if(session()->has('user_search_input'))
			{
				session()->forget('user_search_input');
				 
			}
			session(['user_back'=> [url()->full()] ]);
			  
			$categories = Categories::orderBy('id','DESC')->paginate(10);
			 return View('admin/categoryList', compact('categories'));
		}
		catch(Exception $e)
		{
			$message = $e->getMessage();
			return View('error', compact('message'));
		}
	}


}
