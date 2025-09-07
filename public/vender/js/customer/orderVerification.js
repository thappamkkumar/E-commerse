//function for decrease Quantit
function decreaseQuantity()
{
	let quantity = new Number(document.getElementById('quantity').value);
	if(quantity > 1)
	{
		quantity = quantity-1;
		document.getElementById('quantity').value = quantity;
		document.getElementById('quantity_display').innerHTML = quantity;
	}
	 
	totalPrice(quantity);
}
//function for increase Quantit
function increaseQuantity(stock)
{ 
	let quantity = new Number(document.getElementById('quantity').value);
	if(quantity < stock)
	{ 
		quantity = quantity + 1;
		document.getElementById('quantity').value = quantity;
		document.getElementById('quantity_display').innerHTML = quantity;
	}
	 
	totalPrice(quantity);
}
//function for calculate total
function totalPrice(quantity)
{ 
	let price = new Number(document.getElementById('price').value);
	let gst = new Number(document.getElementById('gst').value);
	let delivery_charges = new Number(document.getElementById('delivery_charges').value); 
	document.getElementById('totalPrice').innerHTML = (price + gst + delivery_charges) * quantity ;
	 
}



//function for change address
function changeAddress()
{
	let country = document.getElementById('country_id').value
	let state = document.getElementById('state_id').value
	let district = document.getElementById('district_id').value
	let pincode = document.getElementById('pincode_id').value
	let area_street_sector_village = document.getElementById('area_street_sector_village_id').value
	let flat_houseno_building_company = document.getElementById('flat_houseno_building_company_id').value
	let landmark = document.getElementById('landmark_id').value 
	
	document.getElementById('fullAddressDiaplay').innerHTML = flat_houseno_building_company + ", " + area_street_sector_village +", " + district + ", " + state + ", " + country + ", " + pincode;

	document.getElementById('country').value = country;
	document.getElementById('state').value = state;
	document.getElementById('district').value = district;
	document.getElementById('pincode').value = pincode;
	document.getElementById('area_street_sector_village').value = area_street_sector_village;
	document.getElementById('flat_houseno_building_company').value = flat_houseno_building_company;
	document.getElementById('landmark').value = landmark;
}