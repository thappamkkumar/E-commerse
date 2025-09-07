@extends('admin/layout')
@section('admin.categoryDetail')
<section class="p-0 pt-2 p-md-4 h-auto">
	<div class="pb-3 px-2 px-md-0"  >
		<a href="{{route('userBack')}}"
			class="btn btn-light fs-6" ><i class="bi bi-arrow-left pe-2"></i>Back</a>
			 
	</div>
	 @if($errors->any())
		<div class="   alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="btn-close float-end  " data-bs-dismiss="alert" aria-label="Close"></button>
			<h3>Errors</h3>
			<ul>
				@foreach($errors->all() as $error)
					<li> {{ $error }} </li>
				@endforeach
			</ul>
		</div>
	@endif 
	@include('alert_box')
	
	
	
	
	<div class="w-100 h-auto p-2 p-md-4 shadow-lg  "  >
		 <div class="    w-100 mx-auto">
		  
			<div class="   border-bottom">
				<span class="fs-4 fw-bold">Category / </span>
				<span class="fs-2 fw-bolder ps-1"  >Detail</span>
			</div>
			<div class="py-3">
			
				<!-- a for deactivate and active the category-->				
			 
				<a href="{{route('admin.categoryDeactive', ['category' => $category])}}" class="btn m-1 " id="userVendorBtn"
						onclick="onSubmitLoader('updating')">@if($category->is_active == 1)De-activate Category @else Activate Category @endif</a>	
									
						
				<!-- Button for product list that have selected category-->
				@if($category->products->count() > 0)
					<a href="{{route('admin.productList', ['filterType' => 'category', 'filterName' => $category->id])}}" class="btn m-1 " id="userCustomerBtn"	onclick="onSubmitLoader('searching')">Products</a>	 
					 
				@endif
			</div>
			<div class="">
				<form action="{{route('admin.categoryDetailUpdate')}}" onsubmit="onSubmitLoader('updating')" method="POST">
					@csrf
					<input type="hidden" value="{{$category->id}}" name="category_id" style="visibility:hidden" />
					
					<div class="row w-100 mx-auto  ">
						<div class="col-12 col-sm-6 ">
							<div class="form-group">
								<label class="form-label   pt-3" for="name_id">Name 
									<span class="text-danger">*</span></label>
								<input type="text" class="form-control login_input"  name="name" id="name_id"  	value="{{$category->name}}"   autocomplete="off"/>
							</div> 
						</div>
						
						 <div class="col-12 col-sm-6 ">
							<div class="form-group">
								<label class="form-label   pt-3" for="gst_id">GST	<span class="text-danger">*</span></label>
								 
								<div class="input-group"> 
									<input type="number" step="0.01" class="form-control login_input"  name="gst" id="gst_id"value="{{$category->gst}}"  required="true" autocomplete="off"/>
									<span class="input-group-text login_input">%</span>
								</div>
							</div> 
						</div>
						 
						<div class="col-12 col-sm-6 ">
							<div class="form-group">
								<label class="form-label   pt-3" for="slug_id">Slug / Keywords <span class="text-danger">*</span></label>
								<textarea  class="form-control login_input" rows="1" name="slug" id="slug_id" >{{$category->slug}}</textarea>
								<!--<input type="text" class="form-control login_input" name="slug" id="slug_id"  value="{{$category->slug}}"   autocomplete="off"/>-->
							</div>
						</div>
						 
							
						 
						<div class="col-12 col-sm-6 pt-3 d-flex align-items-end ">
							 <button type="submit" class="btn w-100 submit_btn"  >Update</button>
						</div> 
					</div> 
				</form>
			</div>
			<div class=" pt-4">
					<h4>Note:</h4>
					<p><strong>Slug / Keywords</strong> are words that help users search for products. For example, if your category name is <strong>"Category,"</strong> a suitable slug might look like <strong>"category1-category2-category3."</strong></p>
					<p>The slug must be a combination of words (separated by hyphens) that are relevant to the category name.</p>
			</div>	 
				 
		</div>		
			
		  
	</div>
	<script src="{{asset('vender/js/admin/formSubmit.js')}}"></script> 
	<script>
	
		const element1 = document.getElementById("navigation_link_categories"); 
		const element2 = document.getElementById("navigation_link_categories1"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		
	</script>
	 
</section>
@endsection
