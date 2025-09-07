@extends('admin/layout')
@section('admin.productSearch')
<section class="p-0 pt-2 p-md-4 h-auto">
	<div class="pb-3 px-2 px-md-0"  >
			<a href="{{route('userBack')}}"
				class="btn btn-light fs-6" ><i class="bi bi-arrow-left pe-2"></i>Back</a>
			 
	</div>
	 
	<div class="w-100 h-auto p-1 p-md-4 shadow-lg  "  >
		
		<div class="w-100 d-flex flex-wrap justify-content-between align-items-center ">
			@if($products->total() > 0)
				<!-- heading for list according search-->
				<h4 class="  "  >Product List</h4>
			@else
				<h4 class="  "  >Product is not found.</h4>
			@endif
			<div class="">
				<!-- Form for search users -->
				<form action="{{route('admin.productSearch')}}" method="POST" onsubmit="onSubmitLoader('searching')" >
					@csrf
					<div class="input-group-text flex-wrap  align-items-center   bg-transparent border-0">
						<input type="search" name="userSearchInput" placeholder="Search user"  value="{{session('user_search_input')}}" 
							class="form-control   searchInput" autocomplete="off" />
						<button type="submit" class="btn      searchBTN">
							<i class="bi bi-search fs-3"></i>
						</button>
					</div>
				</form>
			</div>
		</div>
		@if($products->total() > 0)
			<!-- Container for data about table  -->
			<div class="py-2 px-2 d-flex flex-wrap justify-content-between align-items-center  table_header " style="--bs-bg-opacity:0.3;">
				<div>
					<i class="bi bi-table"></i>
					<span class="px-2">Showing={{$products->count()}}, Total={{$products->total()}} Products, Page={{ $products->currentPage()}}@if( $products->total() >1 ) / {{ ceil($products->total()/10) }} @endif</span>
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
		@endif
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
