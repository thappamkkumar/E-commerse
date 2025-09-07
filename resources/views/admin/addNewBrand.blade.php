<div class="w-100 h-auto   my-3 px-1 px-md-4 py-4  shadow collapse   " id="add_container">
	<div class="d-flex flex-wrap justify-content-between align-items-center">
		<h3 class="  " >Add New Brand</h3>
		<button type="button" class="btn  p-0 px-2 btn-light   border-0  " 
					data-bs-toggle="collapse" data-bs-target="#add_container"><i class="bi bi-x-lg  fw-bolder fs-5 "></i></button>
	</div>
	
	<form action="{{route('admin.addNewBrand')}}"  onsubmit="onSubmitLoader('uploading')"  method="post" enctype="multipart/form-data">
		@csrf
		<div class="row w-100 mx-auto align-items-end  py-2 ">
			<div class="col-12 col-sm-4  py-1 ">
				 <label class="form-label   " for="name_id">Brand Name <span class="text-danger">*</span></label>
				<input type="text" class="form-control login_input"  name="name" id="name_id" required="true" autocomplete="off"/>
			</div>
			<div class="col-12 col-sm-4 py-1"> 
				<label class="form-label   " for="slug_id">Logo/Image <span class="text-danger">*</span></label> 
				<input type="file" class="form-control login_input"  name="image" id="image_id" required="true" autocomplete="off"/>
			</div>
			
			 
			<div class="col-4 col-sm-4 py-2">
				<button type="submit" class="btn   w-100   submit_btn"  >Submit</button>
			</div>
		</div>
	</form>
	 
 
</div>