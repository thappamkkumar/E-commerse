<footer class="w-100 h-auto footer "   >
	<div class="    w-100 mx-auto py-5 px-2 "    >
		<!-- column for Logo  s-->
		<div class="  d-flex flex-column justify-content-start align-items-center     "   >
		 
			<strong class="footer_logo">@if(!empty($webDetail)) {{$webDetail[0]->webSiteName}} @endif</strong>
			 
			
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