@extends('admin/layout')
@section('admin.brandDetail')
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
				<span class="fs-4 fw-bold">Brand / </span>
				<span class="fs-2 fw-bolder ps-1"  >Detail</span>
			</div> 
			
			<div class="d-flex flex-wrap align-items-center pt-4">
			

				<!-- form for update image-->
				 
					@php   
							$brand_image = $brand->image;  
					@endphp
					  
				<img src="{{ $brand_image }}"  alt="brand image"	class="profile_image"   data-bs-toggle="modal" data-bs-target="#brandImageModal" onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';"
  > 
				
				
				<form action="{{route('admin.brandImageUpdate')}}" id="brandImageUpdate"  onsubmit="onSubmitLoader('updating')"  method="post" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="brand_id" value="{{$brand->id}}"> 
					<label for="imageInputID" id="userCustomerBtn" class="btn  mx-2 "  >Change image/logo	</label>
					<input type="file" class="imageInput" id="imageInputID" name="image" 
					onchange="submitForm(event, 'brandImageUpdate')" accept=".jpg, .jpeg, .png" >
				</form>
				<!-- end of form  -->
				
				<!-- a for deactivate and active the category-->
					<a href="{{route('admin.brandDeactive', ['brand' => $brand])}}" class="btn m-1 " id="userVendorBtn"
						onclick="onSubmitLoader('updating')">@if($brand->is_active == 1)De-activate Brand @else Activate Brand @endif</a>	
						 
					
					<!-- a for product list that have selected category-->
					@if($brand->products->count() > 0)
						 
						<a href="{{route('admin.productList', ['filterType' => 'brand', 'filterName' => $brand->id])}}" class="btn m-1 " id="userCustomerBtn"	onclick="onSubmitLoader('searching')">Products</a>	
						 
					@endif
					
					
			</div>
			
			
			 
			<div class="pt-4">
				<form action="{{route('admin.brandDetailUpdate')}}" onsubmit="onSubmitLoader('updating')"  method="POST">
					@csrf
					<input type="hidden" value="{{$brand->id}}" name="brand_id" style="visibility:hidden" />
					
					<div class="row w-100 mx-auto  ">
						<div class="col-12 col-sm-6 ">
							<div class="form-group">
								<label class="form-label   pt-3" for="name_id">Name 
									<span class="text-danger">*</span></label>
								<input type="text" class="form-control login_input"  name="name" id="name_id"  	value="{{$brand->name}}"   autocomplete="off"/>
							</div> 
						</div> 
						 
						<div class="col-12 col-sm-6 pt-3 d-flex align-items-end  ">
							 <button type="submit" class="btn w-100 submit_btn" >Update</button>
						</div> 
					</div> 
				</form>
			</div>
			 
				 
		</div>		
			
		  
	</div>
	
	<!-- model/ div for  brand image or logo-->
	<div class="modal fade" id="brandImageModal" tabindex="-1" aria-labelledby="BrandImageModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="brandImageModalLabel">Brand Image/Logo</h5>
			<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
				<i class="bi bi-x-lg  fw-bolder fs-5 "></i>
			</button>
		  </div>
		  <div class="modal-body">
			 <img src="{{ $brand_image }}"  class="w-100 "   onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';"
 >
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	
	
	<script src="{{asset('vender/js/admin/formSubmit.js')}}"></script> 
	<script>
	
		const element1 = document.getElementById("navigation_link_brands"); 
		const element2 = document.getElementById("navigation_link_brands1"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		
	</script>
	 
</section>
@endsection
