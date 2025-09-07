@extends('admin/layout')
@section('admin.userProfile')
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
	
	
	
	<div class="w-100 h-auto p-2 p-md-4 shadow-lg  " >
		 <div class="row   w-100 mx-auto">
		 <!-- heading for user according to thier role-->
			<div class="col-12  border-bottom  ">
				<span class="fs-4 fw-bold ">User / </span>
				<span class="fs-2 fw-bolder ps-1  "  >Profile</span>
			</div>
			
				<div class="col-12  p-2 d-sm-flex flex-wrap flex-row-reverse align-items-center">
					<!-- User Image  -->
					@if($user->user_role == 3)
						@php   
							$user_image = $user->customers->profile_image;  
						@endphp
					@endif
					
					 
					 
					<div class="  ps-sm-2 py-3  h-auto"> 
						<img src="{{$user_image}}"  data-bs-toggle="modal" data-bs-target="#profileImageModal"	class="profile_image"    onerror="this.onerror=null;this.src='{{ asset('images/profile_icon.png') }}';"> 
					</div>
					
					
					<div class="d-flex flex-wrap flex-sm-row-reverse  flex-row h-auto">
						<!-- form to change user profile image-->
						<form action="{{route('admin.userProfileImageChange')}}" id="userProfileImageForm" method="post"   enctype="multipart/form-data">
							@csrf
							<input type="hidden" value="{{$user->id}}" name="userID" style="visibility:hidden" />
							 <label for="imageInputID" class="btn m-1 " id="userCustomerBtn">
							  Change Image  </label>
							 <input type="file" class="imageInput" id="imageInputID" name="image" onchange="submitForm(event,'userProfileImageForm')" >
							 
						</form>
						<!--  <button type="button" class="btn m-2" id="userCustomerBtn"
							onclick='window.location.href =  `{{route("admin.userProfile", ["user" => $user])}}`;'>
							Change Image</button>   -->
							
							
							
						<!-- a for update use is activate or deactivate--> 
						<a href="{{route('admin.userDeActivate', ['user' => $user])}}" class="btn m-1 " id="userVendorBtn"
						onclick="onSubmitLoader('updating')">@if($user->is_active == 1)De-activate Account @else Activate Account @endif</a>	
							
							
							
						<!-- form for user orders-->
						@if($user->user_role == 3 && $user->orders->count() > 0)
							<form action="{{route('admin.orderSearch')}}" method="POST" onsubmit="onSubmitLoader('searching')" >
								@csrf
								<input type="hidden" name="userSearchInput"   value = "{{$user->email}}"   autocomplete="off"/>
								<button type="submit" class="btn m-1" id="addUserBTN">Orders</button> 
							</form>
							@endif
							@if($user->user_role == 3 && $user->transactions->count() > 0)
							<form action="{{route('admin.transectionSearch')}}" method="POST" onsubmit="onSubmitLoader('searching')" >
								@csrf
								<input type="hidden" name="userSearchInput"   value = "{{$user->email}}"   autocomplete="off"/>
								<button type="submit" class="btn m-1" id="addUserBTN">Transection</button> 
							</form>
							@endif
							 
						</div>
					</div>
					<div class="col-12  py-4"> 
						 	<!--Customer Data -->
							<h1>User Details</h1>
							
							<form action="{{route('admin.updateCustomer')}}" onsubmit="onSubmitLoader('updating')" method="POST">
								@csrf
								<input type="hidden" value="{{$user->id}}" name="userID" style="visibility:hidden" />
								
								<div class="row w-100 mx-auto  ">
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label class="form-label   pt-3" for="name_id">Name <span class="text-danger">*</span></label>
											<input type="text" class="form-control login_input"  name="name" id="name_id"  value="{{$user->customers->name}}"   autocomplete="off"/>
										</div>
									</div>
									<div class="col-12 col-sm-6  ">
										<div class="form-group">
											<label class="form-label   pt-3"  >Email <span class="text-danger">*</span></label>
											<input type="text" class="form-control login_input"  value="{{$user->email}}" readonly/>
										</div>
									</div>
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label class="form-label   pt-3" for="mobile_number_id">Mobile Number <span class="text-danger">*</span></label>
											<input type="text" class="form-control login_input" name="mobile_number" id="mobile_number_id"   value="{{$user->mobile_number}}"   autocomplete="off"/>
										</div>
									</div>
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label class="form-label   pt-3" for="area_street_sector_village_id">Area, Street, Sector, Village <span class="text-danger">*</span></label>
											<input type="text" class="form-control login_input" name="area_street_sector_village" id="area_street_sector_village_id"  value="{{$user->customers->area_street_sector_village}}"   autocomplete="off"/>
										</div>
									</div>
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label class="form-label   pt-3" for="flat_houseno_building_company_id">Flat, House no., Building, Company <span class="text-danger">*</span></label>
											<input type="text" class="form-control login_input" name="flat_houseno_building_company" id="flat_houseno_building_company_id"    value="{{$user->customers->flat_houseno_building_company}}"   autocomplete="off"/>
										</div>
									</div>
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label class="form-label   pt-3" for="district_id">District <span class="text-danger">*</span></label>
											<input type="text" class="form-control login_input" name="district" id="district_id"     value="{{$user->customers->district}}"  autocomplete="off"/>
										</div>
									</div>
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label class="form-label   pt-3" for="state_id">State <span class="text-danger">*</span></label>
											<input type="text" class="form-control login_input" name="state" id="state_id"    value="{{$user->customers->state}}"   autocomplete="off"/>
										</div>
									</div>
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label class="form-label   pt-3" for="country_id">Country <span class="text-danger">*</span></label>
											<input type="text" class="form-control login_input" name="country" id="country_id"    value="{{$user->customers->country}}"   autocomplete="off"/>
										</div>
									</div>
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label class="form-label   pt-3" for="pincode_id">Pincode <span class="text-danger">*</span></label>
											<input type="text" class="form-control login_input" name="pincode" id="pincode_id"     value="{{$user->customers->pincode}}"  autocomplete="off"/>
										</div>
									</div>
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label class="form-label   pt-3" for="landmark_id">Landmark <span class="text-danger">*</span></label>
											
											<input type="text" class="form-control login_input" name="landmark" id="landmark_id"    value="{{$user->customers->landmark}}"   autocomplete="off"/>
										</div>
									</div> 
									<div class="col-12  col-sm-6 py-3 ">
										 <button type="submit" class="btn w-100 submit_btn"  >Update</button>
									</div> 
								</div> 
							</form>
							
						 
					
				</div>
				
			
		 </div>
	</div>
	
	<!-- model/ div for user profile-->
	<div class="modal fade" id="profileImageModal" tabindex="-1" aria-labelledby="profileImageModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="profileImageModalLabel">Profile Image</h5>
			<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
				<i class="bi bi-x-lg  fw-bolder fs-5 "></i>
			</button>
		  </div>
		  <div class="modal-body"> 
			 <img src="{{$user_image}}"  	class="w-100 " onerror="this.onerror=null;this.src='{{ asset('images/profile_icon.png') }}';"   >
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	<script src="{{asset('vender/js/admin/formSubmit.js')}}"></script> 
	<script>
		 
		const element1 = document.getElementById("navigation_link_users"); 
		const element2 = document.getElementById("navigation_link_users1"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		 
	</script>
	 
</section>
@endsection
