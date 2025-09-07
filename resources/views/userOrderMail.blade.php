<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Shivam Electro Tools</title>

        
		<style>
			body
			{
				 
				padding:0px ;
				margin:0px; 
				background-color:rgba(240,240,240,1);
				font-size:18px;
			}

			 
			*
			{
				box-sizing:border-box;
				padding:0px ;
				margin:0px;
			}
			header
			{
				width:100%;
				height:auto;
				position:sticky;
				top:0px;
				padding:10px 10px 10px 10px;
				background:rgba(255,255,255,1);
				box-shadow:0px 5px 5px -3px rgba(0,0,0,0.5);
			}
			 
			.header_logo
			{
				width:200px;
				height:60px;
				display:block;
				margin:auto;
				
			}
			main
			{
				width:100%;
				height:auto;
				padding:0px 0px 0px 0px;
				background:rgba(255,255,255,1);
				color:rgba(0,0,0,1);
			}
			
			section
			{
				width:100%;
				height:auto;
				 
				padding:20px 10px 20px 10px;;
			}
			 
			.section_h1
			{
				padding:10px 0px 10px 0px; 
				text-align:center;
			}
			.section_h3
			{
				padding:10px 0px 10px 0px; 
				color:rgba(0,0,0,0.7);
				text-align:center;
			}
			
			footer
			{
				width:100%;
				height:auto;
				padding:20px 10px 20px 10px;
				background:rgba(255,255,255,1);
			}
			.footer_h2
			{
				text-align:center;
				
			}
			.footer_h2_sub
			{
				border-bottom:2px solid #000;
				padding:0px 20px 5px 20px;
			}
			.footer_social_media_container
			{
				width:auto;
				height:auto;
				 
				padding:20px 0px 20px 0px; 
				text-align:center;
			}
			.footer_social_media_link
			{
				text-decoration:none;
				
				 
			}
			.footer_social_media
			{
				width:40px;
				height:40px;
				margin:10px 5px 10px 5px;
				 
				
			}
			.footer_social_media:hover
			{
				transform:scale(0.8,0.8);
			}
			
			@media only screen and (min-width:768px) and (max-width:992px)
			{
				 
				header, main, footer
				{
					width:90%;
					margin:auto;
				}
			}
			@media only screen and (min-width:992px) and (max-width:1200px)
			{
				header, main, footer
				{
					width:80%;
					margin:auto;
				}
			}
			@media only screen and (min-width:1200px) and (max-width:1600px)
			{
				header, main, footer
				{
					width:70%;
					margin:auto;
				}
			}
			@media only screen and (min-width:1600px) and (max-width:2400px)
			{
				header, main, footer
				{
					width:1600px;
					margin:auto;
				}
			}
			@media only screen and (min-width:2400px)
			{
				
				header, main, footer
				{
					width:1600px;
					margin:auto;
				}
			}
			.cart_container
			{
				width:100%;
				height:auto;
				padding:20px 0px 20px 0px;
			}
			
			.cart
			{
				width:100%;
				height:auto;
				padding:10px 10px 10px 10px;
				box-shadow:0px 10px 15px -8px rgba(100,100,100,1);
				background-color:#fff;
				border-radius:10px;
				position:relative;
				border:1px solid rgba(100,100,100,0.3);
			}
			.sub_cart_1
			{
				display:flex;
			}
			.cart_product_image
			{
				width:150px;
				aspect-ratio:1/0.7;
				 
			} 
			@media only screen and (min-width:768px) and (max-width:992px)
			{
				.cart_product_image
				{
					width:120px;
					aspect-ratio:1/0.8;
				}
			}
			@media only screen and (min-width:576px) and (max-width:768px)
			{
				
				.cart
				{
					width:80%;
					margin:auto;
				}
				.cart_product_image
				{
					width:150px;
					aspect-ratio:1/0.7;
				}
			}
			@media only screen and (min-width:400px) and (max-width:576px)
			{
				.cart_product_image
				{
					width:100px;
					aspect-ratio:1/1;
				}
			}
			@media only screen and (min-width:300px) and (max-width:400px)
			{
				.cart_product_image
				{
					width:80px;
					aspect-ratio:1/1;
				}
					 
			}
			@media only screen and (min-width:0px) and (max-width:300px)
			{
				.sub_cart_1
				{
					display:flex;
					flex-direction:column;
				}
				.cart_product_image
				{
					width:100%;
					aspect-ratio:1/0.8;
				} 
			}
			.sub_cart_1_h2
			{
				padding:0px 10px 0px 10px;
			}
			.sub_cart_1_p
			{
				padding:10px 10px 10px 10px; 
				 
			}
			 
			  
			.detail_container
			{
				width:100%;
				height:auto;
				padding:20px 0px 20px 0px;
				
			}
			
			table{
				width:100%;
				border-spacing:0px;
			}
			 
			table th{
				text-align:left; 
				padding:3px 0px 3px 0px;
			}
			table td{
				text-align:right; 
				 padding:3px 0px 3px 0px;
			}
			.btn_container
			{
				width:100%;
				height:auto;
				display:flex;
				flex-wrap:wrap;
				justify-content:center;
				align-items:center;
				text-align:center;
				padding:20px 0px 20px 0px;
				 
			}
			.btn_cart
			{
				display:inline-block;
				width:auto;
				height:auto;
				padding:2px 25px 2px 25px;
				border:3px solid rgba(25,150,230,1);
				color:rgba(25,150,200,1);
				text-decoration:none;
				font-size:1.2rem;
				font-weight:bold;
				letter-spacing:1px;
				border-radius:5px;
				margin:0px 5px 0px 5px;
			}
			.btn_cart:hover
			{
				background:rgba(25,150,200,1);
				color:#fff;
			}
			.btn_buy
			{
				display:inline-block;
				width:auto;
				height:auto;
				padding:5px 25px 5px 25px;
				border:3px solid rgba(25,150,230,1);
				background:rgba(25,150,230,1);
				color:#fff;
				text-decoration:none;
				font-size:1.2rem;
				font-weight:bold;
				letter-spacing:1px;
				border-radius:5px;
				margin:0px 5px 0px 5px;
			}
			.btn_buy:hover
			{
				background:rgba(25,150,200,0.5);
				 
			}
			.section_sub_h4
			{
				padding:10px 0px 10px 0px;
			}
			
			.section_sub_p
			{
				
			}
		 </style>
		 
    </head>
    <body >  
		<header>
			 <img src="{{$message->embed(asset('logo/nav_logo.png'))}}" class="header_logo" alt="shivam electro tools">
		</header> 
		<main>
			<section >
				<h1 class="section_h1" >Welcome to Shivam Electro Tools</h1>
				<h2 class="section_h3" >Order Recieved</h2>
				<div style="padding:20px 0px 10px 0px;">
					<p class="section_sub_p">Dear <span style="font-weight:bold;">{{$order->getUserData->name}}</span>, we received your order. Your order will be shipped to you within 7 days.</p>
					<h4 class="section_sub_h4">Delivery Address </h4>
					<p class="section_sub_p">  {{$order->address->area_street_sector_village}},  {{$order->address->flat_houseno_building_company}},  {{$order->address->district}}, {{$order->address->states}}, {{$order->address->pincode}}, {{$order->address->country}}</p>
					
					<h4 class="section_sub_h4">Payment Status</h4>
					<p class="section_sub_p">  {{ucfirst(strtolower($order->payment_status))}}  </p>
					<h4 class="section_sub_h4">Transection ID</h4>
					<p class="section_sub_p">  {{$order->getTransactionData->transection_id }} </p>
					
				</div>
				<div class="cart_container">
					<h4 class="section_sub_h4">Order</h4>
					<div class="cart  "  data-aos="fade-up"   data-aos-duration="500">
							 
						<div class="sub_cart_1">
							<div class="  ">
								<img src="{{$message->embed(asset('product_thumnail/abcd_product_11_thumnail.jpg'))}}" alt="product image" class="cart_product_image">
							</div>
							<div class=" ">
								<h2 class="sub_cart_1_h2">{{$order->getProductData->name}} </h2>
								 
								<p class="sub_cart_1_h2">
									<a href="{{route('productDetail',['productCode'=>$order->product_id])}}"  style="text-decoration:none;">Detail </a>
								</p>
							</div>
						</div>
						<div class="detail_container">
							<table>
								<tbody>
									<tr>
										<th>Quantity :- </th><td>{{$order->quantity}}</td>
									</tr>
									<tr>
										<th>Payment :- </th>
										<td>
										<span style="font-weight:bold;">Rs. </span>
											 
												{{$order->getTransactionData->amount}} 
											 
										</td>
									</tr>
									<tr>
										<th>Status :- </th>
										<td> 
											 
												{{$order->order_status}} 
											 
										</td>
									</tr>
									 
								</tbody>
							</table>
						</div>
						 
						
					</div>
				
				</div>
				<h4 class="section_h4">Thanks for buying product.</h4>
			</section> 
		</main>
		<footer>
			<h2 class="footer_h2"><span class="footer_h2_sub">Get In Touch</span></h2>
			<div class="footer_social_media_container">
				
				<a href=""  class="footer_social_media_link" ><img src="{{$message->embed(URL('images/instagram.png'))}}" class="footer_social_media  "  alt="instagram"> </a>
				<a href=""   class="footer_social_media_link"   ><img src="{{$message->embed(URL('images/facebook.png'))}}" class="footer_social_media  "  alt="facebook"> </a>
				<a href=""   class="footer_social_media_link"   ><img src="{{$message->embed(URL('images/whatsapp.png'))}}"  class="footer_social_media  "  alt="whatsapp"> </a>
				<a href=""   class="footer_social_media_link"   ><img src="{{$message->embed(URL('images/youtube.png'))}}" class="footer_social_media  "   alt="youtube"> </a>
			</div>
		</footer>
		 
	 </body>
</html>