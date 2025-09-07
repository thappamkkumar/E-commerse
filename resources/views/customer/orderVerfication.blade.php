<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

       
        <title>@if(!empty($webDetail)) {{$webDetail[0]->webSiteName}} @endif</title>
 
		 
		
		 <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
		
		<link href="{{asset('vender/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
		<link href="{{asset('vender/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">  
		<link href="{{asset('vender/aos/aos.css')}}" rel="stylesheet">
		
		
		<link href="{{asset('vender/css/customer/myCart.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/navigation.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/color.css')}}" rel="stylesheet">  
		<link href="{{asset('vender/css/customer/footer.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/productDetail.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/login.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/loader.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/preLoading.css')}}" rel="stylesheet">
		
    </head>
    <body > 
		@include('loader/loader')
		@include('loader/preLoading')
		
		<header class="container-fluid   d-flex align-items-center justify-content-between border border-bottom-1 " id="user_navigation_container">  
			 <a href="{{route('userBack')}}" class="btn  p-0 px-2 text-dark border-0    user_naviagtion_controll_btn"   ><i class="bi bi-arrow-left fs-4 text-dark"></i></a>
				<a href="{{route('home')}}"  class="logo "    >
					@if(!empty($webDetail)) {{$webDetail[0]->webSiteName}} @endif
				</a>
			</div>
			  
			<div class="navbar  navbar-expand  w-auto    "> 
				<ul class="navbar-nav d-flex align-items-center justify-content-center  "  >
					 <li class="nav-item px-1 py-1 "><a href="{{route('productSearch.get')}}" class="nav-link     rounded navigation_link fs-3 "    id="navigation_link_search1"   ><i class="bi bi-search    "></i></a></li>
				</ul>
			</div>
			 
		</header>  
		<main  class=" ">
			<section class=" py-3">
				
				
				<div class="row w-100 justify-content-center m-auto  " >
					<div class="  col-12 col-md-10 col-lg-8  col-xl-6 p-2 p-md-4 ">
						
						@if($errors->any())
							<div class=" w-100 mx-auto alert alert-danger alert-dismissible fade show" role="alert">
								<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
								<h3>Errors</h3>
								<ul>
									@foreach($errors->all() as $error)
										<li> {{ $error }} </li>
									@endforeach
								</ul>
							</div>
						@endif 
						@include('alert_box')
						
						<div class="shadow  rounded p-2    ">
							<h3>Order Now</h3>
							<table class="table table-borderless">
								<tr class="border-bottom">
									<th>Name</th>
									<td class="text-end">
										{{$detail['product_name']}}
									</td>
								</tr>
								<tr class="border-bottom">
									<th>Price</th>
									<td class="text-end">
										{{$detail['price']}}
									</td>
								</tr>
								<tr class="border-bottom">
									<th>Tax(GST)</th>
									<td class="text-end">
										{{$detail['gst']}}
									</td>
								</tr>
								<tr class="border-bottom">
									<th>Delivery Charges</th>
									<td class="text-end">
										{{$detail['delivery_charges']}}
									</td>
								</tr>
								<tr class="border-bottom">
									<th>Quantity</th>
									<td class="d-flex flex-wrap align-items-center justify-content-end">
										<button type="button" class="btn m-0 p-0 border   cart_quantity_btn" onclick="decreaseQuantity()">-</button>
										<span class=" px-3 " id="quantity_display">{{$detail['quantity']}}</span>
										<button type="button" class="btn m-0 p-0  border  cart_quantity_btn" onclick="increaseQuantity({{$detail['stock']}})">+</button>
									</td>
								</tr>
							</table>
						</div>
						<div class="shadow  rounded  px-2 pt-2 my-4 ">	
							<table class="table table-borderless ">
								<tr  >
									<th>Total</th>
									<td class="text-end" id="totalPrice">
										{{($detail['price'] + $detail['gst'] + $detail['delivery_charges']) * $detail['quantity'] }}
									</td>
								</tr>
							</table>
						</div> 
						<div class="shadow rounded  px-2 py-2 my-4 ">	
							<h5>Deliver To</h5>
							<h6 >{{auth()->user()->customers->name}}</h6>
							<p class="m-0">
								<strong>Address :-  </strong>
								<span id="fullAddressDiaplay">
									{{auth()->user()->customers->flat_houseno_building_company}}, 
									{{auth()->user()->customers->area_street_sector_village}}, 
									{{auth()->user()->customers->district}}, 
									{{auth()->user()->customers->state}},
									{{auth()->user()->customers->country}}, 
									{{auth()->user()->customers->pincode}}
								</span>
							</p>
							<button type="submit" class="btn cart_product_detail p-0 m-0"   data-bs-toggle="modal" data-bs-target="#changeAddressModel"  >Change Address</button>
						</div> 
						<div class="   px-2 py-2  ">	
							<form action="{{route('placeOrder')}}" method="post" onsubmit="onSubmitLoader('Processing ')">
								@csrf
								<input type="hidden" value="{{$detail['product_id']}}" name="product_id" >
								<input type="hidden" value="{{$detail['product_name']}}" name="product_name">
								<input type="hidden" value="{{$detail['price']}}" name="price" id="price">
								<input type="hidden" value="{{$detail['gst']}}" name="gst" id="gst">
								<input type="hidden" value="{{$detail['delivery_charges']}}" name="delivery_charges" id="delivery_charges">
								<input type="hidden" value="{{$detail['quantity']}}" name="quantity" id="quantity">
								<input type="hidden" value="{{auth()->user()->customers->country}}" id="country" name="country">
								<input type="hidden" value="{{auth()->user()->customers->state}}" id="state"  name="state">
								<input type="hidden" value="{{auth()->user()->customers->district}}" id="district" name="district">
								<input type="hidden" value="{{auth()->user()->customers->pincode}}" id="pincode" name="pincode">
								<input type="hidden" value="{{auth()->user()->customers->area_street_sector_village}}" id="area_street_sector_village" name="area_street_sector_village">
								<input type="hidden" value="{{auth()->user()->customers->flat_houseno_building_company}}" id="flat_houseno_building_company"  name="flat_houseno_building_company">
								<input type="hidden" value="{{auth()->user()->customers->landmark}}" id="landmark" name="landmark">
								
									
								<button type="submit" class="btn submit_btn">Place Order</button>
							</form>
						</div> 
							
						 
					</div>
				</div>
			 	 	 
			</section>
			 
			<!-- model/ div for change address-->
									<div class="modal fade" id="changeAddressModel" tabindex="-1" aria-labelledby="changeAddressModel" aria-hidden="true">
									  <div class="modal-dialog modal-dialog-scrollable">
										<div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title" id="changeAddressLabel"> Change Address</h4>
											<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
												<i class="bi bi-x-lg  fw-bolder fs-5 "></i>
											</button>
										  </div>
										  <div class="modal-body">
											  
												<label class="form-label pt-2" for="country_id">Country</label>
												<input type="text" name="country" id="country_id"  value="{{auth()->user()->customers->country}}"     class="form-control  login_input"  required autocomplete="off" >
												
												<label class="form-label pt-2" for="state_id">State</label>
												<input type="text" name="state" id="state_id"  value="{{auth()->user()->customers->state}}"     class="form-control  login_input"  required autocomplete="off" >
												
									 
												<label class="form-label pt-2" for="district_id">District</label>
												<input type="text" name="district" id="district_id"  value="{{auth()->user()->customers->district}}"     class="form-control  login_input"  required autocomplete="off" >
												 
												
												<label class="form-label pt-2" for="pincode_id">Pincode</label>
												 <input type="text" name="pincode" id="pincode_id"  value="{{auth()->user()->customers->pincode}}"     class="form-control  login_input"  required autocomplete="off" >
												 
												
												<label class="form-label pt-2" for="area_street_sector_village_id">Area, Street, Sector, Village</label>
												 <input type="text" name="area_street_sector_village" id="area_street_sector_village_id"  value="{{auth()->user()->customers->area_street_sector_village}}"    class="form-control  login_input"  required autocomplete="off" >
												 
												
												<label class="form-label pt-2" for="flat_houseno_building_company_id">Flat, House No., Building, Company</label>
												 <input type="text" name="flat_houseno_building_company" id="flat_houseno_building_company_id"  value="{{auth()->user()->customers->flat_houseno_building_company}}"    class="form-control  login_input"  required autocomplete="off" >
												 
												 <label class="form-label pt-2" for="landmark_id">Landmark</label>
												 <input type="text" name="landmark" id="landmark_id"  value="{{auth()->user()->customers->landmark}}"    class="form-control  login_input"  required autocomplete="off" >
			 
											<div class="py-3">
												<button type="button"  class="btn w-100 submit_btn mb-4" onclick=" changeAddress();" data-bs-dismiss="modal" aria-label="Close">Next</button>
											</div>
										 
										  </div>
										   
										</div>
									  </div>
									</div>
		</main>
		
		@include('customer/footer')
		<script src="{{asset('vender/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{asset('vender/aos/aos.js')}}"></script>  
		<script src="{{asset('vender/js/customer/aos_init.js')}}"></script>  
		<script src="{{asset('vender/js/customer/navigation.js')}}"></script> 
		<script src="{{asset('vender/js/customer/orderVerification.js')}}"></script> 
		<script src="{{asset('vender/js/admin/formSubmit.js')}}"></script> 
		<script src="{{asset('vender/js/preloader.js')}}"></script> 
	 </body>
</html>