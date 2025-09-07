 
<header class="container-fluid   d-flex align-items-center  "  >  
	<button type="button" class="btn  p-0 px-2 text-dark border-0  d-md-none user_naviagtion_controll_btn " data-bs-toggle="offcanvas" data-bs-target="#sideNavBar"   ><i class="bi bi-list text-dark fw-bold fs-3 "></i></button>
	
	<div class="logo_contaniner w-100 text-center ">
		<strong    class="logo mx-auto"    >
			@if(!empty($webDetail)) {{$webDetail[0]->webSiteName}} @endif
		</strong>	
	</div>
	 
	<div class="navbar  navbar-expand  w-auto  d-none d-md-flex  "> 
		<ul class="navbar-nav d-flex align-items-center justify-content-center  "  >
			@guest   
				<li class="nav-item"><a href="{{route('loginPage')}}"    class="nav-link    rounded " id="navigation_link_login"      >Login</a></li>
			@else
				 <li class="nav-item"><a href="{{route('logout')}}"    class="nav-link    rounded " id="navigation_link_login"     >Logout</a></li>		
			@endguest

		</ul>
	</div>
	
	 
	 
</header>