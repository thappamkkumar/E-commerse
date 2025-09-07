@extends('customer/layout')
@section('userProfile')
<main>
	<section class="  profile_container  ">
		     
		<!-- start div for profile -->
		<div class=" mx-auto profile">
				@if($errors->any())
                    <div class=" w-100 mx-auto alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
							<h3>Errors</h3>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
					@include('alert_box')
				<div class="row  py-5 ">
					<!--start div for profile image-->
					<div class="col-12 col-lg-6    ">
						<div class="bg-white  shadow-lg p-4 w-100 h-100 rounded  d-flex justify-content-center align-items-center flex-column" >
							@php   
									$user_image = auth()->user()->customers->profile_image ? url(Storage::url('user_profile/' . auth()->user()->customers->profile_image)) : null;
								      
							@endphp
							<img src="{{$user_image}}"  class="   profile_image"   alt="{{auth()->user()->customers->name}} image"      onerror="this.onerror=null;this.src='{{ asset('images/profile_icon.png') }}';">
								 
							  
							
							<div class="d-flex flex-column justify-content-center align-items-center py-2">
								<h5 class=""   >{{auth()->user()->customers->name}}</h5> 
								<a href="mailto:{{auth()->user()->email}}" class="text-decoration-none text-muted"   ><i class="bi bi-envelope  fw-bold"></i> <span class="text-muted">{{auth()->user()->email}}</span></a>
								<a href="tel:{{auth()->user()->mobile_number}}" class="text-decoration-none text-muted"   ><i class="bi bi-telephone  fw-bold"></i> <span class="text-muted">{{auth()->user()->mobile_number}}</span></a>
							</div>
							<div class="text-center d-flex flex-wrap"  >
								@php   
									$user_profile_image = auth()->user()->customers->profile_image ? url(Storage::url('user_profile/' . auth()->user()->customers->profile_image)) : null
									 
								@endphp
								 
								<form action="{{route('user_profile_image_change')}}" id="changeLogoForm"  method="POST" enctype="multipart/form-data">
									@csrf
									 <label class="btn border-0 profile_detail_update_btn" for="imageInputID"   >
										 @if($user_profile_image != null)Change Image @else Add Image @endif
									</label>
									 <input type="file" style="display:none;" id="imageInputID" name="profile_image"  onchange="submitForm(event,'changeLogoForm')" >
									  
								</form>
								  
								<button type="button" class="btn border-0 profile_detail_update_btn"  data-bs-toggle="modal" data-bs-target="#changePasswordModel"  
									 >Change Password</button> 
								<button type="button" class="btn border-0 profile_detail_update_btn"  data-bs-toggle="modal" data-bs-target="#updateBasicDetailModel"  
									 >Update Details</button>  
							</div>
						</div>
					</div>
					<!--end div for profile image-->
					<!--start div for profile details-->
					<div class="col-12 col-lg-6  py-3 py-lg-0">
						
						<div class="bg-white  rounded shadow-lg p-4  w-100 h-100  d-flex justify-content-center align-items-center flex-column" >
							<h3>Address</h3>
							<table class="table  ">
								<tbody>
									<tr >
										<th class="w-50">Country</th><td class="w-50 bg-light">{{auth()->user()->customers->country}}</td>
									</tr>
									<tr >
										<th class="w-50">State</th><td class="w-50 bg-light">{{auth()->user()->customers->state}}</td>
									</tr>
									<tr >
										<th class="w-50">District</th><td class="w-50 bg-light">{{auth()->user()->customers->district}}</td>
									</tr>
									<tr >
										<th class="w-50">Pin Code</th><td class="w-50 bg-light">{{auth()->user()->customers->pincode}}</td>
									</tr>
									<tr >
										<th class="w-50">Area, Street, Sector, Village</th><td class="w-50 bg-light">{{auth()->user()->customers->area_street_sector_village}}</td>
									</tr>
									<tr >
										<th class="w-50">Flat, House No., Building, Company</th><td class="w-50 bg-light">{{auth()->user()->customers->flat_houseno_building_company}}</td>
									</tr>
									 
								</tbody>
							</table>
							<div class="py-2 w-100 text-center">
								<button type="button" class="btn w-100 submit_btn"  data-bs-toggle="modal" data-bs-target="#updateAddressModel"  >
										@if(empty(auth()->user()->customers->district) || auth()->user()->customers->district==NULL || auth()->user()->customers->district==' ')
											Add Address
										@else 
											Update Address
										@endif
								</button>	 
								 
							</div>
						</div>
					</div>
				</div>
				<!--end div for profile details-->
		</div>
		<!-- end div for profile -->
		
		
		@include('customer/userProfileUpdate')
	</section>
	<script>
		const element1 = document.getElementById("navigation_link_profile"); 
		const element2 = document.getElementById("navigation_link_profile1");  
		element1.classList.add("active_navigation_link");
		element2.classList.add("active_navigation_link");
	</script>  
</main>
@endsection