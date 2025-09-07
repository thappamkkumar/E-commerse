<div class="w-100 h-auto   my-3 px-1 px-md-4 py-4  shadow collapse   " id="add_container">
	<div class="d-flex flex-wrap justify-content-between align-items-center">
		<h3 class="  " >Add New User</h3>
		<button type="button" class="btn  p-0 px-2 btn-light   border-0  " 
					data-bs-toggle="collapse" data-bs-target="#add_container"><i class="bi bi-x-lg  fw-bolder fs-5 "></i></button>
	</div>
	
	<form action="{{route('admin.addNewUser')}}" onsubmit="onSubmitLoader('uploading')"  method="post">
		@csrf
		<div class="row w-100 mx-auto align-items-end  ">
			 
			<div class="col-12 col-sm-4 py-1">
				<label class="form-label   " for="email_id2">Email <span class="text-danger">*</span></label>
				<input type="email" class="form-control login_input"  name="email" id="email_id2" required="true" autocomplete="off"/>
			</div>
			
			<div class="col-12 col-sm-4 py-1">
					<label class="form-label    " for="password_id2">Password <span class="text-danger">*</span></label>
					<input type="text" class="form-control login_input"  name="password" id="password_id2" required="true" autocomplete="off"/>
			</div>
			<div class="col-12 col-sm-4  py-1">
				<button type="submit" class="btn   w-100   submit_btn"  >Submit</button>
			</div>
		</div>
	</form>
	 
 
</div>