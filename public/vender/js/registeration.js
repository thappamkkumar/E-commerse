
var timeout = null;
var otp =""; 


 

//Submit  registeration form
document.getElementById("registrarionForm").addEventListener("submit", function(event) {
     event.preventDefault(); // Prevent form submission
	let msg = document.getElementById("registrationMSG_Container");
	
    let form = event.target;
    let formData = new FormData(form); 
	form.name_id.value = form.name_id.value.trim();
	form.password_id.value = form.password_id.value.trim();
	if(form.name_id.value.length <= 0)
	{
		msg.style.display="block";  
		msg.innerHTML="Name must be filled.";
		return false;
	}
	if(form.password_id.value.length <= 0)
	{
		msg.style.display="block";  
		msg.innerHTML="Password must be filled.";
		return false;
	}
	if(form.otp_id.value == otp)
	{
		// AJAX request to save transaction
		let xhr = new XMLHttpRequest();
		xhr.open("POST", form.action, true);
		xhr.onload = function () {
			if (xhr.status === 200) {
				 form.reset(); 
				 clearTimeout(timeout);
				var response = JSON.parse(xhr.responseText);
				if (response.status == 'true') {
					// Redirect to the specified URL
					window.scrollTo({
						top: 0,
						behavior: 'smooth' // You can use 'auto' or 'smooth' for smooth scrolling
					});
					msg.style.display="block";  
					msg.innerHTML="Account is created successfully.";
					setTimeout(()=>{
						
						window.location.href = destinationUrl;
					}, 1000*2);
					
				} else {
					msg.style.display="block";  
					msg.innerHTML="Enable to register.";
				}
				 
			} else {
				msg.style.display="block";  
				msg.innerHTML="Enable to register.";
			}
		};
		xhr.onerror = function () {
			msg.style.display="block";  
			msg.innerHTML="Enable to register.";
		};
		xhr.send(formData); 
	}
	else
	{
		msg.style.display="block";  
		msg.innerHTML="Entered OTP is Wrong.";
		return false;
	}
	msg.innerHTML="";
	msg.style.display="none"; 
     
		 
});






//Function for otp verification 
function otpVerification(id)
{
	let enteredOTP = document.getElementById(id).value;
	let cont = document.getElementById(id).value;
	let msg = document.getElementById("registrationMSG_Container");
	if(enteredOTP != otp)
	{
		msg.style.display="block";  
		msg.innerHTML="Entered OTP is Wrong.";
		window.scrollTo({
				top: 0,
				behavior: 'smooth' // You can use 'auto' or 'smooth' for smooth scrolling
			});
		return false;
	}
	msg.innerHTML="";
	msg.style.display="none"; 
}

//Function for generate and send otp.

function sendOTP(email)
{
	let digits = '0123456789';
	let otp_custom="";
    for (let i = 0; i < 6; i++) {
        otp_custom += digits[Math.floor(Math.random() * 10)];
    }
	otp = otp_custom;
	let userData = {};
	 
	document.getElementById('otpValidMSG').style.display="block";
	document.getElementById('resendBTN').style.display="none";
	userData = {mobile:document.getElementById('contact_id').value, emailAddress:document.getElementById(email).value, otpVal:otp};
	 
	 timeout = setTimeout(()=>{
		otp = "";otp_custom = ""; 
		if(email == "email_id")
		{
			document.getElementById('otpValidMSG').style.display="none";
			document.getElementById('resendBTN').style.display="block";
		}
		else
		{
			document.getElementById('otpValidMSG2').style.display="none";
			document.getElementById('resendBTN2').style.display="block";
		}
		
	}, 1000*60*5);
	try
	{
		fetch(window.location.origin + '/api/sendOTP', {
			method: 'POST',
			body: JSON.stringify(userData),
			headers: {
				'Content-Type': 'application/json'
			}
		})
		.then(response => response.json())
		.then(response => {
			if(response.status == 'true')
			{ 
				
				return;
			}
			else
			{  
				window.scrollTo({
							top: 0,
							behavior: 'smooth' // You can use 'auto' or 'smooth' for smooth scrolling
						});
				document.getElementById("registrationMSG_Container").style.display="block";  
				document.getElementById("registrationMSG_Container").innerHTML=response.message;; 
				 
			}
		});
	}
	catch(error)
	{
		console.log(error);
		 
	}
	return;
}









/*this function is use to validate entered moblie number  */
function contactVerification(id, email_ID)
{
	let cont = document.getElementById(id).value;
	let msg = document.getElementById("registrationMSG_Container");
	if(!/\D/.test(cont) == false)
	{
		msg.style.display="block";  
		msg.innerHTML="Moblie Number only contain Digits.";
		document.getElementById(email_ID).readOnly=true;
		return false;
	}
	if(cont.length != 10)
	{
		
		msg.style.display="block";  
		msg.innerHTML="Moblie number must be 10 digit";
		document.getElementById(email_ID).readOnly=true;
		return false;
	}
	msg.innerHTML="";
	msg.style.display="none";   
	document.getElementById(email_ID).readOnly=false;
}









/*this function is use to validate entered email  */
function emailVerification(id)
{
	var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

	let cont = document.getElementById(id).value;
	let msg = document.getElementById("registrationMSG_Container"); 
	 

	if (cont.match(validRegex)) 
	{  
		readonlyRemove(["name_id","password_id",]); 
		document.getElementById("otpContainer").style.display="block"; 
		 
		sendOTP(id);
		
	}
	else
	{
		msg.style.display="block";  
		msg.innerHTML="Entered Email is not valid.";
		return;
	}
	msg.innerHTML="";
	msg.style.display="none";  
	 
}









//Functio for vassword verification
function passwordVerification(id)
{	
	let cont = document.getElementById(id).value;
	let msg = document.getElementById("registrationMSG_Container");
	if(cont.length < 8)
	{
		window.scrollTo({
				top: 0,
				behavior: 'smooth' // You can use 'auto' or 'smooth' for smooth scrolling
			});
		msg.style.display="block";  
		msg.innerHTML="Password must have minimum 8 characters .";
		return false;
	}
	if(/[A-Z]/.test(cont) && /[a-z]/.test(cont) && /\d/.test(cont) && /[^A-Za-z0-9]/.test(cont))
	{ 
	}
	else
	{
		window.scrollTo({
				top: 0,
				behavior: 'smooth' // You can use 'auto' or 'smooth' for smooth scrolling
			});
		msg.style.display="block";  
		msg.innerHTML="Password must contain atleast one uppercase character, lowercase character, digit, and special character. eg., StR0/%nG;";
		return false;
	}
	msg.innerHTML="";
	msg.style.display="none"; 
}








/*this function is use to change contact input readonly false  */
/*function roleSelected()
{ 
	readonlyRemove(["contact_id"]);
}*/


//Function to apply readonly of textfield
function readonlyApply(arr)
{
	arr.map((a)=>{
		 document.getElementById(a).readOnly=true;
	});
}
function readonlyRemove(arr)
{
	arr.map((a)=>{
		 document.getElementById(a).readOnly=false;
	});
}
	 

window.addEventListener("load", function(event) {
	readonlyApply([ "email_id", "name_id","password_id"]);
});