<div class="w-100 h-auto   my-3 px-1 px-md-4 py-4  shadow collapse   " id="add_container">
	<div class="d-flex flex-wrap justify-content-between align-items-center">
		<h3 class="  " >Add New Category</h3>
		<button type="button" class="btn  p-0 px-2 btn-light   border-0  " 
					data-bs-toggle="collapse" data-bs-target="#add_container"><i class="bi bi-x-lg  fw-bolder fs-5 "></i></button>
	</div>
	
	<form action="{{route('admin.addNewCategory')}}" onsubmit="onSubmitLoader('uploading')"  method="post">
		@csrf
		<div class="row w-100 mx-auto align-items-end  py-2 ">
			<div class="col-12 col-sm-4  py-1 ">
				 <label class="form-label   " for="name_id">Category Name <span class="text-danger">*</span></label>
				<input type="text" class="form-control login_input"  name="name" id="name_id" required="true" autocomplete="off"/>
			</div>
			<div class="col-12 col-sm-4 py-1"> 
				<label class="form-label   " for="slug_id">Slug / Keywords <span class="text-danger">*</span></label> 
				<input type="text" class="form-control login_input"  name="slug" id="slug_id" required="true" autocomplete="off"/>
			</div>
			
			<div class="col-12 col-sm-4 py-1">
				<label class="form-label    " for="gst_id">GST <span class="text-danger">*</span></label>
				<div class="input-group"> 
					<input type="number" step="0.01" class="form-control login_input"  name="gst" id="gst_id" required="true" autocomplete="off"/>
					<span class="input-group-text login_input">%</span>
				</div>
			</div>
			<div class="col-12 col-sm-4 py-2">
				<button type="submit" class="btn   w-100   submit_btn"  >Submit</button>
			</div>
		</div>
	</form>
	 
	<div class=" pt-4">
    <h4>Note:</h4>
    <p><strong>Slug / Keywords</strong> are words that help users search for products. For example, if your category name is <strong>"Category,"</strong> a suitable slug might look like <strong>"category1-category2-category3."</strong></p>
    <p>The slug must be a combination of words (separated by hyphens) that are relevant to the category name.</p>
	</div>

</div>