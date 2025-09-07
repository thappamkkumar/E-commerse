
//submit Form
function formSubmit(id)
{
	document.getElementById(id).submit();
}

//function for add specification fields
function add_specification_field()
{ 
	var current_field=Number(document.getElementById("total_spacification").value);  
	const specification=document.getElementById("specification_container");
	 
	current_field=current_field + 1;
		 //for add specification heading
		const div=document.createElement('div');
		
		const label=document.createElement('label');
		label.setAttribute("class","form-label fw-bold");
		const label_text=document.createTextNode("Specification Name");
		label.appendChild(label_text);
		const input=document.createElement('input');
		input.setAttribute("class","form-control");
		input.setAttribute("type","text");
		input.setAttribute("name","specification_heading_"+current_field);
		input.setAttribute("autocomplete","off");
		
		div.appendChild(label);
		div.appendChild(input);
		
		div.setAttribute("class","col-12 col-md-6 py-3");
		specification.appendChild(div);
		
		//for add specification detail
		const div2=document.createElement('div');
		const label2=document.createElement('label');
		label2.setAttribute("class","form-label fw-bold");
		const label_text2=document.createTextNode("Specification Detail");
		label2.appendChild(label_text2);
		const input2=document.createElement('input');
		input2.setAttribute("class","form-control");
		input2.setAttribute("type","text");
		input2.setAttribute("name","specification_detail_"+current_field);
		input2.setAttribute("autocomplete","off");
		
		div2.appendChild(label2);
		div2.appendChild(input2);
		
		div2.setAttribute("class","col-12 col-md-6 py-3");
		specification.appendChild(div2);
			 
		 
	document.getElementById("total_spacification").value=current_field;
	 
}


// function for show navbar on button click for screen size <= 992px


function show_navbar()
{
	document.getElementById("admin_side_navbar").style.display='block';
	document.getElementById("hide_navbar_id").style.display='block';
	document.getElementById("show_navbar_id").style.display='none';
}
// function for hide navbar on button click for screen size <= 992px
 function hide_navbar()
{
	document.getElementById("admin_side_navbar").style.display='none';
	document.getElementById("hide_navbar_id").style.display='none';
	document.getElementById("show_navbar_id").style.display='block';
}
//resize event with funtion customizing side navbar and buttons like show nav or hide nav 
window.addEventListener('resize', ()=>{
	 if(window.innerWidth>992)
	 {
		document.getElementById("admin_side_navbar").style.display='block';
		document.getElementById("hide_navbar_id").style.display='none';
		document.getElementById("show_navbar_id").style.display='none';
	 }
	 else
	 {
		 document.getElementById("admin_side_navbar").style.display='none';
		 document.getElementById("hide_navbar_id").style.display='none';
		document.getElementById("show_navbar_id").style.display='block';
	 }
});



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
  