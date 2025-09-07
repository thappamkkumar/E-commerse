@extends('customer/layout')
@section('login')
<main class="">
	<section   class="section_login_main_container"  >
		<div class="row w-100 mx-auto     py-3	 py-lg-0 login_main_container" >
			<div class="col-12  col-lg-7 col-xl-8   p-0  d-none d-lg-block">  	
					<img src="{{url('images/img2.svg')}}" alt="image" class=" mx-auto   " onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';">
			</div> 
			  
			<div class="  col-12 col-lg-5 col-xl-4 p-0  ">
				
				<div class="px-3 py-5 login_container" >
					<h1 class="text-center pb-5 m-0">Login</h1>
					
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
					
					<form action="{{route('authenticate')}}" method="post" onsubmit="onSubmitLoader('Logging')">
						@csrf
						<div class="form-group">
							<label class="form-label   pt-3" for="email_id">Email Id</label>
							<input type="email" class="form-control login_input" name="email" id="email_id" />
						</div>
						<div class="form-group">
							<label class="form-label   pt-3" for="password_id">Password</label>
							<input type="password" class="form-control login_input" name="password" id="password_id" autocomplete />
						</div>
						<div class="py-3"  ><input type="checkbox" class ="form-check-input login_check " name="remember" id="remember_id"> <label for="remember_id" class="form-label ps-2  " >Remember me  </label></div>
						
						<button type="submit" class="btn mt-3 w-100 submit_btn">Login</button>
						
						<div class="py-3">If you don't have an account then please <a href="{{route('registerPage')}}" class="btn registerBTN">Register</a> </div>
					</form>
				</div>
			</div>
		</div>
	</section>
	
	 
	 
</main>
 
<script> 
		  document.getElementById("navigation_link_login").style.backgroundColor="rgba(var(--black-color),0.6)"; 
			const element2 = document.getElementById("navigation_link_login2");  
			element2.classList.add("active_navigation_link");
	</script>
	
	
@endsection