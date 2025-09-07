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
			 
			
			@media only screen and (min-width:768px) and (max-width:992px)
			{
				 
				 main 
				{
					width:90%;
					margin:auto;
				}
			}
			@media only screen and (min-width:992px) and (max-width:1200px)
			{
				 main 
				{
					width:80%;
					margin:auto;
				}
			}
			@media only screen and (min-width:1200px) and (max-width:1600px)
			{
				  main 
				{
					width:70%;
					margin:auto;
				}
			}
			@media only screen and (min-width:1600px) and (max-width:2400px)
			{
				 main 
				{
					width:1600px;
					margin:auto;
				}
			}
			@media only screen and (min-width:2400px)
			{
				
				 main 
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
		
		 </style>
		 
    </head>
    <body >  
		 
		<main>
			<section >
				<h1 class="section_h1" >Welcome to Shivam Electro Tools</h1>
				<h3 class="section_h3" >Your product is added to cart list successfully.</h3>
				<div class="cart_container">
					<div class="cart  "  data-aos="fade-up"   data-aos-duration="500">
							 
						<div class="sub_cart_1">
							<div class="  ">
								<img src="{{$message->embed(URL('product_thumnail/'.$cart->product->thumnail))}}" alt="product image" class="cart_product_image">
							</div>
							<div class=" ">
								<h2 class="sub_cart_1_h2">{{$cart->product->name}}   </h2>
								<p class="sub_cart_1_p"><span style="font-weight:bold;">Rs. </span> 
									@if($cart->product->sale_price > 0)
										{{$cart->product->sale_price}} 
									@else
										 {{$cart->product->price}}
									@endif
								</p>
								<p class="sub_cart_1_h2">
									<a href="{{route('productDetail',['productCode'=>$cart->product])}}"  style="text-decoration:none;">Detail </a>
								</p>
							</div>
						</div>
						<div class="detail_container">
							<table>
								<tbody>
									<tr>
										<th>Quantity :- </th><td>{{$cart->quantity}}</td>
									</tr>
									<tr>
										<th>Total :- </th>
										<td>
										<span style="font-weight:bold;">Rs. </span>
											@if($cart->product->sale_price > 0)
												{{$cart->product->sale_price * $cart->quantity}} 
											@else
												 {{$cart->product->price * $cart->quantity }} 
											@endif
										</td>
									</tr>
									 
								</tbody>
							</table>
						</div>
						<div class="btn_container">
							<a href="{{route('userCartList')}}" class="btn_cart">Cart List</a>
						 
							<form action=" " method="post">
								@csrf
								<input type="hidden" name="id" value="{{$cart->product->id}}"> 
								<button type="submit" class="btn_buy">Buy Now</button>
							</form>
						</div>
						
					</div>
				
				</div>
			</section> 
		</main>
		 
		 
	 </body>
</html>