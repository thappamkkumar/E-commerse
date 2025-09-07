<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shivam Electro Tools</title>
 
		 
		
		 <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
		
		<link href="{{asset('vender/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
		<link href="{{asset('vender/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">  
	 
		<link href="{{asset('vender/css/customer/navigation.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/color.css')}}" rel="stylesheet"> 
		<link href="{{asset('vender/css/customer/product_card.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/footer.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/customer/productDetail.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/login.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/loader.css')}}" rel="stylesheet">
		<link href="{{asset('vender/css/preLoading.css')}}" rel="stylesheet">
		
    </head>
    <body > 
		@include('loader/loader')
		@include('loader/preLoading')
		
		<header class="container-fluid   d-flex align-items-center justify-content-between border border-bottom-1 " id="user_navigation_container">  
			 <a href="{{route('userBack')}}" class="btn  p-0 px-2 text-dark border-0    user_naviagtion_controll_btn" ><i class="bi bi-arrow-left fs-4 text-dark"></i></a>
				<a href="{{route('home')}}"  class="logo "    >
					@if(!empty($webDetail)) {{$webDetail[0]->webSiteName}} @endif
				</a>	
			</div>
			  
			<div class="navbar  navbar-expand  w-auto    "> 
				<ul class="navbar-nav d-flex align-items-center justify-content-center  "  >
					 <li class="nav-item px-1 py-1 "><a href="{{route('productSearch.get')}}" class="nav-link     rounded navigation_link fs-3 "  id="navigation_link_search1"      ><i class="bi bi-search    "></i></a></li>
				</ul>
			</div>
			 
		</header>  
		<main  class="py-3">
			<section class="productDetail_container">
				@if($errors->any())
					<div class=" w-100 mx-auto alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
						<h3>Errors</h3>
						<ul>
							@foreach($errors->all() as $error)
								<li> {{ $error }} </li>
							@endforeach
						</ul>
					</div>
				@endif 
				@include('alert_box')
				
				
				<div class="row p-0 m-0">
					<div class="col-12 col-md-6   p-0 m-0 d-flex justify-content-center align-items-center align-items-md-center  flex-column"   >
			<!-- div for slide show of images-->
						<div class="carousel slide  " data-bs-ride="carousel"   id="user_product_detail_images">
							<div class="carousel-inner">
								@foreach($product->images as $images)
									@php   
											$image = $images;  
																 
											if(empty($image) || $image == "")
											{
												$image = "images/imageError.jpg";
											}
									@endphp
									<div class="carousel-item @if($loop->first){{'active'}} @endif ">
										<img src="{{ url($image ) }} " alt="product image" class="d-block " id="product_images" onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';">
									</div>
									 
								@endforeach
							</div>
			<!--Left and Right Control / Icons-->
							<button type="button" class="carousel-control-prev"  data-bs-target="#user_product_detail_images" data-bs-slide="prev"><span class="carousel-control-prev-icon   " style="background-color:rgba(0,0,0,0.5); padding:30px 0px 30px 0px;" ></span></button>
							<button type="button" class="carousel-control-next"   data-bs-target="#user_product_detail_images" data-bs-slide="next"><span class="carousel-control-next-icon" style="background-color:rgba(0,0,0,0.5); padding:30px 0px 30px 0px;"></span></button>
					 
						</div>
		<!--div for slide indicator-->
						<div class="slide_indicator_container d-flex justify-content-center align-items-center">
							<button type="button" class="slide_indicator_pre" onclick="scrole_start()"><i class="bi bi-chevron-compact-left "></i></button>
							<div class="sub_slide_indicator" id="sub_slide_indicator_id">
								<div class="d-flex overflow:hidden    " id="inner_sub_slide_indicator">
									@php $count_img_1=0;@endphp
									@foreach($product->images as $images)
										@php   
												$image = $images;  
																	 
												if(empty($image) || $image == "")
												{
													$image = "images/imageError.jpg";
												}
										@endphp
										<div class=" mx-1 my-0">
											<button type="button" class="slide_image_indicator" data-bs-target="#user_product_detail_images" data-bs-slide-to="{{$count_img_1}}" class="@if($loop->first){{'active'}} @endif">
												<img src="{{ url($image) }} " alt="product image" class="w-100 h-100 "  onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';">
											</button>
										 </div>
											 
										@php  $count_img_1=$count_img_1 + 1; @endphp
									@endforeach
								</div>
							</div>
							<button type="button" class="slide_indicator_next" onclick="scrole_end()"><i class="bi bi-chevron-compact-right "></i></button>
						</div>
					 
					</div>
		<!-- div for  product basic details -->
					<div class="col-12 col-md-6  p-0 m-0 py-3 py-md-0 px-md-5  "    >
						<h4 class="px-0 m-0" >{{$product->name}} </h4>
						<div class=" m-0 p-0 py-2  "> 
							 
							<span class="bg-success text-white px-2  d-inline-flex align-items-center rounded-2"><span>@php echo ceil($product->reviews->avg('rating'));@endphp</span> <i class="bi bi-star-fill  ps-1" style="color:rgba(255,255,255,1);"  ></i></span>
						</div> 
						<div class="p-0 m-0      d-flex align-items-center">
							
							@if($product->sale_price>0) 
								<p class="p-0 m-0">MRP<del class="text-muted ps-1">Rs. {{$product->price}} </del></p><p class="text-danger fw-bold p-0 m-0 ps-2">{{$product->discount}} OFF</p>
							 
							@endif 
						</div>
						
						<div class="p-0 m-0 py-2  d-flex align-items-center">
							
							@if($product->sale_price>0) 
								<h4 class="p-0 m-0">Rs.{{$product->sale_price}}</h4><span class="text-muted ps-2"> + {{ $product->gst}} GST </span>
							@else 
								<h4 class="p-0 m-0">Rs.{{$product->price}}</h4><span class="text-muted ps-2"> + {{ $product->gst}} GST </span>
							@endif 
						</div>
						<p class="p-0 m-0   text-muted">
							Rs.
							@if($product->sale_price>0) 
								{{$product->sale_price + $product->gst}}
							@else
								{{$product->price + $product->gst}}
							@endif
							(Incl. of all taxes)
						</p>
						<p class="p-0 m-0   text-muted">
							
							@if($product->delivery_charges>0) 
								<span class="  ">Delivery Charges :- </span> Rs. {{$product->delivery_charges}}
							@else
								<span class="text-danger">Free delivery</span>
							@endif
							 
						</p>
						
						@if($product->stock>0) 
							<p class="p-0 m-0  pt-2 pb-2  "> In Stock </p>
							 
							<div class=" row  d-flex   p-0 m-0  py-4  h-auto   ">
								@auth
									 
									@if( auth()->user()->carts->where('product_id',$product->id)->count() == 0)
									<div class="col-6 px-1 m-0">
									<!-- button for add cart-->
										<a href="{{route('addToCart',['productData'=>$product])}}" onclick="onSubmitLoader('saving')" class="btn add_to_cat_btn    w-100 h-auto fw-bold">ADD CART</a>
									</div>
										
										
									@else
									<div class="col-6 px-1 m-0">
								<!-- button for watch cart list-->
										<a href="{{route('userCartList')}}" class="btn add_to_cat_btn    w-100 h-auto fw-bold">VIEW MY CART</a>
									</div>
									@endif
								<!-- button for buy now-->
									<div class="col-6  px-1 m-0"> 
										<a href="{{route('orderVerfication',['product'=>$product])}}" class="btn buy_btn  
											w-100 h-auto fw-bold">BUY NOW</a>
									</div>
								@endauth
								
							</div>
						@else 
							<p class="p-0 m-0  py-1 ">  Out Of Stock	</p>
						@endif 
						</p>
						
						
					</div>
		<!-- div for product specifications-->
					@if($product->specification != null)
						@php 				 
							$total_data=count($product->specification);  
						@endphp
						 
						@if( $total_data>0 && ($product->specification[0]!=null||$product->specification[1]!=null))
						<div class="col-12  p-0 m-0    pt-4 pb-2  " >
							<h3       >Product Specification </h3>
							<table class="table table-bordered   "   >
								
								<tbody>
								
									@for($i=0;$total_data>$i;$i=$i+2)
										<tr>
											<th class=" w-50   border border-3" >{{$product->specification[$i]}}</th>
											<td class="w-50    border border-3" >{{$product->specification[$i+1]}}</td>
										</tr>
									@endfor
								
								</tbody>
							</table>
						</div>
						@endif
					@endif
					
					
					
		<!-- div for  product description-->
					@if(!empty($product->description) || $product->description!=""  || $product->description!=" ")
					<div class="col-12  p-0 m-0    pt-2 pb-4 " >
						<h3   >Product Descriprtion </h3>
						<div class="px-2 py-3   "      >
							{!! $product->description !!}
						</div>
					</div>
					@endif
					
					
					
		<!-- Project video on youtube--> 
					<div class="col-12  p-0 m-0     pt-2 pb-4 "  >
						 <h3 class="pb-3"     >Product Video </h3>
						  
						{!! $product->video_url !!}
						<!--<iframe      class="product_video" src="{{$product->video_url}}	" title="Product Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
				 
					</div>		
					
		<!-- div for get rating from user for the product-->
					<div class="col-12  p-0 m-0  py-2  	" > 
						 @if($rating_list->count()>0)
							<h3      >Customer Review</h3> 
							<div class="customer_rating_container">
							
								@foreach($rating_list as $rating_review)
								
									 
										
										<div class="review_container"   >
													 
											<div class="d-flex">
												 
												<div>
													<img 
													src="{{$rating_review->user->customers->profile_image}} "  
													class="review_user_profile"   alt="user profile image" 
													onerror="this.onerror=null;this.src='{{ asset('images/profile_icon.png') }}';">
												 
												</div>
												<div>
													<h5 class=" m-0 p-0 ps-3 pe-2">{{$rating_review->user->customers->name}}</h5>
													<div class=" m-0 p-0 ps-3 pe-2">
														@for($i=1;5>=$i; $i++)
															
															@if($rating_review->rating >= $i)
																<i class="bi bi-star-fill" style="color:rgba(255,200,0,1);"  ></i>
															@else
																<i class="bi bi-star"   ></i>
															@endif
														@endfor
													</div>
												</div>
											</div>
											<p class="m-0 p-0"  >{{$rating_review->review}}</p>
										</div>
									 
									
								@endforeach
								
							</div>
						@endif
						<div>
							@auth
								@if(auth()->user()->reviews->where('product_id',$product->id)->count() == 0)
									<h3    >Add Your Rating </h3>
									<form action="{{route('productRating')}}" method="post" class="px-2" onsubmit="onSubmitLoader('uploading')"    >
										@csrf
										<input type="hidden" name="rating" id="rating_input_id" value="0" class="rating_star_input"   >
										<input type="hidden" name="product_id"  value="{{$product->id}}"   hidden>
										<label onclick="change_rating_star_image(this.id)" class="rating_star_input_label"   id="rating_star_input_label_1">
											<i class="bi bi-star " id="rating_star_1"></i>
										</label>
										 
										<label onclick="change_rating_star_image(this.id)" class="rating_star_input_label"  id="rating_star_input_label_2">
											 <i class="bi bi-star " id="rating_star_2"></i>
										</label>
										 
										<label onclick="change_rating_star_image(this.id)" class="rating_star_input_label"  id="rating_star_input_label_3">
											<i class="bi bi-star " id="rating_star_3"></i>
										</label>
										 
										<label  onclick="change_rating_star_image(this.id)" class="rating_star_input_label"  id="rating_star_input_label_4">
											 <i class="bi bi-star " id="rating_star_4"></i>
										</label>
										 
										<label onclick="change_rating_star_image(this.id)" class="rating_star_input_label"   id="rating_star_input_label_5">
											 <i class="bi bi-star " id="rating_star_5"></i>
										</label>
										
										<div class="py-2">
											<label class="form-label fw-bold">Review</label>
											<textarea class="form-control login_input" name="review">{{old("review")}}</textarea>
										</div>
										<button type="submit" class="  btn submit_btn  fw-bold my-2">Submit</button>
									</form>
								@endif
							@endauth
						</div>
					</div>
				</div>
				
				
			</section>
			
			<!-- section for similar products  -->
			<section class="container-fluid py-3 bg-white overflow-hidden ">
				<div class="d-md-flex justify-content-between">
					<h3 class="productdetail_product_main_heading"   >Similar Products</h3>
					 
				</div>
				<div class="row w-100 mx-auto py-5  ">
					@foreach($sameProducts as $sameProduct)
							@include('customer/product_card', ['product' => $sameProduct])
					@endforeach
				</div>
				
			</section>
			 
			
		</main>
		
		@include('customer/footer')
		<script src="{{asset('vender/bootstrap/js/bootstrap.bundle.min.js')}}"></script> 
		<script src="{{asset('vender/js/customer/navigation.js')}}"></script>
		<script src="{{asset('vender/js/customer/rating.js')}}"></script>
		<script src="{{asset('vender/js/admin/formSubmit.js')}}"></script> 
		<script src="{{asset('vender/js/preloader.js')}}"></script> 
	 </body>
</html>