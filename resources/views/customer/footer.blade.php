<footer class="w-100 h-auto  "   >
	<div class="row   w-100 mx-auto py-5 px-2 "    >
		<!-- column for Logo  s-->
		<div class="col-12 col-md-6 col-lg-4 col-xl-3 py-5 py-md-3 d-flex flex-column justify-content-start align-items-center  sub_footer_sec  "   >
		 
			<strong class="footer_logo">@if(!empty($webDetail)) {{$webDetail[0]->webSiteName}} @endif</strong>
			
		</div>
		 <!-- column for   contacts-->
		<div class="col-12 col-sm-6 col-md-6 col-lg-4  col-xl-3   py-3 d-sm-flex flex-column justify-content-start align-items-center  sub_footer_sec "  >
			 	@if(!empty($webDetail))
				  
				 <div class=" ">
					<h3 class="  " ><span style="border-bottom:3px solid rgba(var(--black-color),1); color:rgba(var(--black-color),1); padding:0px 0px 5px 0px;">Contact Us</span></h3>
					<ul class="list-group py-3"  >
						<li class="list-group-item   border-0">
							<a href="{{$webDetail[0]->addressMapUrl}}" class="text-decoration-none footer_link" >
								<i class="bi bi-geo-alt-fill pe-2 "></i>{{$webDetail[0]->address}}
							</a>
						</li>
						<li class="list-group-item   border-0">
							<a href="mailto:{{$webDetail[0]->email}}" class="text-decoration-none footer_link"  >
								<i class="bi bi-envelope-fill pe-2"></i>{{$webDetail[0]->email}}
							</a>
						</li>
						<li class="list-group-item   border-0">
							<a href="tel:{{$webDetail[0]->contact}}" class="text-decoration-none footer_link"  >
								<i class="bi bi-telephone-fill pe-2"></i>{{$webDetail[0]->contact}}
							</a>
						</li>
					</ul>
				 </div>
				 
				 <div class="d-flex gap-2  ">
						<a href="{{$webDetail[0]->instagram}}" class="text-decoration-none btn btn-dark	 "  >
								<i class="bi bi-instagram 	"></i> 
						</a>
						<a href="{{$webDetail[0]->facebook}}" class="text-decoration-none btn btn-dark "  >
								<i class="bi bi-facebook 	"></i> 
						</a>
						<a href="{{$webDetail[0]->youtube}}" class="text-decoration-none btn btn-dark "  >
								<i class="bi bi-youtube 	"></i> 
						</a>
				 
				 </div>
				 
				@endif
			 
			
		</div>
		<!-- column for usefull  links -->
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3  py-3 d-sm-flex flex-column justify-content-start align-items-center  sub_footer_sec "  >
			<div>
				<h3 class="  text-sm-center "  ><span style="border-bottom:3px solid rgba(var(--black-color),1); color:rgba(var(--black-color),1); padding:0px 0px 5px 0px;">UseFull Links</span></h3>
				<div class="row w-100 mx-auto py-3 ">
					<div class="  col-6 py-1">
						<ul class="list-group"  >
							<li class="list-group-item  border-0">
								<a href="{{route('home')}}" class="text-decoration-none footer_link"  >Home</a>
							</li>
							<li class="list-group-item   border-0">
								<a href="{{route('productListForUser')}}" class="text-decoration-none footer_link"   >
									Products
								</a>
							</li>
							<li class="list-group-item   border-0">
								<a href="{{route('categoriesListForUser')}}" class="text-decoration-none footer_link"  >
									Categories
								</a>
							</li>
							<li class="list-group-item   border-0">
								<a href="{{route('userCartList')}}" class="text-decoration-none footer_link"  >
									Carts 
								</a>
							</li>
						</ul>
					</div>
					<div class="  col-6  py-1"> 
						<ul class="list-group"  >
							 
							
							<li class="list-group-item   border-0">
								<a href="{{route('userOrderList')}}" class="text-decoration-none footer_link"  >
									Orders
								</a>
							</li>
							<li class="list-group-item   border-0">
								<a href="{{route('userProfile')}}" class="text-decoration-none footer_link"  >
									Profile
								</a>
							</li>
							@auth
								<li class="list-group-item   border-0">
									<a href="{{route('logoutPage')}}" class="text-decoration-none footer_link"  >
										Logout
									</a>
								</li>
							@else
								<li class="list-group-item   border-0">
									<a href="{{route('loginPage')}}" class="text-decoration-none footer_link"  >
										Login
									</a>
								</li>
							@endauth
						</ul>
					</div>
					 
					 
				</div>
			</div>
		</div>
		<!-- column for Registeration  links -->
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3   py-3  d-sm-flex flex-column justify-content-start align-items-center  sub_footer_sec" >
			<div>
				<h3 class=" "  ><span style="border-bottom:3px solid rgba(var(--black-color),1); color:rgba(var(--black-color),1); padding:0px 0px 5px 0px;">Register  </span></h3>
				 <ul class="list-group py-3"  >
					<li class="list-group-item   border-0">
						<a href="{{route('registerPage')}}" class="text-decoration-none footer_link" >
							Register Now
						</a>
					</li>
					 
					 
				</ul>
			</div>
		</div>
		 
	</div>
	<div class="container-fluid bg-dark text-white text-center py-3 mx-auto" >
		<p class=" m-0 p-0" >&copy; <span>Copyright</span> <strong class="px-1 text-danger">@if(!empty($webDetail)) {{$webDetail[0]->webSiteName}} @endif</strong> <span>All Rights Reserved</span></p>
	</div>
	<div class="  d-flex flex-wrap justify-content-center align-items-center  text-dark   py-3  mx-auto  "  >
		  <h6 class=" m-0 p-0  ">Developer Contact :- </h6>
			<p class=" m-0 p-0 ps-3">  <a href="mailto:thappamkkumar@gmail.com"  target="_blank" class="text-decoration-none p-0">thappamkkumar@gmail.com</a> , </p>
			<p class=" m-0 p-0 ps-3">  <a href="https://wa.me/916005819576"  target="_blank" class="text-decoration-none p-0">6005819576</a></p>
			 
		 
	</div>
	
</footer>