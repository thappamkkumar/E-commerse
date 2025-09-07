@extends('admin/layout')
@section('admin.dashboard')
<section class="p-2">
	<script src="{{asset('vender/Highcharts/code/highcharts.js')}}"></script>  
	<h1 class="py-2 "  >Dashboard</h1>
	<div class="row justify-content-center w-100 mx-auto py-2">
		<div class=" col-12 col-sm-6 col-md-4 py-2">
			<div class=" w-100 h-auto  py-3    dashboardCard" 
			onclick='window.location.href =  `{{route("admin.userList", ["user" => "all"])}}`;'  >
				<div class="py-2  d-flex  justify-content-center align-items-center  ">
					<span class="dashboardCard_icon_container">
					<i class="bi bi-people-fill fs-3 p-0" ></i>
					</span>
				</div>
				<h3 class="pt-3 text-center">Users</h3>
				<h4 class="fw-bold text-center">{{$records_total['users']}}</h4>
			</div>
			
		</div>
		<div class=" col-12 col-sm-6 col-md-4 py-2">
			<div class=" w-100 h-auto py-3   dashboardCard"
				onclick='window.location.href =  `{{route("admin.userList", ["user" => "customers"])}}`;'  >
				<div class="py-2  d-flex  justify-content-center align-items-center  ">
					<span class="dashboardCard_icon_container">
					<i class="bi bi-people-fill fs-3 p-0" ></i>
					</span>
				</div>
				<h3 class="pt-2 text-center">Customers</h3>
				<h4  class="fw-bold text-center">{{$records_total['customers']}}</h4>
			</div>
			
		</div>
		 
		<div class=" col-12 col-sm-6 col-md-4 py-2">
			<div class=" w-100 h-auto py-3   dashboardCard"
				onclick='window.location.href =  `{{route("admin.productList", ["filterType"=>"product", "filterName"=>"all"])}}`;'  >
				<div class="py-2  d-flex  justify-content-center align-items-center  ">
					<span class="dashboardCard_icon_container">
					<i class="bi bi-tag-fill fs-3 p-0" ></i>
					</span>
				</div>
				<h3  class="pt-2 text-center">Product</h3>
				<h4  class="fw-bold text-center">{{$records_total['products']}}</h4>
			</div>
			
		</div>
		
		<div class=" col-12 col-sm-6 col-md-4 py-2">
			<div class=" w-100 h-auto py-3    dashboardCard"
				onclick='window.location.href =  `{{route("admin.orderList")}}`;'  >
				<div class="py-2  d-flex  justify-content-center align-items-center  ">
					<span class="dashboardCard_icon_container">
					<i class="bi bi-cart-fill fs-3 p-0" ></i>
					</span>
				</div>
				<h3  class="pt-2 text-center">Orders</h3>
				<h4  class="fw-bold text-center">{{$records_total['orders']}}</h4>
			</div>
			
		</div>
		 
		<div class=" col-12 col-sm-6 col-md-4 py-2">
			<div class=" w-100 h-auto py-3    dashboardCard"
				onclick='window.location.href =  `{{route("admin.paymentList")}}`;' >
				<div class="py-2  d-flex  justify-content-center align-items-center  ">
					<span class="dashboardCard_icon_container">
					<i class="bi bi-credit-card-fill fs-3 p-0" ></i>
					</span>
				</div>
				<h3 class="pt-2 text-center">Transection</h3>
				<h4 class="fw-bold text-center">{{$records_total['transection']}}</h4>
			</div>
			
		</div>
		 
	</div>
	
	<!-- div for graphs-->
	<div class="row w-100 mx-auto py-2 "  >
		<div class="col-12   col-xl-6 py-2" >
			<div id="userGrowthByMonthContainer">  </div>
		</div>
		<div class="col-12   col-xl-6 py-2">
			<div id="customerGrowthByMonthContainer">  </div>
		</div>
		 
		<div class="col-12   col-xl-6 py-2">
			<div id="productGrowthByMonthContainer">  </div>
		</div>
		<div class="col-12   col-xl-6 py-2">
			<div id="orderGrowthByMonthContainer">  </div>
		</div>
	</div>
	
	
	<script> 
		 const element1 = document.getElementById("navigation_link_dashboard"); 
		const element2 = document.getElementById("navigation_link_dashboard1"); 
		element1.classList.add("active_admin_navigation_link");
		element2.classList.add("active_admin_navigation_link");
		
		
		var userData = <?php echo json_encode($userDataByMonth)?>;
		var customerData = <?php echo json_encode($customerDataByMonth)?>;
		var productData = <?php echo json_encode($productDataByMonth)?>;
		var orderData = <?php echo json_encode($orderDataByMonth)?>;
		
		
	</script>
	<script src="{{asset('vender/js/admin/dashboard.js')}}"></script>
	<script src="{{asset('vender/js/admin/user_growth_graph.js')}}"></script>
	<script src="{{asset('vender/js/admin/customer_growth_graph.js')}}"></script> 
	<script src="{{asset('vender/js/admin/product_growth_graph.js')}}"></script>
	<script src="{{asset('vender/js/admin/order_growth_graph.js')}}"></script>
</section>
@endsection
