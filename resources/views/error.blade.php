<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shivam Electro Tools</title>

        <link href="{{asset('vender/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
		<link href="{{asset('vender/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet"> 
		<style>
			:root {  
				--main-color: #eaeaea;
				--stroke-color: black;
			  --white-color: 255,255,255;
			  --black-color: 0,0,0; 
			   
			}
			body
			{
				position:relative;
				padding:0px ;
				margin:0px;
				overflow-X:hidden;
				overflow-Y:auto;
				-ms-overflow-style:none;
				-scroll-width:none; 
				color:rgba(var(--black-color),1);
				background:rgba(var(--white-color),1);
				 			
			}

			body::-webkit-scrollbar
			{
				display:none;
				
			} 

			*
			{
				box-sizing:border-box;
				padding:0px ;
				margin:0px;
				
			}
			h1
			{
				font-size:10rem;
			}
			@media only screen and (max-width:768px)
			{
				h1
				{
					font-size:5rem;
				}
			}
			
			.gears {
			  position: relative;
			  margin: 0 auto;
			  width: auto; height: 0;
			}
			.gear {
			  position: relative;
			  z-index: 0;
			  width: 120px; height: 120px;
			  margin: 0 auto;
			  border-radius: 50%;
			  background: var(--stroke-color);
			}
			.gear:before{
			  position: absolute; left: 5px; top: 5px; right: 5px; bottom: 5px;
			  z-index: 2;
			  content: "";
			  border-radius: 50%;
			  background: var(--main-color); 
			}
			.gear:after {
			  position: absolute; left: 25px; top: 25px;
			  z-index: 3;
			  content: "";
			  width: 70px; height: 70px;
			  border-radius: 50%;
			  border: 5px solid var(--stroke-color);
			  box-sizing: border-box;
			  background: var(--main-color); 
			}
			.gear.one {
			  left: -130px;
			}
			.gear.two {
			  top: -75px;
			}
			.gear.three {
			  top: -235px;
			  left: 130px;
			}
			.gear .bar {
			  position: absolute; left: -15px; top: 50%;
			  z-index: 0;
			  width: 150px; height: 30px;
			  margin-top: -15px;
			  border-radius: 5px;
			  background: var(--stroke-color);
			}
			.gear .bar:before {
			  position: absolute; left: 5px; top: 5px; right: 5px; bottom: 5px;
			  z-index: 1;
			  content: "";
			  border-radius: 2px;
			  background: var(--main-color);
			}
			.gear .bar:nth-child(2) {
			  transform: rotate(60deg);
			  -webkit-transform: rotate(60deg);
			}
			.gear .bar:nth-child(3) {
			  transform: rotate(120deg);
			  -webkit-transform: rotate(120deg);
			}
			@-webkit-keyframes clockwise {
			  0% { -webkit-transform: rotate(0deg);}
			  100% { -webkit-transform: rotate(360deg);}
			}
			@-webkit-keyframes anticlockwise {
			  0% { -webkit-transform: rotate(360deg);}
			  100% { -webkit-transform: rotate(0deg);}
			}
			@-webkit-keyframes clockwiseError {
			  0% { -webkit-transform: rotate(0deg);}
			  20% { -webkit-transform: rotate(30deg);}
			  40% { -webkit-transform: rotate(25deg);}
			  60% { -webkit-transform: rotate(30deg);}
			  100% { -webkit-transform: rotate(0deg);}
			}
			@-webkit-keyframes anticlockwiseErrorStop {
			  0% { -webkit-transform: rotate(0deg);}
			  20% { -webkit-transform: rotate(-30deg);}
			  60% { -webkit-transform: rotate(-30deg);}
			  100% { -webkit-transform: rotate(0deg);}
			}
			@-webkit-keyframes anticlockwiseError {
			  0% { -webkit-transform: rotate(0deg);}
			  20% { -webkit-transform: rotate(-30deg);}
			  40% { -webkit-transform: rotate(-25deg);}
			  60% { -webkit-transform: rotate(-30deg);}
			  100% { -webkit-transform: rotate(0deg);}
			}
			.gear.one {
			  -webkit-animation: anticlockwiseErrorStop 2s linear infinite;
			}
			.gear.two {
			  -webkit-animation: anticlockwiseError 2s linear infinite;
			}
			.gear.three {
			  -webkit-animation: clockwiseError 2s linear infinite;
			}
			.loading .gear.one, .loading .gear.three {
			  -webkit-animation: clockwise 3s linear infinite;
			}
			.loading .gear.two {
			  -webkit-animation: anticlockwise 3s linear infinite;
			}
			 @media only screen and (min-width:1200px)  
			{
				 .gears_cont
					{
						transform:scale(2,2);
					}
			}
			 @media only screen and (min-width:992px) and (max-width:1200px)
			{
				 .gears_cont
					{
						transform:scale(1.5,1.5);
					}
			}
			 @media only screen and (max-width:992px)
			{
				 .gears_cont
					{
						transform:scale(1,1);
					}
			}
			@media only screen and (max-width:576px)
			{
				 .gears_cont
					{
						transform:scale(0.8,0.8);
					}
			}
			@media only screen and (max-width:400px)
			{
				 .gears_cont
					{
						transform:scale(0.7,0.7);
					}
			}
			@media only screen and (max-width:300px)
			{
				 .gears_cont
					{
						transform:scale(0.5,0.5);
					}
			}
		</style>
    </head>
    <body >
		 
		<main class="  d-flex flex-column justify-content-start align-items-center py-5 "  style="min-height:100vh; height:auto; overflow:hidden;">
			<section class="w-auto height-auto text-center  ">
				<h1 class="text-muted">Error</h1>
				<p>{{$message}}</p> 
				
			</section>
			<section class="w-auto height-auto text-center py-5 gears_cont">
			<div class="gears">
					<div class="gear one">
					  <div class="bar"></div>
					  <div class="bar"></div>
					  <div class="bar"></div>
					</div>
					<div class="gear two">
					  <div class="bar"></div>
					  <div class="bar"></div>
					  <div class="bar"></div>
					</div>
					<div class="gear three">
					  <div class="bar"></div>
					  <div class="bar"></div>
					  <div class="bar"></div>
					</div>
				  </div> 
			</section>
		</main>
		 
		
		 
		<script src="{{asset('vender/bootstrap/js/bootstrap.bundle.min.js')}}"></script>  
		
		 
	 </body>
</html>