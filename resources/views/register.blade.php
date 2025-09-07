@extends('customer/layout')
@section('register')
<main class="">
	<section   class="section_login_main_container"  >
		<div class="row w-100 mx-auto     py-3	 py-lg-0 login_main_container" >
			<div class="col-12  col-lg-7 col-xl-8   p-0  d-none d-lg-block">  	
					<img src="{{url('images/img2.svg')}}" alt="image" class=" mx-auto   "  onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';">
			</div> 
			  
			<div class="  col-12 col-lg-5 col-xl-4 p-0">
				
				<div class="px-3 py-5 login_container"  >
					<h1 class="text-center pb-5 m-0">Register</h1>
					
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
					<div class="alert alert-danger alert-dismissible fade show " role="alert" id="registrationMSG_Container">
						 
					</div>
					<form action="{{route('addUser')}}"  id="registrarionForm" method="POST" onsubmit="onSubmitLoader('registering')">
						@csrf 
						
						 
						 
						<div class="form-group">
							<label class="form-label   pt-3" for="contact_id">Mobile Number</label>
							<input type="tel" name="contact" id="contact_id"    class="form-control login_input" onchange="contactVerification(this.id, 'email_id')"  autocomplete="off"   />
						</div>
						<div class="form-group">
							<label class="form-label   pt-3" for="email_id">Email Id</label>
							<input type="email" class="form-control login_input" name="email" id="email_id" onchange="emailVerification(this.id)"    autocomplete="off"/>
						</div>
						
						
						
						<div class="form-group">
							<label class="form-label   pt-3" for="name_id">Name</label>
							<input type="text" class="form-control login_input" name="name" id="name_id"     autocomplete="off"/>
						</div>
						
						<div class="form-group">
							<label class="form-label   pt-3" for="password_id">Password</label>
							<input type="text" class="form-control login_input"  name="password" id="password_id"  onchange="passwordVerification(this.id)"  autocomplete="off" />
						</div>
						
						<div class="form-group" id="otpContainer">
							<label class="form-label   pt-3" for="otp_id">OTP</label>
							<input type="text" class="form-control login_input" name="otp" id="otp_id"   onchange="otpVerification(this.id)"   autocomplete="off"/>
							<div class="py-3 d-flex flex-wrap justify-content-between align-items-center ">
								<p class="text-mute" id="otpValidMSG">OTP is valid for only 5 minutes.</p>
								 <button class="btn  btn-light  border border-2 float-end"  onclick="sendOTP('email_id')"  id="resendBTN" >Resend OTP</button>
							</div>
						</div>
						
						
						
						
						
						 
						<button type="submit" class="btn mt-3 w-100 submit_btn">Submit</button>
						
						<div class="py-3">If you have an account then please <a href="{{route('loginPage')}}" class="btn registerBTN">Login</a> </div>
					</form>
				</div>
			</div>
		</div>
	</section>
	
	  
	
	<script  > var destinationUrl = "{{route('loginPage')}}"; </script>   
	<script src="{{asset('vender/js/registeration.js')}}"></script>   
		 <script> 
		  document.getElementById("navigation_link_login").style.backgroundColor="rgba(var(--black-color),0.6)"; 
		 const element2 = document.getElementById("navigation_link_login2");  
			element2.classList.add("active_navigation_link");
	</script>
	
</main>
@endsection