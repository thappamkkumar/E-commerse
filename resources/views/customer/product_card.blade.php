<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3  mb-4 " >
	<div class="product_card rounded"  >
		<div class="w-100 h-auto" style="overflow:hidden;" onclick='window.location.href =  `{{route("productDetail",["productCode"=>$product])}}`;'>
			<img src="{{  $product->thumnail }} " alt="{{$product->name}} image"  class="product_card_image" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/imageError.jpg') }}';">
		</div> 
		<div class="  product_card_body p-2" > 
			<h5  class=" product_card_heading m-0     py-2  "     onclick='window.location.href =`{{route("productDetail",["productCode"=>$product])}}`;'    > {{ Str::limit($product->name, 100, '...') }}</h5>
			@if($product->sale_price>0 && $product->price > $product->sale_price)
			<p class="product_card_price m-0 pt-1            " >
				<del class=" text-muted "> Rs.  {{$product->price}} </del> 
				<span class="product_card_sale_price m-0   ps-2        fw-bold " > Rs.  {{$product->sale_price}} </span>
			</p>
			
			@else
			<p class="product_card_price m-0 pt-1         fw-bold  " >  Rs.  {{$product->price}}  </p> 
			@endif
		</div>
		
		@if ($product->sale_price>0 && $product->price > $product->sale_price )
			<span class="  text-dark p-2 fw-bold product_discount "   >
			 
					 {{ number_format((($product->price - $product->sale_price) / $product->price) * 100, 0) }}% OFF
			
			</span>
		@endif
		@if($product->stock>0)  
			@auth
				<div class="  px-2 pb-3 pt-3 d-flex flex-row-reverse gap-2  ">
			
					@if(auth()->user()->carts->where('product_id',$product->id)->count() == 0)
						<a href="{{route('addToCart',['productData'=>$product])}}" class="btn btn-dark    fs-5 py-1 lh-2    h-auto fw-bold" title="Add to cart."><i class="bi bi-cart "></i></a>
					@else	
						<a href="{{route('userCartList')}}" class="btn  btn-dark  fs-5 py-1 lh-2   h-auto fw-bold" title="View carts." ><i class="bi bi-cart-check-fill "></i></a>	 
					@endif
						<a href="{{route('orderVerfication',['product'=>$product])}}" class="btn add_to_cat_btn    w-100 h-auto fw-bold	  flex-srink-3  " title="Buy now">BUY NOW</a>
				</div>		
			@endauth
		
		 
		@else 
			<p class="px-2 m-0  pb-2 text-danger ">  Out Of Stock	</p>
		@endif 
	</div>
</div>