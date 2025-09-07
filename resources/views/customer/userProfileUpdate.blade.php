<!-- model/ div for password update/change-->
<div class="modal fade" id="changePasswordModel" tabindex="-1" aria-labelledby="changePasswordModel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title" id="productImageLabel"> Change Password</h4>
		<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
			<i class="bi bi-x-lg  fw-bolder fs-5 "></i>
		</button>
	  </div>
	  <div class="modal-body">
		 
		<form action="{{route('change_user_password')}}" method="POST"  onsubmit="onSubmitLoader('updating')">
			@csrf
			<label class="form-label pt-2" for="password">Current Password</label>
			<input type="password" name="password" id="password"  class="form-control  login_input">
			
			 
			<label class="form-label pt-2" for="new_password">New Password</label>
			<input type="text" name="new_password" id="new_password"     placeholder="G;ir43tg:S"   class="form-control  login_input"  required="" autocomplete="off">
			
			<label class="form-label pt-2" for="password_confirm">Re-enter Password</label>
			<input type="text" name="password_confirm" id="password_confirm"       class="form-control  login_input"  required="" autocomplete="off">
			
			 
			
			<div class="py-3">
				<input type="submit" value="Change Password"     class="btn w-100 submit_btn mb-4">
			</div>
				 
		</form>
	  </div>
	   
	</div>
  </div>
</div>




<!-- model/ div for  update basic details-->
<div class="modal fade" id="updateBasicDetailModel" tabindex="-1" aria-labelledby="updateBasicDetailModel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title" id="productImageLabel">Update Basic Details</h4>
		<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
			<i class="bi bi-x-lg  fw-bolder fs-5 "></i>
		</button>
	  </div>
	  <div class="modal-body">
		 
		<form action="{{route('user_profile_update')}}" method="POST" onsubmit="onSubmitLoader('updating')">
			@csrf
			<label class="form-label pt-2" for="name">Name</label>
			<input type="text" name="name" id="name"  value="{{auth()->user()->customers->name}}"    class="form-control  login_input"  required autocomplete="off" >
			
			<label class="form-label pt-2" for="email">Email ID</label>
			<input type="text" name="email" id="email"   value="{{auth()->user()->email}}"   class="form-control  login_input"  readonly autocomplete="off" >
			
			 
			<label class="form-label pt-2" for="contact">Contact Number</label>
			<input type="tel" name="contact" id="contact"  value="{{auth()->user()->mobile_number}}"   class="form-control  login_input"  required="" autocomplete="off" >
			
			
			
			
			<div class="py-3">
				<input type="submit" value="Update"     class="btn w-100 submit_btn mb-4">
			</div>
				 
		</form>
	  </div>
	   
	</div>
  </div>
</div>






<!-- model/ div for  update address -->
<div class="modal  fade" id="updateAddressModel" tabindex="-1" aria-labelledby="updateAddressModel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title" id="productImageLabel">Address</h4>
		<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
			<i class="bi bi-x-lg  fw-bolder fs-5 "></i>
		</button>
	  </div>
	  <div class="modal-body">
		 
		<form action="{{route('updateAddress')}}" method="POST" onsubmit="onSubmitLoader('updating')" >
			@csrf
			<label class="form-label pt-2" for="country_id">Country</label>
			<input type="text" name="country" id="country_id"  value="{{auth()->user()->customers->country}}"     class="form-control  login_input"  required autocomplete="off" >
			
			<label class="form-label pt-2" for="state_id">State</label>
			<input type="text" name="state" id="state_id"  value="{{auth()->user()->customers->state}}"     class="form-control  login_input"  required autocomplete="off" >
			
 
			<label class="form-label pt-2" for="district_id">District</label>
			<input type="text" name="district" id="district_id"  value="{{auth()->user()->customers->district}}"     class="form-control  login_input"  required autocomplete="off" >
			 
			
			<label class="form-label pt-2" for="pincode_id">Pincode</label>
			 <input type="text" name="pincode" id="pincode_id"  value="{{auth()->user()->customers->pincode}}"     class="form-control  login_input"  required autocomplete="off" >
			 
			
			<label class="form-label pt-2" for="area_street_sector_village_id">Area, Street, Sector, Village</label>
			 <input type="text" name="area_street_sector_village" id="area_street_sector_village_id"  value="{{auth()->user()->customers->area_street_sector_village}}"    class="form-control  login_input"  required autocomplete="off" >
			 
			
			<label class="form-label pt-2" for="flat_houseno_building_company_id">Flat, House No., Building, Company</label>
			 <input type="text" name="flat_houseno_building_company" id="flat_houseno_building_company_id"  value="{{auth()->user()->customers->flat_houseno_building_company}}"    class="form-control  login_input"  required autocomplete="off" >
			 
			 <label class="form-label pt-2" for="landmark_id">Landmark</label>
			 <input type="text" name="landmark" id="landmark_id"  value="{{auth()->user()->customers->landmark}}"    class="form-control  login_input"  required autocomplete="off" >
			 
			
			
			<div class="py-3">
				<input type="submit" value="Update"     class="btn w-100 submit_btn mb-4">
			</div>
				 
		</form>
	  </div>
	   
	</div>
  </div>
</div>
