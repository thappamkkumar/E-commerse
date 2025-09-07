@extends('customer/layout')
@section('orderList')
		
<main class="home_container pb-5">

 
	<section class="w-100  py-4" style="min-height:100vh; height:auto;">
		
		@include('alert_box')
		@if($orderList->total() > 0)
		 
			<h5 class="text-center  "  >Total {{$orderList->total()}} products are available.... </h5>
		 
		@else
			<h5 class="text-center  "  >No products are available</h5> 
		@endif
		
			<!-- List of products-->
			<div class="row w-100 mx-auto py-5  ">
	
				@foreach($orderList as $order)
					 
					 
					<div class="col-12 col-sm-12  col-lg-6 py-2 px-2 px-md-3     ">
						<div class="row mx-auto cart">
							<div class="col-12 col-sm-5  p-0">
								<img src="{{$order->product->thumnail}}" alt="product image"  class="cart_product_image" onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';">
							</div>
							<div class="col-12 col-sm-7 sub_cart_2 py-3  px-3 ">
								<div class=" py-2  ">
									<h5>{{$order->product->name}}</h5>
									  
									<a href="{{route('productDetail',['productCode'=>$order->product_id])}}"  class="p-0 m-0 text-decoration-none cart_product_detail">Product Detail <i class="bi bi-arrow-right ps-1   "></i></a>
								</div>
								<div class="row ">
									<div class="col-6 text-start  "><h6 >Quantity :- </h6></div>
									<div class="col-6 text-end "><p class="p-0 m-0">{{$order->quantity}}</p></div>
									<div class="col-6 text-start  "><h6>Payment :- </h6></div>
									<div class="col-6 text-end "><p class="p-0 m-0"><span class="fw-bold">Rs. </span>{{$order->price}}</p></div>
									<div class="col-6 text-start"><h6>Status :- </h6></div>
									<div class="col-6 text-end "><p class="p-0 m-0"><span class="fw-bold"></span>{{$order->order_status}}</p></div>
									
								 
								</div>								
							</div>
						</div>
					</div>
				@endforeach
				
		</div>
		 
	</section>
	@if($orderList->total() > 10)
		<div class="w-100 py-4 "    >
		
			<ul class="pagination  justify-content-center">
				@if($orderList->onFirstPage())
					<li class="page-item"><span class="btn   border border-2 me-1 ">Prev</span></li>
				@else 
					<li class="page-item"><a href="{{$orderList->previousPageUrl()}}"   class="   btn  btn-light border border-2 me-1">Prev</a></li>
				@endif
				@if($orderList->hasMorePages())
					<li class="page-item"><a href="{{$orderList->nextPageUrl()}}"  class=" btn  btn-light border border-2 ms-1">Next</a></li>
				 @else
					 <li class="page-item"><span class="   btn border border-2 ms-1">Next</span></li> 
				@endif
			</ul>
		</div>
	@endif
	 
	 <script>
		const element1 = document.getElementById("navigation_link_orders"); 
		const element2 = document.getElementById("navigation_link_orders1"); 
		element1.classList.add("active_navigation_link");
		element2.classList.add("active_navigation_link");
	</script>
</main>

@endsection