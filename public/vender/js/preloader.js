
//pre loader
/*document.onreadystatechange=function(){
	
	if(document.readyState !== "complete")
	{	 
		 
		document.getElementById("preLoader").style.display="flex"; 
	}
	else
	{ 
		document.getElementById("preLoader").style.display="none";
	}
};*/
window.onload = function() {
    // Hide the loading overlay once the page is fully loaded 
    document.getElementById('preLoader').style.display = 'none';
     
};