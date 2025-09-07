//function foe set quantity of product for add cart or buy
function setQuantity()
{
	var val=document.getElementById("detail_select_quantity_id").value;
	 
	document.getElementById("quantity_cart").value=val; 
}



//submit Form
function formSubmit(id)
{
	document.getElementById(id).submit();
}

 /*
//function for slide vertical  for category in home page of user
var category_slide=document.getElementById("home_category_container_id"); 
if(category_slide!==null)
{
function category_scrole_auto()
{
	
	var ele=category_slide.firstElementChild;
	category_slide.appendChild(ele);
} 
setInterval(category_scrole_auto,2000);
}
  */
  
//function for rating
function change_rating_star_image(id)
{
	if(id=="rating_star_input_label_1")
	{
		if(document.getElementById("rating_star_1").classList.contains("bi-star"))
		{
			document.getElementById("rating_star_1").classList.remove('bi-star');
			document.getElementById("rating_star_1").classList.add('bi-star-fill');
			document.getElementById("rating_star_1").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_input_id").value=1;
		}
		else
		{
			document.getElementById("rating_input_id").value=0;
			document.getElementById("rating_star_1").classList.remove('bi-star-fill');
			document.getElementById("rating_star_1").classList.add('bi-star');
			document.getElementById("rating_star_1").style.color="rgba(0,0,0,1)";
			document.getElementById("rating_star_2").classList.remove('bi-star-fill');
			document.getElementById("rating_star_2").classList.add('bi-star');
			document.getElementById("rating_star_2").style.color="rgba(0,0,0,1)";
			document.getElementById("rating_star_3").classList.remove('bi-star-fill');
			document.getElementById("rating_star_3").classList.add('bi-star');
			document.getElementById("rating_star_3").style.color="rgba(0,0,0,1)";
			document.getElementById("rating_star_4").classList.remove('bi-star-fill');
			document.getElementById("rating_star_4").classList.add('bi-star');
			document.getElementById("rating_star_4").style.color="rgba(0,0,0,1)";
			document.getElementById("rating_star_5").classList.remove('bi-star-fill');
			document.getElementById("rating_star_5").classList.add('bi-star');
			document.getElementById("rating_star_5").style.color="rgba(0,0,0,1)";
		}
	}
	else if(id=="rating_star_input_label_2")
	{
		if(document.getElementById("rating_star_2").classList.contains("bi-star"))
		{
			document.getElementById("rating_star_1").classList.remove('bi-star');
			document.getElementById("rating_star_1").classList.add('bi-star-fill');
			document.getElementById("rating_star_1").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_star_2").classList.remove('bi-star');
			document.getElementById("rating_star_2").classList.add('bi-star-fill');
			document.getElementById("rating_star_2").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_input_id").value=2;
		}
		else
		{
			document.getElementById("rating_input_id").value=1;
			document.getElementById("rating_star_2").classList.remove('bi-star-fill');
			document.getElementById("rating_star_2").classList.add('bi-star');
			document.getElementById("rating_star_2").style.color="rgba(0,0,0,1)";
			document.getElementById("rating_star_3").classList.remove('bi-star-fill');
			document.getElementById("rating_star_3").classList.add('bi-star');
			document.getElementById("rating_star_3").style.color="rgba(0,0,0,1)";
			document.getElementById("rating_star_4").classList.remove('bi-star-fill');
			document.getElementById("rating_star_4").classList.add('bi-star');
			document.getElementById("rating_star_4").style.color="rgba(0,0,0,1)";
			document.getElementById("rating_star_5").classList.remove('bi-star-fill');
			document.getElementById("rating_star_5").classList.add('bi-star');
			document.getElementById("rating_star_5").style.color="rgba(0,0,0,1)";
		}
	}
	else if(id=="rating_star_input_label_3")
	{
		if(document.getElementById("rating_star_3").classList.contains("bi-star"))
		{
			document.getElementById("rating_star_1").classList.remove('bi-star');
			document.getElementById("rating_star_1").classList.add('bi-star-fill');
			document.getElementById("rating_star_1").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_star_2").classList.remove('bi-star');
			document.getElementById("rating_star_2").classList.add('bi-star-fill');
			document.getElementById("rating_star_2").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_star_3").classList.remove('bi-star');
			document.getElementById("rating_star_3").classList.add('bi-star-fill');
			document.getElementById("rating_star_3").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_input_id").value=3;
		}
		else
		{
			 document.getElementById("rating_input_id").value=2;
			document.getElementById("rating_star_3").classList.remove('bi-star-fill');
			document.getElementById("rating_star_3").classList.add('bi-star');
			document.getElementById("rating_star_3").style.color="rgba(0,0,0,1)";
			document.getElementById("rating_star_4").classList.remove('bi-star-fill');
			document.getElementById("rating_star_4").classList.add('bi-star');
			document.getElementById("rating_star_4").style.color="rgba(0,0,0,1)";
			document.getElementById("rating_star_5").classList.remove('bi-star-fill');
			document.getElementById("rating_star_5").classList.add('bi-star');
			document.getElementById("rating_star_5").style.color="rgba(0,0,0,1)";
		}
	
	}
	else if(id=="rating_star_input_label_4")
	{
		if(document.getElementById("rating_star_4").classList.contains("bi-star"))
		{
			document.getElementById("rating_star_1").classList.remove('bi-star');
			document.getElementById("rating_star_1").classList.add('bi-star-fill');
			document.getElementById("rating_star_1").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_star_2").classList.remove('bi-star');
			document.getElementById("rating_star_2").classList.add('bi-star-fill');
			document.getElementById("rating_star_2").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_star_3").classList.remove('bi-star');
			document.getElementById("rating_star_3").classList.add('bi-star-fill');
			document.getElementById("rating_star_3").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_star_4").classList.remove('bi-star');
			document.getElementById("rating_star_4").classList.add('bi-star-fill');
			document.getElementById("rating_star_4").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_input_id").value=4;
		}
		else
		{
			 document.getElementById("rating_input_id").value=3;
			document.getElementById("rating_star_4").classList.remove('bi-star-fill');
			document.getElementById("rating_star_4").classList.add('bi-star');
			document.getElementById("rating_star_4").style.color="rgba(0,0,0,1)";
			document.getElementById("rating_star_5").classList.remove('bi-star-fill');
			document.getElementById("rating_star_5").classList.add('bi-star');
			document.getElementById("rating_star_5").style.color="rgba(0,0,0,1)";
		}
	}
	else
	{
		if(document.getElementById("rating_star_5").classList.contains("bi-star"))
		{
			document.getElementById("rating_star_1").classList.remove('bi-star');
			document.getElementById("rating_star_1").classList.add('bi-star-fill');
			document.getElementById("rating_star_1").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_star_2").classList.remove('bi-star');
			document.getElementById("rating_star_2").classList.add('bi-star-fill');
			document.getElementById("rating_star_2").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_star_3").classList.remove('bi-star');
			document.getElementById("rating_star_3").classList.add('bi-star-fill');
			document.getElementById("rating_star_3").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_star_4").classList.remove('bi-star');
			document.getElementById("rating_star_4").classList.add('bi-star-fill');
			document.getElementById("rating_star_4").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_star_5").classList.remove('bi-star');
			document.getElementById("rating_star_5").classList.add('bi-star-fill');
			document.getElementById("rating_star_5").style.color="rgba(255,200,0,1)";
			document.getElementById("rating_input_id").value=5;
		}
		else
		{ 
			document.getElementById("rating_input_id").value=4;
			document.getElementById("rating_star_5").classList.remove('bi-star-fill');
			document.getElementById("rating_star_5").classList.add('bi-star');
			document.getElementById("rating_star_5").style.color="rgba(0,0,0,1)";
		}
	}
}


//function for slide vertical scroll bar
var slide=document.getElementById("sub_slide_indicator_id");
function scrole_end()
{
	 
	slide.scrollLeft  +=50;
	 
}
function scrole_start()
{
	slide.scrollLeft  -=50;
}


//function for change  navbar on scroll
var preScrollpos=window.pageYOffset;
var userHeader=document.getElementById("user_navigation_container");
function navonscroll()
{
	var currentScrollpos=window.pageYOffset;	
	if(preScrollpos>currentScrollpos)
	{
		userHeader.style.top="0px";
		 
	}
	else
	{
		userHeader.style.top="-100px";
		 
	}
	/*if(currentScrollpos>100)
	{
		 
		userHeader.style.position="fixed";
		userHeader.style.left="50%";
		userHeader.style.transform="translateX(-50%)";
		 
		 
	}
	else
	{
		userHeader.style.position="static"; 
		userHeader.style.margin="auto"; 
		userHeader.style.transform="translateX(0%)";
		 
	}
	*/
	preScrollpos=currentScrollpos;
}
window.addEventListener('scroll',navonscroll);
 
// view password in login page
function view_password()
{ 
	var view_password=document.getElementById("password");
	var view_password_icon=document.getElementById("view_password_icon");
	if(view_password.type=="password")
	{
		view_password.type="text";
		view_password_icon.classList.remove('bi-eye');
		view_password_icon.classList.add('bi-eye-slash');
	}
	else
	{
		view_password.type="password";
		view_password_icon.classList.remove('bi-eye-slash');
		view_password_icon.classList.add('bi-eye');
	}
}

 // show update profile detail
 function show_update_profile_detail()
 {
	document.getElementById("update_profile_detail").style.visibility="visible";
 }
 // hide update profile detail
 function hide_update_profile_detail()
 {
	document.getElementById("update_profile_detail").style.visibility="hidden";
 }
 // show chage profile image
 function show_change_profile_image()
 { 
	document.getElementById("change_profile_image").style.visibility="visible";
 }
 // hide chage profile image
 function hide_change_profile_image()
 {
	document.getElementById("change_profile_image").style.visibility="hidden";
 }
 
 
 // show chage user password
 function show_change_password()
 { 
	document.getElementById("update_user_password").style.visibility="visible";
 }
 // hide chage user password
 function hide_change_password()
 {
	document.getElementById("update_user_password").style.visibility="hidden";
 }
  
  
  //INITIALIZE AOS
  
  AOS.init();