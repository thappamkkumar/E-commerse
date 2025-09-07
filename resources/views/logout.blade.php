@extends('customer/layout')
@section('logout')
		<main class="home_container ">
			<section class="logout_container d-flex justify-content-center align-items-start">
				<div class="logout shadow-lg rounded px-4 py-4" >
					<h2>Logout</h2>
					<p>Click to confirm logout.</p>
					<a href="{{route('logout')}}" class="btn submit_btn float-end">OK</a>
				</div>
			</section>
			 
			  
		</main>
 
		
@endsection