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
		
		<link href="{{asset('vender/css/admin/navigation.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/admin/dashboard.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/admin/table.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/admin/user_profile.css')}}" rel="stylesheet">
		
		<link href="{{asset('vender/css/color.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/login.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/logout.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/loader.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/preLoading.css')}}" rel="stylesheet">
		
		
        <script src="{{asset('vender/tinymce_6/tinymce/js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
		<script>tinymce.init({ 
											selector:'#product_description',
											height:'300px'											
											
										});
		</script>
    </head>
    <body>
		
				@include('loader/preLoading')
		<div class="d-flex   justify-content-center  container_body">
			@include('admin/sideNav/navigation')
			<main class="w-100   pb-5 pb-md-0  ">
			
				@include('admin/header/header')
				@include('loader/loader')
				@yield('admin.dashboard')  
				@yield('admin.profile') 
				
				@yield('admin.userList')  
				@yield('admin.userSearch')  
				@yield('admin.userProfile') 
				
				@yield('admin.categoryList')  
				@yield('admin.categoryDetail') 
				
				@yield('admin.brandList') 
				@yield('admin.brandDetail') 
				
				@yield('admin.productList')  
				@yield('admin.productSearch')  
				@yield('admin.productDetail') 
				@yield('admin.addProduct') 
				@yield('admin.productUpdate') 
				
				@yield('admin.orderList')  
				@yield('admin.orderDetail')  
				@yield('admin.transectionList')  
				@yield('admin.transectionDetail')   
				@yield('logout') 
				
				@include('admin/footer/footer')
			</div>
		</div>
	  
		
		  
		
		<script src="{{asset('vender/bootstrap/js/bootstrap.bundle.min.js')}}"></script>  
		<script src="{{asset('vender/js/admin/formSubmit.js')}}"></script> 
		<script src="{{asset('vender/js/preloader.js')}}"></script> 
		
    </body>
</html>