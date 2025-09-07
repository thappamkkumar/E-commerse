@extends('admin/layout')
@section('admin.productDetail')
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
		<div class="   border-bottom">
			<span class="fs-4 fw-bold">Product / </span> 
			<span class="fs-2 fw-bolder ps-1  "  >Detail</span>
		</div>
		<div class="  p-2 d-sm-flex flex-wrap flex-row-reverse align-items-center">	
			<!-- div for product thumnail-->
			<div class="  ps-sm-2 py-3  h-auto"> 
			 		@php   
						$product_thumnail= $product->thumnail;  
					 						 
						if(empty($product_thumnail) || $product_thumnail == "")
						{
							$product_thumnail = "images/profile_icon.png";
						}
					@endphp
				<img src="{{$product->thumnail}}"  data-bs-toggle="modal" data-bs-target="#productImageModel"		class="profile_image"  onclick="showImage(this.src, 'Product Thumnail')" onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';"
 > 
			</div>
			
			<!-- update product -->
			<button type="button" class="btn m-1 " id="userCustomerBtn"
				onclick='window.location.href =  `{{route("admin.updateProduct", ["product" => $product])}}`;'>
				Update Product</button>
				
				
			<!-- button for deativate and activate product-->
			 
			<a href="{{route('admin.productDeactivate', ['product' => $product])}}" class="btn m-1 " id="userVendorBtn"	onclick="onSubmitLoader('updating')" >@if($product->is_active == 1)De-activate Product @else Activate Product @endif </a>	
						
						
			<!-- form for product orders-->
			@if( $product->orders->count() > 0)
			<form action="{{route('admin.orderSearch')}}" method="POST" onsubmit="onSubmitLoader('searching')" >
				@csrf
				<input type="hidden" name="userSearchInput"   value = "{{$product->name}}"   autocomplete="off"/>
				<button type="submit" class="btn m-1" id="addUserBTN">Orders</button> 
			</form>
			@endif
		</div>
		<!-- div for product images -->
		<h3>Product Images <button type="button" class="btn btn-light p-0 px-2" data-bs-toggle="collapse" data-bs-target="#productImages"><i class="bi bi-link fw-bold fs-3"></i></button></h3>
		<div class="collapse show  " id="productImages" > 
			<div class="  py-2 d-flex flex-wrap" >
				@if(!empty($product->images))
				@foreach($product->images as $image)
					<div class=" px-2 py-3  h-auto"> 
					 
						 
						<img src="{{$image}}"  data-bs-toggle="modal" data-bs-target="#productImageModel"		class="profile_image"  onclick="showImage(this.src, 'Product Image')" onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';" > 
					</div>
				@endforeach
				@endif
			</div>
		</div>
		<div class="py-2">
			<!-- product Basic Details-->
			<div class="py-4">
				 
				<h3>Product Basic Details <button type="button" class="btn btn-light p-0 px-2" data-bs-toggle="collapse" data-bs-target="#basicDetail"><i class="bi bi-link fw-bold fs-3"></i></button></h3>
				<div class="collapse show  " id="basicDetail">
					<table class="table table-borderless   "   >
							
						<tbody>
							<tr class="border-bottom">
								<th class=" col-4  " >Name :-</th>
								<td class="col-8     " >{{$product->name}}</td>
							</tr>
							<tr class="border-bottom">
								<th class=" col-4  " >Category :-</th>
								<td class="col-8     " >
									<a href="{{route('admin.categoryDetail', ['category' => $product->category])}}" 
										class="text-decoration-none">  {{$product->category->name}} </a>
								</td>
							</tr> 	
							 <tr class="border-bottom ">
								<th class=" col-4   " >Brand :-</th>
								<td class="col-8    " >
									<a href="{{route('admin.brandDetail', ['brand' => $product->brand])}}" 
										class="text-decoration-none">  {{$product->brand->name}} </a>  
								</td>
							</tr> 	
							 
							<tr class="border-bottom">
								<th class=" col-4  " >Slug :-</th>
								<td class="col-8     " >{{$product->slug}}</td>
							</tr>	
							<tr class="border-bottom">
								<th class=" col-4  " >Price :-</th>
								<td class="col-8     " >Rs {{$product->price}}</td>
							</tr>
							<tr class="border-bottom">
								<th class=" col-4  " >Sale Price :-</th>
								<td class="col-8     " > Rs
										@if($product->sale_price != null || $product->sale_price != 0)
											{{$product->sale_price}}
										@else 0 @endif 
									</td>
							</tr>		
							<tr class="border-bottom">
								<th class=" col-4  " >Discount :-</th>
								<td class="col-8     " >@if($product->sale_price != null || $product->sale_price != 0){{round((1 - $product->sale_price / $product->price) * 100)}} @else 0 @endif %</td>
							</tr> 
							<tr class="border-bottom">
								<th class=" col-4  " >Stock :-</th>
								<td class="col-8     " >{{$product->stock}}</td>
							</tr>				
							<tr class="border-bottom">
								<th class=" col-4  " >Delivery Charges :-</th>
								<td class="col-8     " >Rs {{$product->delivery_charges}}</td>
							</tr>									
						</tbody>
					</table> 
				</div>
			</div>
			<!-- product Video-->
			<div class="py-4">
				 
				<h3>Product Video <button type="button" class="btn btn-light p-0 px-2" data-bs-toggle="collapse" data-bs-target="#productVideo"><i class="bi bi-link fw-bold fs-3"></i></button></h3>
				
				<div class="collapse show   " id="productVideo">
					 {!! $product->video_url !!}  
						 
				</div>
			</div>
			<!-- product Description-->
			<div class="py-4">
				 
				<h3>Product Description <button type="button" class="btn btn-light p-0 px-2" data-bs-toggle="collapse" data-bs-target="#productDescription"><i class="bi bi-link fw-bold fs-3"></i></button></h3>
				
				<div class="collapse show   " id="productDescription">
					<p>{!! $product->description !!} </p>
						 
				</div>
			</div>
			<!-- product Specification-->
			<div class="py-4"> 
				<h3>Product Specification <button type="button" class="btn btn-light p-0 px-2" data-bs-toggle="collapse" data-bs-target="#productSpecification"><i class="bi bi-link fw-bold fs-3"></i></button></h3>
				
				<div class="collapse show   " id="productSpecification">
					@if($product->specification != null)
						@php 		
							 
								$total_data=count($product->specification);  
							 
						@endphp
						 
						@if( $total_data>0 && ($product->specification[0]!=null||$product->specification[1]!=null))
						 
							<table class="table table-bordered   "   >
								
								<tbody>
								
									@for($i=0;$total_data>$i;$i=$i+2)
										<tr>
											<th class=" w-50   border border-3" >{{$product->specification[$i]}}</th>
											<td class="w-50    border border-3" >{{$product->specification[$i+1]}}</td>
										</tr>
									@endfor
								
								</tbody>
							</table>
						 
						@endif
					 @endif
						 
				</div>
			</div>
			<!-- product Reviews-->
			<div class="py-4">
				 
				<h3>Product Reviews <button type="button" class="btn btn-light p-0 px-2" data-bs-toggle="collapse" data-bs-target="#productReviews"><i class="bi bi-link fw-bold fs-3"></i></button></h3>
				
				<div class="collapse show  py-3 " id="productReviews">
					@foreach($product->reviews as $review)
					<div class="border-bottom btn w-100 mt-1 text-start btn-light" 
						onclick='window.location.href =  `{{route("admin.userProfile", ["user" => $review->user])}}`;'>					 
						 <div class="d-flex   align-items-start">
							<div class=" px-2   w-auto h-auto"> 
							@if($review->user->user_role == 3)
								<img src="{{$review->user->customers->profile_image  }}"  class="profile_image"  onerror="this.onerror=null;this.src='{{ asset('images/profile_icon.png') }}';"   > 
							@endif
							</div>
							<div class=" ">
								<h5>{{$review->user->customers->name}}</h5>
								<p>{{$review->rating}}</p>
								
							</div>
						 </div>
						 <p>{{$review->review}}</p>
					</div>
					@endforeach
				</div>
			</div>
			
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
			 <img src=" "  class="w-100 "  id="productImageModel_ImageID"  >
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	 
	 <!-- JavaScript -->
	<script src="{{asset('vender/js/admin/formSubmit.js')}}"></script> 
	<script>
	const element1 = document.getElementById("navigation_link_products"); 
		const element2 = document.getElementById("navigation_link_products1"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		
		
		//function for change image in model
		function showImage(img, imgType)
		{
			document.getElementById('productImageModel_ImageID').src = img;
			document.getElementById('productImageLabel').innerHTML = imgType;
		}
	</script>
	 
</section>
@endsection
