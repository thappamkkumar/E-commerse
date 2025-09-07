@extends('customer/layout')
@section('categoriesList')
		
<main class="home_container pb-5">

 
	<section class="w-100   py-5"  >
		@if($categories->total() > 0)
		 
			<h5 class="text-center py-4" data-aos="zoom-in"    data-aos-duration="1000" >
				@if($categories->total() == 1)
							Only one category is  available....
						@else
							Total {{$categories->total()}}  categories are available....
						@endif
			</h5>
		 
		@else
			<h5 class="text-center py-4" data-aos="zoom-in"    data-aos-duration="1000" >Categories are  not available</h5> 
		@endif
		
		
		<div class="    mx-auto "  id="category_cont_id" data-aos="zoom-in"  data-aos-duration="1000" >
			@foreach($categories as $category)
			<a href="{{route('categoryProductForUser',['category'=>$category])}}" class="btn  d-block w-100 text-start category"    >{{$category->name}}<span class="category_arrow"><i class="bi bi-arrow-right  ps-2"></i></span></a>
			@endforeach
			 
		</div>
 
	</section>
	@if($categories->total() > 50)
		<div class="w-100 py-4 " data-aos="fade-up"    >
		
			<ul class="pagination  justify-content-center">
				@if($categories->onFirstPage())
					<li class="page-item"><span class="btn   border border-2 me-1 ">Prev</span></li>
				@else 
					<li class="page-item"><a href="{{$categories->previousPageUrl()}}"   class="   btn  btn-light border border-2 me-1">Prev</a></li>
				@endif
				@if($categories->hasMorePages())
					<li class="page-item"><a href="{{$categories->nextPageUrl()}}"  class=" btn  btn-light border border-2 ms-1">Next</a></li>
				 @else
					 <li class="page-item"><span class="   btn border border-2 ms-1">Next</span></li> 
				@endif
			</ul>
		</div>
	@endif
	 
	 <script>
		const element1 = document.getElementById("navigation_link_categories"); 
		const element2 = document.getElementById("navigation_link_categories1"); 
		element1.classList.add("active_navigation_link");
		element2.classList.add("active_navigation_link");
	</script>
</main>

@endsection