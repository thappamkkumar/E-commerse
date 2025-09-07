@extends('customer/layout')
@section('home')
<main class="home_container ">
	
	 
	 
	<!-- Section 1 Start-->
	
	<!-- Section for containing some degin for home or home container section 1 -->
	<section class="home_container_1 d-flex align-items-center  "  >
		<div class="row w-100   mx-auto flex-row-reverse align-items-center  ">
			<div class="col-12 col-lg-6 pt-5   pt-lg-0">
				 
					<img src="{{url('images/hero1.svg')}}" alt="product image" class="d-block    home_container_1_image"  onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';" 	>
				 
			</div>
			<div class="col-12 col-lg-6  d-flex flex-column justify-content-center align-items-center ">
				<div class="  px-3 py-4  " >
					<h2 class="home_auto_text py-3" id="head_type_text"   >All Type Of Products Are Available Under Best Price.</h2>
					<h4 class="  fw-normal py-2 "  ><span    style="opacity:0.7;">SALE UPTO </span><span class="text-danger fw-bold fs-1 ">  50%  </span><span  style="opacity:0.7;"> OFF.</span></h4>
					<a  href="{{route('productListForUser')}}" class="btn w-100 d-lg-none home_shop_now_btn "  >SHOP NOW</a>
					<a  href="{{route('productListForUser')}}" class="btn d-none d-lg-inline-block home_shop_now_btn "  >SHOP NOW</a>
				</div>
				<div class="w-100 d-none d-lg-block "  >
					<div class="line" ></div>
					<div class="line" ></div>
					<div class="line" ></div>
					<div class="line" ></div>
				</div>
			</div>
			
		</div>
	</section>
	<!-- Section 1 End-->
	
	<!-- Section 2 Start-->
	<!-- Section for brands -->
 	<section class="home_section py-5">
		<h1 class="text-center "  >Top Brands</h1>
		<div class="py-5 brand_main_container">
		<div class="d-flex justify-content-between align-items-center p-2">
			<button type="button" class="fs-2 fw-bold px-1 py-1   btn btn-light  " onclick="scrole_brand_start()"><i class="bi bi-chevron-compact-left "></i></button>
			<button type="button" class="fs-2 fw-bold px-1 py-1  btn btn-light  " onclick="scrole_brand_end()"><i class="bi bi-chevron-compact-right "></i></button>	
		</div>
		<div class="px-4  d-flex    justify-content-start brand_container" id="brand_container_id"  >
			@foreach($brands as $brand)
				 
					 <div class="   px-2">
							<img src="{{$brand->image}}" alt="brand image" class="d-block mx-auto  brand_image " onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';"  >
							<!--<h6 class="text-center bg-light p-1"     >{{$brand->name}}  </h6>	-->
							
					 </div> 
			@endforeach
							
			</div>
			
		</div>
	</section> 
	 <!-- Section 2 End-->
	 
	<!-- Section 3 Start-->
	<!-- Section for Special Offers -->
	<section class="home_section py-5" >
		<h1 class="text-center "  >Special Offer</h1>
			<div class="row justify-content-center     mx-auto py-5  " style="width:100; max-width:1400px">
			
				@foreach($specialOffers as $specialOffer)
					 @include('customer/product_card', ['product' => $specialOffer])
				@endforeach
			</div>
	</section>
	<!-- Section 3 End-->
	 
	<!-- Section 4 Start-->
	<!-- Section for Features Offers -->
	<section class="home_section py-5">
		<h1 class="text-center "  >Features Product</h1>
			<div class="row justify-content-center    mx-auto py-5  " style="width:100; max-width:1400px">
			
				@foreach($products as $product)
						@include('customer/product_card', ['product' => $product])
				@endforeach
			</div>
	</section>
	<!-- Section 4 End-->
	 
	 
	 
	
	<!--<script src="{{asset('vender/js/customer/homeText.js')}}"></script>  -->
	<script> 
		
		const element1 = document.getElementById("navigation_link_home"); 
		const element2 = document.getElementById("navigation_link_home1"); 
		element1.classList.add("active_navigation_link");
		element2.classList.add("active_navigation_link");
		
		function scrole_brand_start()
		{
			const brand_container_id = document.getElementById("brand_container_id"); 
		 
			if (brand_container_id.scrollLeft - 150 >= 0) {
				brand_container_id.scrollLeft -= 150;
			} else {
				// If trying to scroll before 0, set scroll position to 0
				brand_container_id.scrollLeft = 0;
			}
		}
		function scrole_brand_end()
		{
			const brand_container_id = document.getElementById("brand_container_id"); 
			const maxScrollLeft = brand_container_id.scrollWidth - brand_container_id.clientWidth;
			if (brand_container_id.scrollLeft + 150 <= maxScrollLeft) {
				brand_container_id.scrollLeft += 150;
			} else {
				// If trying to scroll beyond the max, scroll to max position
				brand_container_id.scrollLeft = maxScrollLeft;
			}
		}
		
	</script>
</main>
@endsection