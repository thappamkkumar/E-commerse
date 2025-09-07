@extends('admin/layout')
@section('admin.profile')
<section class="p-0 pt-2 p-md-4 h-auto parent_add_container" >


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
	
	 
	 
	
	<div class="w-100 h-auto p-1 p-md-4 shadow-lg  " >
		
		<div class="  border-bottom">
			<span class="fs-4 fw-bold">Admin / </span> 
			<span class="fs-2 fw-bolder ps-1"  >Profile</span>
		</div>
		<!-- Logo Container-->
		<!-- <div class="  p-2 d-flex flex-wrap flex-row-reverse align-items-center">
			 
			<div class="  ps-sm-2 py-3  h-auto"> 
			 <img src="{{asset('logo/'.$data->logo)}}"  data-bs-toggle="modal" data-bs-target="#imageModel" onclick="showImage(this.src, 'Logo')" 	class="profile_image"    > 
			</div>
			 
			<div class="d-flex flex-wrap flex-sm-row-reverse  flex-row h-auto">
				<form action="{{route('admin.logoChange')}}" id="logoForm" method="post"    enctype="multipart/form-data">
					@csrf
					 <label for="logoInputID" class="btn m-1 " id="userCustomerBtn">
					Change Logo</label>
					 <input type="file" class="imageInput" id="logoInputID" name="logo" onchange="submitForm(event,'logoForm')" >
				</form> 
				
			</div>
			
		</div>
		-->
		<!-- Basic Details-->
		<div class="w-100 h-auto p-2">
			<h3 class="py-2">Basic Details</h3>
			<form action="{{route('admin.basicDetail')}}" method="post" onsubmit="onSubmitLoader('updating')" >
			@csrf
				<div class="row w-100 mx-auto align-items-end">
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="webSiteName_id">Website Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control form_input" name="webSiteName" id="webSiteName_id"     value="{{$data->webSiteName}}"  autocomplete="off"/>
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="email_id">Email <span class="text-danger">*</span></label>
						<input type="email" class="form-control form_input" name="email" id="email_id"     value="{{$data->email}}"  autocomplete="off"/>
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="contact_id">Mobile Number <span class="text-danger">*</span></label>
						<input type="text" class="form-control form_input" name="contact" id="contact_id"     value="{{$data->contact}}"  autocomplete="off"/>
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="address_id">Address <span class="text-danger">*</span></label>
						<input type="text" class="form-control form_input" name="address" id="address_id"     value="{{$data->address}}"  autocomplete="off"/>
					</div> 
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="addressMapUrl_id">Address Map <span class="text-danger">*</span></label>
						<input type="url" class="form-control form_input" name="addressMapUrl" id="addressMapUrls_id"     value="{{$data->addressMapUrl}}"  autocomplete="off"/>
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="instagram_id">Instagram <span class="text-danger">*</span></label>
						<input type="url" class="form-control form_input" name="instagram" id="instagram_id"     value="{{$data->instagram}}"  autocomplete="off"/>
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="facebook_id">Facebook <span class="text-danger">*</span></label>
						<input type="url" class="form-control form_input" name="facebook" id="facebook_id"     value="{{$data->facebook}}"  autocomplete="off"/>
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="youtube_id">Youtube <span class="text-danger">*</span></label>
						<input type="url" class="form-control form_input" name="youtube" id="youtube_id"     value="{{$data->youtube}}"  autocomplete="off"/>
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<button type="submit" class="btn w-100 submit_btn">Update</button>
					</div>
					
				</div>
			</form>
		</div>
		<!-- Payment Gateway Details-->
		<div class="w-100 h-auto p-2">
			<h3 class="py-2">Payment Gateway Details</h3>
			<form action="{{route('admin.updatePaymentGatewayDetail')}}" method="post" onsubmit="onSubmitLoader('updating')" >
			@csrf
				<div class="row w-100 mx-auto align-items-end">
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="merchantId_id">Merchant Id <span class="text-danger">*</span></label>
						<input type="text" class="form-control form_input" name="merchantId" id="merchantId_id"     value="{{$data->merchantId}}"  autocomplete="off"/>
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="saltKey_id">Salt Key <span class="text-danger">*</span></label>
						<input type="text" class="form-control form_input" name="saltKey" id="saltKey_id"     value="{{$data->saltKey}}"  autocomplete="off"/>
					</div>
					 
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<button type="submit" class="btn w-100 submit_btn">Update</button>
					</div>
					
				</div>
			</form>
		</div>
		
		<!-- Home Page Image-->
		<!--
		<div class="w-100 h-auto p-2">
			<h3 class="py-2">Home Page Image</h3>
			<div class="  p-2 d-flex flex-wrap align-items-center">
		-->
		<!-- Image-->
		<!--	<div class="  ps-sm-2 py-3  h-auto"> 
			 <img src="{{asset('images/'.$data->homeImage)}}"  data-bs-toggle="modal" data-bs-target="#imageModel" onclick="showImage(this.src, 'Home Page Image')" 	class="profile_image"    > 
			</div>
			--><!-- form to change LOGO -->
		<!--	<div class="d-flex flex-wrap flex-sm-row-reverse  flex-row h-auto">
				<form action="{{route('admin.homeImageChange')}}" id="homeImageForm" method="post"  enctype="multipart/form-data">
					@csrf
					 <label for="homeImageInputID" class="btn m-2 " id="userVendorBtn">
					Change Image</label>
					 <input type="file" class="imageInput" id="homeImageInputID" name="homeImage" onchange="submitForm(event,'homeImageForm')" >
				</form> 
				
			</div>
			
		</div>
		</div>-->
		<!-- Home Page Content-->
		<!--<div class="w-100 h-auto p-2">
			<h3 class="py-2">Home Page Content</h3>
			<form action="{{route('admin.homePageDetail')}}" method="post" onsubmit="onSubmitLoader('updating')"  enctype="multipart/form-data">
			@csrf
				<div class="row w-100 mx-auto align-items-end">
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="homeHeading_id">Home Page Heading <span class="text-danger">*</span></label>
						<input type="text" class="form-control form_input" name="homeHeading" id="homeHeading_id"     value="{{$data->homeHeading}}"  autocomplete="off"/>
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="homeDiscount_id">Home Page Discount <span class="badge text-bg-light">%</span>  <span class="text-danger">*</span></label> 
							<input type="text" class="form-control form_input" name="homeDiscount" id="homeDiscount_id"     value="{{$data->homeDiscount}}"  autocomplete="off"/> 
					</div>
					   
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<button type="submit" class="btn w-100 submit_btn">Update</button>
					</div>
					
				</div>
			</form>
		</div>-->
		
		<!-- change password-->
		<div class="w-100 h-auto p-2">
			<h3 class="py-2">Change Password</h3>
			<form action="{{route('admin.changeAdminPassword')}}" method="post" onsubmit="onSubmitLoader('updating')" >
			@csrf
				<div class="row w-100 mx-auto align-items-end">
					<div class="col-12 col-md-6 col-xl-4 py-2">
					 <label class="form-label  " for="password">Current Password<span class="text-danger">*</span></label>
						<input type="password" name="password" id="password"  class="form-control  form_input"> 
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
					 <label class="form-label  " for="new_password">New Password<span class="text-danger">*</span></label>
						<input type="text" name="new_password" id="new_password"     placeholder="G;ir43tg:S"   class="form-control  form_input"  required="" autocomplete="off">
					</div>
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<label class="form-label " for="password_confirm">Re-enter Password<span class="text-danger">*</span></label>
						<input type="text" name="password_confirm" id="password_confirm"       class="form-control  form_input"  required="" autocomplete="off">
			
			 
					</div>
					 
					<div class="col-12 col-md-6 col-xl-4 py-2">
						<button type="submit" class="btn w-100 submit_btn">Update</button>
					</div>
					
				</div>
			</form>
		</div>
		
	</div>
	
	<!-- model/ div for  LOGO and HOME IMAGE-->
	<div class="modal fade" id="imageModel" tabindex="-1" aria-labelledby="imageModel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="imageLabel">Image</h5>
			<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
				<i class="bi bi-x-lg  fw-bolder fs-5 "></i>
			</button>
		  </div>
		  <div class="modal-body">
			 <img src=" "  class="w-100 "  id="imageModel_ImageID"  >
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	 
	<script> 
		const element1 = document.getElementById("navigation_link_profile1"); 
		const element2 = document.getElementById("navigation_link_profile2"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		
		 
		 //function for change image in model
		function showImage(img, imgType)
		{
			document.getElementById('imageModel_ImageID').src = img;
			document.getElementById('imageLabel').innerHTML = imgType;
		}
	</script>
	  
</section>
@endsection
