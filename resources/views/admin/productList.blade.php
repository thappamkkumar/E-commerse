@extends('admin/layout')
@section('admin.productList')
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
	
	
	
	
	<!-- using Modal for category list-->
	<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="categoryModalLabel">Select Category</h5>
			<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
				<i class="bi bi-x-lg  fw-bolder fs-5 "></i>
			</button>
		  </div>
		  <div class="modal-body">
			<ul class="list-group">
			  @foreach($categories as $category)
				<li class="list-group-item p-0">
					 
					<a href="{{route('admin.productList', ['filterType' => 'category', 'filterName' => $category->id])}}" class="btn  w-100 d-block text-start btn-light rounded-0 "	onclick="onSubmitLoader('searching')" >{{ $category->name }} </a>	
						
				</li>	
			  @endforeach
			</ul>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	 
<!-- using Modal for brands list-->
	<div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="brandModalLabel">Select Brand</h5>
			<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
				<i class="bi bi-x-lg  fw-bolder fs-5 "></i>
			</button>
		  </div>
		  <div class="modal-body">
			<ul class="list-group">
			  @foreach($brands as $brand)
				<li class="list-group-item p-0">
					 
					<a href="{{route('admin.productList', ['filterType' => 'brand', 'filterName' => $brand->id])}}" class="btn  w-100 d-block text-start btn-light rounded-0 "	onclick="onSubmitLoader('searching')">{{ $brand->name }} </a>	
						
				</li>	
			  @endforeach
			</ul>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	 

	
	 
	 
	 
	@if($allProduct == 0)
		<div class="pb-3 px-2 px-md-0"  >
			<a href="{{route('userBack')}}"
				class="btn btn-light fs-6" ><i class="bi bi-arrow-left pe-2"></i>Back</a>
			 
		</div>
	@endif
	<div class="w-100 h-auto p-1 p-md-4 shadow-lg  "  >
		 
		<div class="w-100 d-flex flex-wrap justify-content-between align-items-center ">
		 	<h3 class="py-2 "  >Product List</h3>
			<div class="">
				<!-- Form for search users -->
				<form action="{{route('admin.productSearch')}}" method="POST" onsubmit="onSubmitLoader('searching')" >
					@csrf
					<div class="input-group-text flex-wrap  align-items-center   bg-transparent border-0">
						<input type="search" name="userSearchInput" placeholder="Search product" 
							class="form-control   searchInput"  autocomplete="off"/>
						<button type="submit" class="btn      searchBTN">
							<i class="bi bi-search fs-3"></i>
						</button>
					</div>
				</form>
			</div>
		</div>
		
		<div class="py-2 px-2 d-flex flex-wrap justify-content-between align-items-center  table_header " style="--bs-bg-opacity:0.3;">
			<div>
				<i class="bi bi-table"></i>
				<span class="px-2">Showing={{$products->count()}}, Total={{$products->total()}} products, Page={{ $products->currentPage()}}@if( $products->total() >1 ) / {{ ceil($products->total()/10) }} @endif</span>
			</div>
			 
			<div class="py-2">
				<!-- button seller list-->
				<button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#brandModal" id="userCustomerBtn">
				  <i class="bi bi-filter  pe-1  "></i>Brands
				</button>
				<!-- button category list-->
				<button type="button" class="btn  " data-bs-toggle="modal" data-bs-target="#categoryModal" id="userVendorBtn">
				  <i class="bi bi-filter  pe-1  "></i>Categories
				</button>
				<button type="button" class="btn px-1 py-0 mx-1" id="addUserBTN"
					onclick='window.location.href =  `{{route("admin.addProduct" )}}`;'>
					<i class="bi bi-plus fw-bolder fs-4 "></i></button>
			</div>
		</div>
		  
		<!-- Table for product List-->
		 <table class="table table-borderless   table_data">
			<thead>
				<tr class="tableRow"> 
					<th  >S No.</th>
					<th>Product</th>
					<th>Brand Name</th> 
					<th>Category</th> 
					<th  >Price (Rs.)</th> 
					<th >Discount</th> 
					<th class="tableMoreView">More</th>
				</tr>
			</thead>
			<tbody>
				@php $s_no = 1; @endphp
				@foreach($products as $product)
				 
					<tr class="tableRow" onclick='window.location.href =  `{{route("admin.productDetail", ["product" => $product->id])}}`;'>
						<td class="  @if($product->is_active == 0)text-danger @endif ">{{$s_no++}}</td>
						<td class=" @if($product->is_active == 0)text-danger @endif "> {{$product->name}} </td>
						<td class=" @if($product->is_active == 0)text-danger @endif "> {{$product->brand->name}} </td>
						<td class=" @if($product->is_active == 0)text-danger @endif "> {{$product->category->name}} </td> 
						<td class="  @if($product->is_active == 0)text-danger @endif ">{{$product->price}}</td> 
						<td class="  @if($product->is_active == 0)text-danger @endif ">@if($product->sale_price != null || $product->sale_price != 0){{round((1 - $product->sale_price / $product->price) * 100)}} @else 0 @endif %</td> 
						<td class="tableMoreView  ">
							<button type="button" class="btn @if($product->is_active == 0)text-danger @endif"
							onclick='window.location.href =  `{{route("admin.productDetail", ["product" => $product->id])}}`;'>
							<i class="bi bi-chevron-compact-right "></i></button>
						</td>
					</tr>
				@endforeach
			</tbody>
			 
		 </table> 
		
		<!-- Pagination buttons -->
		@if($products->total() > 10)
			<div class="w-100 py-4 "     >
			
				<ul class="pagination  justify-content-center">
					@if($products->onFirstPage())
						<li class="page-item"><span class="btn   border border-2 me-1 ">Prev</span></li>
					@else 
						<li class="page-item"><a href="{{$products->previousPageUrl()}}"
							class="   btn  paginateBTN border border-2 me-1">Prev</a></li>
					@endif
					@if($products->hasMorePages())
						<li class="page-item"><a href="{{$products->nextPageUrl()}}" 
						class=" btn  paginateBTN border border-2 ms-1">Next</a></li>
					 @else
						 <li class="page-item"><span class="   btn border border-2 ms-1">Next</span></li> 
					@endif
				</ul>
			</div>
		@endif
	</div>
	
	
	<script>
		 
		const element1 = document.getElementById("navigation_link_products"); 
		const element2 = document.getElementById("navigation_link_products1"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		
		 
	</script>
	 
</section>
@endsection
