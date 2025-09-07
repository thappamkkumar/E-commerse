 

<header class="container-fluid   d-flex align-items-center justify-content-between border border-bottom-1  " id="user_navigation_container" >  
	<button type="button" class="btn  p-0 px-2 text-dark border-0  d-lg-none user_naviagtion_controll_btn " data-bs-toggle="offcanvas" data-bs-target="#sideNavBar"   ><i class="bi bi-list text-dark fw-bold fs-3 "></i></button>
	<div class="logo_contaniner   ">
		 
		<a href="{{route('home')}}"  class="logo d-block text-nowrap"     >
			@if(!empty($webDetail)) {{$webDetail[0]->webSiteName}} @endif
		</a>
 	
	</div>
	<nav class="navbar   navbar-expand d-none d-lg-flex   w-100  " >
		<ul class="navbar-nav align-items-center mx-auto    "   > 
			<li class="nav-item  px-1 py-1"><a href="{{route('home')}}" class="nav-link rounded  navigation_link  " id="navigation_link_home"   >Home</a></li>
			<li class="nav-item px-1 py-1"><a href="{{route('productListForUser')}}" class="nav-link rounded  navigation_link  " id="navigation_link_products"   >Products</a></li>
			<li class="nav-item px-1 py-1"><a href="{{route('categoriesListForUser')}}" class="nav-link rounded  navigation_link  " id="navigation_link_categories"   >Categories</a></li>
			
			<li class="nav-item px-1 py-1"><a href="{{route('productSearch.get')}}" class="nav-link     rounded navigation_link fs-3 fw-bold " id="navigation_link_search"       ><i class="bi bi-search    "></i></a></li>
			
			<li class="nav-item px-1 py-1"><a href="{{route('userCartList')}}" class="nav-link rounded  navigation_link  " id="navigation_link_carts"   >Carts</a></li>
			<li class="nav-item px-1 py-1"><a href="{{route('userOrderList')}}" class="nav-link  rounded navigation_link  " id="navigation_link_orders" >Orders</a></li>
			
			@auth 
				<li class="nav-item"><a href="{{route('userProfile')}}"  class="nav-link rounded navigation_link  "  id="navigation_link_profile"     > Profile	</a>
				</li> 
			  
			@endauth
		</ul>
	</nav> 
	<div class="navbar  navbar-expand  w-auto    "> 
		<ul class="navbar-nav d-flex align-items-center justify-content-center  "  >
			 <li class="nav-item px-1 py-1 d-inline-block d-lg-none"><a href="{{route('productSearch.get')}}" class="nav-link     rounded navigation_link fs-3 "   id="navigation_link_search1"    ><i class="bi bi-search    "></i></a></li>
			 
			@guest   
				<li class="nav-item"><a href="{{route('loginPage')}}"    class="nav-link   d-none d-lg-flex py-1 px-2  rounded " id="navigation_link_login"   >Login <i class="bi bi-box-arrow-in-right ms-2"></i></a></li>
			@else
				
			
				<li class="nav-item ps-2  d-none d-lg-inline-block">
					<a href="{{route('logoutPage')}}"  class="nav-link   d-none d-lg-flex py-1 px-2  rounded   " id="navigation_link_logout"   > Logout <i class="bi bi-box-arrow-right ms-2"></i> </a>
				</li>			
			@endguest

		</ul>
	</div>
	
	<div class="offcanvas   offcanvas-start   " id="sideNavBar" style="background:rgba(var(--white-color),1);">
		<div class="offcanvas-header w-100 d-flex flex-row-reverse">
			 
			<button type="button" class="btn  p-0 px-2 text-dark border-0    user_naviagtion_controll_btn  " data-bs-dismiss="offcanvas"  ><i class="bi bi-x-lg text-dark fw-bold fs-3 "></i></button>
		</div>
		<div class="offcanvas-body  ">
			<nav class="navbar     w-100">
				<ul class="navbar-nav   w-100  "   > 
					<li class="nav-item py-1"><a href="{{route('home')}}" class="nav-link px-2 py-1   rounded navigation_link  " id="navigation_link_home1"    >Home</a></li>
					<li class="nav-item   py-1"><a href="{{route('productListForUser')}}"  class="nav-link  px-2 py-1 rounded   navigation_link" id="navigation_link_products1"  >Products</a></li>
					<li class="nav-item  py-1 "><a  href="{{route('categoriesListForUser')}}"  class="nav-link px-2 py-1  rounded  navigation_link" id="navigation_link_categories1"   >Categories</a></li>
					<li class="nav-item   py-1 "><a href="{{route('userCartList')}}" class="nav-link px-2 py-1  rounded  navigation_link" id="navigation_link_carts1"    >Carts</a></li>
					<li class="nav-item    py-1"><a href="{{route('userOrderList')}}" class="nav-link px-2 py-1 rounded navigation_link " id="navigation_link_orders1"   >Orders</a></li>
					@auth
						<li class="nav-item   py-1"><a href="{{route('userProfile')}}"  class="nav-link  px-2 py-1 rounded  navigation_link  " id="navigation_link_profile1"    >Profile</a></li>
						<li class="nav-item   py-1"><a href="{{route('logoutPage')}}"  class="nav-link  px-2 py-1 rounded  navigation_link  " id="navigation_link_logout2"    >Logout</a></li>
						@else
							<li class="nav-item   py-1"><a href="{{route('loginPage')}}"  class="nav-link  px-2 py-1 rounded  navigation_link  " id="navigation_link_login2"    >Login</a></li>
					@endauth
				</ul>
			</nav> 
		</div>
	</div>
	 
</header>