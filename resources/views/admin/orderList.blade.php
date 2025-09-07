@extends('admin/layout')
@section('admin.orderList')
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
	
	
	@if(session()->has('user_search_input'))
	<div class="pb-3 px-2 px-md-0"  >
			<a href="{{route('userBack')}}"
				class="btn btn-light fs-6" ><i class="bi bi-arrow-left pe-2"></i>Back</a>
			 
	</div>
	@endif
	
	 
	
	<div class="w-100 h-auto p-1 p-md-4 shadow-lg  "  >
		 
		<div class="w-100 d-flex flex-wrap justify-content-between align-items-center ">
		 	<h3 class="py-2 "  >Order List</h3>
			<div class="">
				<!-- Form for search orders -->
				<form action="{{route('admin.orderSearch')}}" method="POST" onsubmit="onSubmitLoader('searching')" >
					@csrf
					<div class="input-group-text flex-wrap  align-items-center   bg-transparent border-0">
						<input type="search" name="userSearchInput" placeholder="Enter user or product" 
						value = "@if(session()->has('user_search_input')){{session('user_search_input')}} @endif"
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
				<span class="px-2">Showing={{$orders->count()}}, Total={{$orders->total()}} orders, Page={{ $orders->currentPage()}}@if( $orders->total() >1 ) / {{ ceil($orders->total()/10) }} @endif</span>
			</div>
			 
			 
		</div>
		  
		<!-- Table for product List-->
		 <table class="table table-borderless   table_data">
			<thead>
				<tr class="tableRow">
					<th  >S No.</th>
					<th>Order Id</th>
					<th>User Name</th>
					<th>Product name</th>
					<th  >Quantity</th>  
					<th class=" tableMoreView">More</th>
				</tr>
			</thead>
			<tbody>
				@php $s_no = 1; @endphp
				@foreach($orders as $order)
					<tr class="tableRow" onclick='window.location.href =  `{{route("admin.orderDetail", ["order" => $order])}}`;'>
						<td  >{{$s_no++}}</td> 
						<td >{{$order->order_number}}</td> 
						<td  >{{$order->user->customers->name }}</td> 
						<td  >{{$order->product->name}}</td> 
						<td  >{{$order->quantity}}</td> 
						<td class=" tableMoreView">
							<button type="button" class="btn  "
							onclick='window.location.href =  `{{route("admin.orderDetail", ["order" => $order])}}`;'>
							<i class="bi bi-chevron-compact-right "></i></button>
						</td>
					</tr>
					 
				@endforeach
			</tbody>
			 
		 </table> 
		
		<!-- Pagination buttons -->
		@if($orders->total() > 10)
			<div class="w-100 py-4 "     >
			
				<ul class="pagination  justify-content-center">
					@if($orders->onFirstPage())
						<li class="page-item"><span class="btn   border border-2 me-1 ">Prev</span></li>
					@else 
						<li class="page-item"><a href="{{$orders->previousPageUrl()}}"
							class="   btn  paginateBTN border border-2 me-1">Prev</a></li>
					@endif
					@if($orders->hasMorePages())
						<li class="page-item"><a href="{{$orders->nextPageUrl()}}" 
						class=" btn  paginateBTN border border-2 ms-1">Next</a></li>
					 @else
						 <li class="page-item"><span class="   btn border border-2 ms-1">Next</span></li> 
					@endif
				</ul>
			</div>
		@endif
	</div>
	
	
	<script> 
		 const element1 = document.getElementById("navigation_link_orders"); 
		const element2 = document.getElementById("navigation_link_orders1"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		
	</script>
	 <script src="{{asset('vender/js/admin/formSubmit.js')}}"></script>
</section>
@endsection
