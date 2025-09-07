
	var arr_text=['Power Tools And Accessories.', 'Get The Best Collection Of Hand Tools.', 'All Type Of Tools And Kits Available.', 'Multifunction Cordless Tools.']
	 
 
	
	function setRandValue()
	{
		head_txtt=arr_text[(Math.floor(Math.random()*arr_text.length))];
		document.getElementById("head_type_text").innerHTML=head_txtt;
		//document.getElementById("head_type_text2").innerHTML=head_txtt;
		
		 
	}
	window.addEventListener('load',setRandValue);