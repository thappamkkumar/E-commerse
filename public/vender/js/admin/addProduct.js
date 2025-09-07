 
 
 //function for add specification
    function addSpecificationField() {
        const specificationsDiv = document.getElementById('specification_container');
        const totalSpecsInput = document.getElementById('total_specification');
        let totalSpecs = parseInt(totalSpecsInput.value);

        totalSpecs++;

        const newRow = document.createElement('div');
        newRow.className = 'col-12 py-2';

        const rowContent = `
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4">
                    <input type="text" class="form-control login_input" name="specification_heading_${totalSpecs}" placeholder="Specification Name" autocomplete="off" required> 
                </div>  
                <div class=" col-12 col-sm-6 col-xl-4 py-2 py-sm-0">
                    <input type="text" class="form-control login_input" name="specification_detail_${totalSpecs}" placeholder="Specification Detail" autocomplete="off" required> 
                </div>
            </div>
        `;

        newRow.innerHTML = rowContent;

        specificationsDiv.appendChild(newRow);

        totalSpecsInput.value = totalSpecs;
    }
 
 
 //function for set vedio url get from input
 function setURL(inputID, linkID)
 {
	  // Get the input value
	  var inputUrl = document.getElementById(inputID).value;

	  // Set the href attribute of the 'a' tag
	  var link = document.getElementById(linkID);
	 // link.setAttribute('href', inputUrl);

	  // Set the inner HTML of the 'a' tag
	  link.innerHTML = inputUrl;
 }
 
 
//function for display selection image as thumnail
function showImages() {
    const imageInput = document.getElementById('imageInputID');
    const imageContainer = document.getElementById('image_container');
    const files = imageInput.files;

    if (files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                const imageUrl = reader.result;
                const imgElement = document.getElementById('image' + (i + 1)); // Get existing img element by ID
                imgElement.src = imageUrl; // Set the src attribute of the img element
                imgElement.style.display = 'block'; // Show the image
            });

            reader.readAsDataURL(file);
        }
    }
}

//function for display selection image as thumnail

function showThumnail()
{ 
		
	const imageInput = document.getElementById('thumbnailInputID');
	const imageContainer = document.getElementById('thumnail_container');

	 
	const file = imageInput.files[0];

	if (file)
	{
		const reader = new FileReader();

		reader.addEventListener('load', function() {
		const imageUrl = reader.result;
		const imgElement = document.createElement('img');
		imgElement.src = imageUrl;
		imgElement.setAttribute('class','m-1 profile_image');
		imgElement.setAttribute('data-bs-toggle','modal');
		imgElement.setAttribute('data-bs-target','#productImageModel');
		imgElement.setAttribute('onclick',"showImage(this.src, 'Product Thumnail')");
		// Clear previous image (if any) before appending new one
		imageContainer.innerHTML = '';

		// Append the new image to the container
		imageContainer.appendChild(imgElement);
		});

		reader.readAsDataURL(file);
	}

}



//function for change image in model
function showImage(img, imgType)
{ 
	document.getElementById('productImageModel_ImageID').src = img;
	document.getElementById('productImageLabel').innerHTML = imgType;
}