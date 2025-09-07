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
		 
		<link href="{{asset('vender/css/home.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/navigation.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/color.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/searchBar.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/productDetail.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/product_card.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/footer.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/categories.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/myCart.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/profile.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/login.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/logout.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/loader.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/preLoading.css')}}" rel="stylesheet">
        
    </head>
    <body>
		@include('customer/navigation') 
		@include('loader/loader')
		@include('loader/preLoading')
		
		@yield('home') 
		@yield('login') 
		@yield('register') 
		@yield('productList') 
		@yield('categoriesList') 
		@yield('cartList') 
		@yield('orderList') 
		@yield('userProfile') 
		@yield('productSearch') 
		@yield('logout') 
		
		
		@include('customer/footer') 
		<script src="{{asset('vender/bootstrap/js/bootstrap.bundle.min.js')}}"></script>  
		<script src="{{asset('vender/js/customer/navigation.js')}}"></script> 
		<script src="{{asset('vender/js/admin/formSubmit.js')}}"></script> 
		<script src="{{asset('vender/js/preloader.js')}}"></script> 
		
    </body>
</html>