<div class="  w-100 h-auto d-flex justify-content-center py-3 searchBarContainer">
		<form action="{{route('productSearch')}}" method="post" onsubmit="onSubmitLoader('searching')">
			@csrf
			<div class="input-group-text flex-wrap bg-transparent border-0 p-0"       >
				<input type="search" @if(isset(session('user_search_input')) value=" {{session('user_search_input')}}" @endif  class="form-control home_search_input" name="search_input" autocomplete="off">
				<span class="input-group-text bg-transparent border-0 m-0 p-0"><button type="submit" class="btn border-0  ms-2  home_search_btn"> Search</button></span>
			</div>
		</form>
</div>