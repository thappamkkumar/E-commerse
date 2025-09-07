
//function for change  navbar on scroll
var preScrollpos=window.pageYOffset;
var userHeader=document.getElementById("user_navigation_container");
function navonscroll()
{
	var currentScrollpos=window.pageYOffset;	
	if(currentScrollpos > 100)
	{ 
		userHeader.style.position="fixed"; 
		userHeader.style.top="0px"; 
		userHeader.style.width="inherit"; //width for screen width greater than 2400px
		userHeader.style.boxShadow="0px 10px 15px -8px rgba(0,0,0,0.5)"; 
	}
	else
	{
		userHeader.style.position="static";  
		userHeader.style.width="100%";//width for screen width greater than 2400px
		userHeader.style.boxShadow="0px 10px 15px -8px rgba(0,0,0,0.0)"; 
	}
	
	preScrollpos=currentScrollpos;
}
window.addEventListener('scroll',navonscroll);
 
