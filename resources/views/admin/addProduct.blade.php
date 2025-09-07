@extends('admin/layout')
@section('admin.addProduct')
<section class="p-0 pt-2 p-md-4 h-auto">
	<script src="{{asset('vender/tinymce_6/tinymce/js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
		<script>tinymce.init({ 
											selector:'#product_description',
											height:'300px'											
											
										});
		</script>
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
		<div class="   border-bottom  ">
			<span class="fs-4 fw-bold">Product / </span> 
			<span class="fs-2 fw-bolder ps-1  "  >New Product</span>
		</div> 
		<!-- form to add new user-->
		<form action="{{route('admin.storeProduct')}}"   method="post" id="productForm" onsubmit="onSubmitLoader('uploading')"  enctype="multipart/form-data">
			@csrf
			<!-- div for product thumnail-->
			<div class="py-3">
				<h4>Product Thumbnail </h4>
				<div class="d-flex flex-wrap align-items-center">
					<label for="thumbnailInputID" class="btn m-1 " id="userVendorBtn">Select Image</label>
					<input type="file" class="imageInput" id="thumbnailInputID" name="thumnail" onchange="showThumnail()" accept=".jpg, .jpeg, .png" >
					<div class="py-2 px-2"  id="thumnail_container">
					
					</div>
				</div>				 
			</div>
			<!-- div for product images-->
			<div class="py-3">
				<h4>Product Images </h4>
				<div class="d-flex flex-wrap align-items-center">
					<label for="imageInputID" class="btn m-1 " id="userCustomerBtn">Select Images</label>
					<input type="file" class="imageInput" id="imageInputID" name="images[]" onchange="showImages()" max="10" multiple accept=".jpg, .jpeg, .png">
					<div class="py-2 px-2 d-flex flex-wrap align-items-center" id="image_container"> 
						<img src="" alt="Image 1" id="image1" class="m-1 profile_image add_product_image" data-bs-toggle="modal" data-bs-target="#productImageModel" onclick="showImage(this.src, 'Product Images')">
						<img src="" alt="Image 2" id="image2" class="m-1 profile_image add_product_image" data-bs-toggle="modal" data-bs-target="#productImageModel" onclick="showImage(this.src, 'Product Images')">
						<img src="" alt="Image 3" id="image3" class="m-1 profile_image add_product_image" data-bs-toggle="modal" data-bs-target="#productImageModel" onclick="showImage(this.src, 'Product Images')">
						<img src="" alt="Image 4" id="image4" class="m-1 profile_image add_product_image" data-bs-toggle="modal" data-bs-target="#productImageModel" onclick="showImage(this.src, 'Product Images')">
						<img src="" alt="Image 5" id="image5" class="m-1 profile_image add_product_image" data-bs-toggle="modal" data-bs-target="#productImageModel" onclick="showImage(this.src, 'Product Images')">
						<img src="" alt="Image 6" id="image6" class="m-1 profile_image add_product_image" data-bs-toggle="modal" data-bs-target="#productImageModel" onclick="showImage(this.src, 'Product Images')">
						<img src="" alt="Image 7" id="image7" class="m-1 profile_image add_product_image" data-bs-toggle="modal" data-bs-target="#productImageModel" onclick="showImage(this.src, 'Product Images')">
						<img src="" alt="Image 8" id="image8" class="m-1 profile_image add_product_image" data-bs-toggle="modal" data-bs-target="#productImageModel" onclick="showImage(this.src, 'Product Images')">
						<img src="" alt="Image 9" id="image9" class="m-1 profile_image add_product_image" data-bs-toggle="modal" data-bs-target="#productImageModel" onclick="showImage(this.src, 'Product Images')">
						<img src="" alt="Image 10" id="image10" class="m-1 profile_image add_product_image" data-bs-toggle="modal" data-bs-target="#productImageModel" onclick="showImage(this.src, 'Product Images')">

					</div>
				</div>					 
			</div>
			<!-- div for product basic daetails-->
			<div class="py-3">
				<h4>Product Basic Details  </h4>
				<div class="row w-100 mx-auto align-items-end  "> 
					<div class="col-12 col-sm-4 py-2">
						<label class="form-label   " for="name_id">Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control login_input" value="{{old('name')}}"  name="name" id="name_id" required="true" autocomplete="off"/>
					</div>
					
					<div class="col-12 col-sm-4 py-2">
						<label class="form-label   " for="slug_id">Slug <span class="text-danger">*</span></label>
						<input type="text" class="form-control login_input" value="{{old('slug')}}"  name="slug" id="slug_id" required="true" autocomplete="off"/>
					</div>
					 <div class="col-12 col-sm-4 py-2">
						<label class="form-label   " for="price_id">Price <span class="text-danger">*</span></label>
						<input type="number" class="form-control login_input" value="{{old('price')}}"  name="price" id="price_id" required="true" autocomplete="off"/>
					</div> 
					<div class="col-12 col-sm-4 py-2">
						<label class="form-label   " for="sale_price_id">Sale Price  </label>
						<input type="number" class="form-control login_input" value="{{old('sale_price')}}"  name="sale_price" id="sale_price_id"   autocomplete="off"/>
					</div>
					<div class="col-12 col-sm-4 py-2">
						<label class="form-label   " for="stock_id">Stock <span class="text-danger">*</span></label>
						<input type="number" class="form-control login_input" value="{{old('stock')}}"  name="stock" id="stock_id" required="true" autocomplete="off"/>
					</div> 
					<div class="col-12 col-sm-4 py-2">
						<label class="form-label   " for="delivery_charges_id">Delivery  Charges <span class="text-danger">*</span></label>
						<input type="number" class="form-control login_input" value="{{old('delivery_charges')}}"  name="delivery_charges" id="delivery_charges_id" required="true" autocomplete="off"/>
					</div> 
					<div class="col-12 col-sm-4 py-2">
						<label class="form-label   " for="category_id">Category <span class="text-danger">*</span></label>
						 
						<select name="categories_id" class="form-select login_input" id="category_id" required="true">
							<option value="" style="background-color:rgba(100,100,100,0.5);" readonly>Select Category</option>
							@foreach($categories as $category )
								<option  value="{{$category->id}}" {{ old('categories_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-12 col-sm-4 py-2">
						<label class="form-label   " for="brand_id">Brands <span class="text-danger">*</span></label>
						 
						<select name="brand_id" class="form-select login_input" id="brand_id" required="true">
							<option value="" style="background-color:rgba(100,100,100,0.5);" readonly>Select Brand</option>
							@foreach($brands as $brand )
								<option  value="{{$brand->id}}" {{ old('brand_id') == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
							@endforeach
						</select>
					</div>
				</div>			 
			</div>
			<!-- div for product description-->
			<div class="py-3">
				<h4 class="pb-3">Product Description </h4> 
				<textarea class="form-control   " id="product_description"  name="description"  > {{old('description')}}</textarea>
						
			</div>
			<!-- div for product vedio url-->
			<div class="py-3">
				<h4 class="pb-3">Product Vedio Link </h4> 
				<div class="row w-100 mx-auto align-items-end  "> 
					<div class="col-12 col-sm-6 col-md-8 col-lg-6 col-xl-4 py-2">
						<input type="text" class="form-control login_input" value="{{old('video_url')}}"  name="video_url" id="video_url_id" onchange="setURL(this.id,'video_link')" required="true" autocomplete="off"/>
						
					</div>			
				</div>		
				{!!old('video_url')!!}
			</div>
			<!--div for product specification -->
			<div class="py-3">
				<h4>Product Specification </h4>
				<div class="row w-100 mx-auto align-items-end  "> 
					 
					@php 
						$specification_data = session()->has('specification_data') ? session('specification_data') : [];
						$total_data = count($specification_data);
					@endphp
					 
					<div class="col-12 pt-2">
						<div class="row" id="specification_container">
							@if($total_data > 0)
								@for($i=0,$j=1;$total_data>$i;$i=$i+2,$j++)
									<div class="col-12 py-2">
										<div class="row">
											<div class="col-12 col-sm-6 col-xl-4  ">
												<input type="text" class="form-control login_input" value="{{$specification_data[$i]}}" name="specification_heading_{{ $j }}" placeholder="Specification Name" autocomplete="off" required> 
											</div>
											<div class="col-12 col-sm-6 col-xl-4 py-2 py-sm-0">
												<input type="text" class="form-control login_input" value="{{$specification_data[$i+1]}}" name="specification_detail_{{ $j }}" placeholder="Specification Detail" autocomplete="off" required> 
											</div>
										</div>
									</div>
								@endfor
							@else
								<div class="col-12 py-2">
									<div class="row">
										<div class="col-12 col-sm-6 col-xl-4 ">
											<input type="text" class="form-control login_input" name="specification_heading_1" placeholder="Specification Name" autocomplete="off" required> 
										</div>
										<div class="col-12 col-sm-6 col-xl-4 py-2 py-sm-0">
											<input type="text" class="form-control login_input" name="specification_detail_1" placeholder="Specification Detail" autocomplete="off" required> 
										</div>
									</div>
								</div>
							@endif
						</div>
					</div>

					<div class="col-12 pb-2"> 
						<input type="hidden" value="{{ $total_data > 0 ? $total_data/2 : 1 }}" name="total_specification" id="total_specification"> 
						<button type="button" class="btn btn-transparent text-primary" onclick="addSpecificationField()">Add Specification</button>						 
					</div>
 
					 
					 
				</div> 
			</div>
			<div class=" py-3">
				<button type="submit" class="btn   submit_btn"  >Submit</button>
			</div>
		</form><!-- end of form  -->
		
		<div class=" pt-4">
			<h4>Note:</h4>
			<p><strong>Slug / Keywords</strong> are words that help users search for products. For example, if your product name is <strong>"Product,"</strong> a suitable slug might look like <strong>"product1-product2-product3."</strong></p>
			<p>The slug must be a combination of words (separated by hyphens) that are relevant to the product name.</p>
		</div>
	</div>
	
	<!-- model/ div for product thumnail and images-->
	<div class="modal fade" id="productImageModel" tabindex="-1" aria-labelledby="productImageModel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="productImageLabel">Product Image</h5>
			<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
				<i class="bi bi-x-lg  fw-bolder fs-5 "></i>
			</button>
		  </div>
		  <div class="modal-body">
			 <img src=" "  class="w-100 "  id="productImageModel_ImageID"   >
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	 
	 
	   

 
	 
	 <!-- JavaScript -->
	 <script src="{{asset('vender/js/admin/addProduct.js')}}"></script> 
	<script> 
		const element1 = document.getElementById("navigation_link_products"); 
		const element2 = document.getElementById("navigation_link_products1"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		
	</script>
	 
</section>
@endsection
