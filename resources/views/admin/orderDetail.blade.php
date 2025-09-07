@extends('admin/layout')
@section('admin.orderDetail')
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
		 <div class="    w-100 mx-auto">
		  
			<div class="   border-bottom">
				<span class="fs-4 fw-bold">Order / </span>
				<span class="fs-2 fw-bolder ps-1 "  >Detail</span>
			</div>
			 
			<div class=" table-responsive-lg  "> 
				 <table class="table table-borderless   "   >
							
						<tbody>
							<tr class="border-bottom">
								<th class=" col-4  " >Order ID :-</th>
								<td class="col-8     " >{{$order->order_number}}</td>
							</tr>
							<tr class="border-bottom">
								<th class=" col-4  " >User Name :-</th>
								<td class="col-8     " >
									<a href="{{route('admin.userProfile', ['user' => $order->user])}}" 
										class="text-decoration-none"> {{$order->user->customers->name}} </a>
								</td>
							</tr>	
							<tr class="border-bottom">
								<th class=" col-4  " >Product Name :-</th>
								<td class="col-8     " >
									<a href="{{route('admin.productDetail', ['product' => $order->product])}}" 
										class="text-decoration-none"> {{$order->product->name}} </a>
								</td>
							</tr>	
							<tr class="border-bottom">
								<th class=" col-4  " >Address :-</th>
								<td class="col-8     " >{{$order->address}}</td>
							</tr>
							<tr class="border-bottom">
								<th class=" col-4  " >Price :-</th>
								<td class="col-8     " >{{$order->price}}</td>
							</tr>	
							<tr class="border-bottom">
								<th class=" col-4  " >Delivery Charges :-</th>
								<td class="col-8     " >{{$order->delivery_charges}}</td>
							</tr>		
							<tr class="border-bottom">
								<th class=" col-4  " >GST :-</th>
								<td class="col-8     " >{{$order->gst}}</td>
							</tr>	 
							<tr class="border-bottom">
								<th class=" col-4  " > Quantity:-</th>
								<td class="col-8     " >{{$order->quantity}}</td>
							</tr>		
							<tr class="border-bottom">
								<th class=" col-4  " >transection ID :-</th>
								<td class="col-8     " >
									<a href="{{route('admin.transectionDetail', ['transection' => $order->transaction_id])}}" 
										class="text-decoration-none"> {{$order->transaction->transaction_id }} </a>
								</td>
							</tr>	 
							<tr class="border-bottom">
								<th class=" col-4  " >Order Status :-</th>
								<!--<td class="col-8     " >{{$order->order_status}}</td>-->
								<td class="col-8     " >
									<form action="{{route('admin.orderStatusUpdate')}}" method="post" id="update_deliver_status"  >
										@csrf
										<input type="hidden" name="order_id" value="{{$order->id}}">
										<select class="form-select form_input" name="order_status" onchange="submitForm(event, 'update_deliver_status');onSubmitLoader('updating')">
											<option value="  "  class="bg-secondary text-white" readonly>Select Status</option>
											<option value="Pending"  @if($order->order_status=="Pending") selected @endif >Pending</option>  
											<option value="Dispatched"  @if($order->order_status=="Dispatched") selected @endif >Dispatched</option>  
											<option value="On The Way"  @if($order->order_status=="On The Way") selected @endif >On The Way</option> 
											<option value="Delivered"  @if($order->order_status=="Delivered") selected @endif >Delivered</option> 
											<option value="Failed"  @if($order->order_status=="Failed") selected @endif >Failed</option> 
											<option value="Returned"  @if($order->order_status=="Returned") selected @endif >Returned</option> 
										</select>
									</form>
								</td>
							</tr>								
						</tbody>
					</table> 
			</div>
				 
				 
		</div>		
			
		  
	</div> 
	<script>
		 const element1 = document.getElementById("navigation_link_orders"); 
		const element2 = document.getElementById("navigation_link_orders1"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		
	</script>
	 
</section>
@endsection
