function submitForm(event, id)
{  
	if(id == 'update_deliver_status')
	{
		 document.getElementById(id).submit();
	}
	else{
		var fileInput = event.target;
		if (fileInput.files.length > 0) {
		  document.getElementById(id).submit();
			 onSubmitLoader('updating');
		}  
	}
}

function onSubmitLoader(  text = 'Loading')
{
	document.getElementById('loader').style.display = 'inline-block';
	document.getElementById('pretext').innerHTML = text;
}