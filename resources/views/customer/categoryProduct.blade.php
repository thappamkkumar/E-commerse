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
		
		 
		<link href="{{asset('vender/css/customer/navigation.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/color.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/searchBar.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/product_card.css')}}" rel="stylesheet">
		
		<link href="{{asset('vender/css/customer/productDetail.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/footer.css')}}" rel="stylesheet"> 
		<link href="{{asset('vender/css/preLoading.css')}}" rel="stylesheet">
         
    </head>
	<body> 
		@include('loader/preLoading')
		
		<header class="container-fluid   d-flex align-items-center justify-content-between  border border-bottom-1" id="user_navigation_container">  
			 <a href="{{route('userBack')}}" class="btn  p-0 px-2 text-dark border-0    user_naviagtion_controll_btn"    ><i class="bi bi-arrow-left fs-4 text-dark"></i></a>
							<a href="{{route('home')}}"  class="logo "    >
								@if(!empty($webDetail)) {{$webDetail[0]->webSiteName}} @endif
							</a>
			</div>
			  
			<div class="navbar  navbar-expand  w-auto    "> 
				<ul class="navbar-nav d-flex align-items-center justify-content-center  "  >
					 <li class="nav-item px-1 py-1 "><a href="{{route('productSearch.get')}}" class="nav-link     rounded navigation_link fs-3 " id="navigation_link_search1"     ><i class="bi bi-search    "></i></a></li>
				</ul>
			</div>
			 
		</header>  
		<main class="home_container pb-5">
			<section class="w-100     bg-white special_Offer" style="min-height:100vh; height:auto;">
				<h1 class="text-center pt-4"   > {{$categoryName}}  </h1>
				@if($products->total() > 0)
				
					<h5 class="text-center pt-4"  >
						@if($products->total() == 1)
							Only one product is  available....
						@else
							Total {{$products->total()}}  products are available....
						@endif
					
					</h5>
				 
				@else
					<h5 class="text-center pt-4"  >Products are not available</h5> 
				@endif
				
					<!-- List of products-->
					<div class="row w-100 mx-auto py-5  ">
			
					@foreach($products as $product)   
							@include('customer/product_card', ['product' => $product])
					@endforeach
				</div>
				 
			</section>
			@if($products->total() > 18)
				<div class="w-100 py-4 "      >
				
					<ul class="pagination  justify-content-center">
						@if($products->onFirstPage())
							<li class="page-item"><span class="btn   border border-2 me-1 ">Prev</span></li>
						@else 
							<li class="page-item"><a href="{{$products->previousPageUrl()}}"   class="   btn  btn-light border border-2 me-1">Prev</a></li>
						@endif
						@if($products->hasMorePages())
							<li class="page-item"><a href="{{$products->nextPageUrl()}}"  class=" btn  btn-light border border-2 ms-1">Next</a></li>
						 @else
							 <li class="page-item"><span class="   btn border border-2 ms-1">Next</span></li> 
						@endif
					</ul>
				</div>
			@endif
			 
			 
		</main>
		@include('customer/footer')
		<script src="{{asset('vender/bootstrap/js/bootstrap.bundle.min.js')}}"></script>  
		<script src="{{asset('vender/js/customer/navigation.js')}}"></script>  
		<script src="{{asset('vender/js/preloader.js')}}"></script>  
		
    </body>
</html>