@extends('admin/layout')
@section('admin.transectionDetail')
<section class="p-0 pt-2 p-md-4 h-auto">
	<div class="pb-3 px-2 px-md-0" >
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
		 <div class="    w-100 mx-auto">
		  
			<div class="   border-bottom">
				<span class="fs-4 fw-bold">Transection / </span>
				<span class="fs-2 fw-bolder ps-1"  >Detail</span>
			</div>
			 
			<div class="table-responsive-lg ">
				 <table class="table table-borderless   "   >
							
						<tbody>
							<tr class="border-bottom">
								<th class=" col-4  " >Order ID :-</th>
								<td class="col-8     " > 
								<a href="{{route('admin.orderDetail', ['order' => $transection->orders])}}" 
										class="text-decoration-none"> {{$transection->orders->order_number}} </a>
								 </td>
							</tr>
							<tr class="border-bottom">
								<th class=" col-4  " >User Name :-</th>
								<td class="col-8     " >
									<a href="{{route('admin.userProfile', ['user' => $transection->user])}}" 
										class="text-decoration-none"> {{$transection->user->customers->name}} </a>
								</td>
							</tr>	
							<tr class="border-bottom">
								<th class=" col-4  " >Product Name :-</th>
								<td class="col-8     " >
									<a href="{{route('admin.productDetail', ['product' => $transection->product])}}" 
										class="text-decoration-none"> {{$transection->product->name}} </a>
								</td>
							</tr>	
							<tr class="border-bottom">
								<th class=" col-4  " >Transection ID :-</th>
								<td class="col-8     " >{{$transection->transaction_id}}</td>
							</tr>
							<tr class="border-bottom">
								<th class=" col-4  " >Status :-</th>
								<td class="col-8     " >{{$transection->status}}</td>
							</tr>	
							<tr class="border-bottom">
								<th class=" col-4  " >Amount :-</th>
								<td class="col-8     " >{{$transection->amount}}</td>
							</tr>		
							  
							 							
						</tbody>
					</table> 
			</div>
			<div class="py-3">
				<h3>Other Details</h3>
				<table class="table table-bordered   "   > 
					<tbody>
						 <tr class="border-bottom">
								<th class=" col-4  " >More Detail :-</th>
								<td class="col-8     "style=" word-break:break-all;"> {{ $transection->transaction_details }} </td>
							</tr> 
						 
					</tbody>
				</table> 
			</div>
				 
				 
		</div>		
			
		  
	</div>
	<script src="{{asset('vender/js/admin/formSubmit.js')}}"></script> 
	<script>
		const element1 = document.getElementById("navigation_link_transections"); 
		const element2 = document.getElementById("navigation_link_transections1"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		
		 
	</script>
	 
</section>
@endsection
