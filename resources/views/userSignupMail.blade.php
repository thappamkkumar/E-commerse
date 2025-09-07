<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shivam Electro Tools</title>

        <style>
			body
			{
				 
				padding:0px ;
				margin:0px; 
				background-color:rgba(240,240,240,1);
				font-size:18px;
			}

			 
			*
			{
				box-sizing:border-box;
				padding:0px ;
				margin:0px;
			}
			header
			{
				width:100%;
				height:auto;
				position:sticky;
				top:0px;
				padding:10px 10px 10px 10px;
				background:rgba(255,255,255,1);
				box-shadow:0px 5px 5px -3px rgba(0,0,0,0.5);
			}
			 
			.header_logo
			{
				width:200px;
				height:60px;
				display:block;
				margin:auto;
				
			}
			main
			{
				width:100%;
				height:auto;
				padding:0px 0px 0px 0px;
				background:rgba(255,255,255,1);
				color:rgba(0,0,0,1);
			}
			
			section
			{
				width:100%;
				height:auto;
				text-align:center;
				padding:20px 10px 20px 10px;;
			}
			.section_h1
			{
				padding:10px 0px 10px 0px; 
			}
			.section_h3
			{
				padding:10px 0px 30px 0px; 
				color:rgba(0,0,0,0.7);
			}
			.btn
			{
				width:auto;
				height:auto;
				padding:8px 25px 8px 25px;
				background:rgba(25,150,230,1);
				color:#fff;
				text-decoration:none;
				font-size:1.2rem;
				font-weight:bold;
				letter-spacing:1px;
				border-radius:5px;
			}
			.btn:hover
			{
				background:rgba(25,100,150,1);
			}
			footer
			{
				width:100%;
				height:auto;
				padding:20px 10px 20px 10px;
				background:rgba(255,255,255,1);
			}
			.footer_h2
			{
				text-align:center;
				
			}
			.footer_h2_sub
			{
				border-bottom:2px solid #000;
				padding:0px 20px 5px 20px;
			}
			.footer_social_media_container
			{
				width:auto;
				height:auto;
				 
				padding:20px 0px 20px 0px; 
				text-align:center;
			}
			.footer_social_media_link
			{
				text-decoration:none;
				
				 
			}
			.footer_social_media
			{
				width:40px;
				height:40px;
				margin:10px 5px 10px 5px;
				 
				
			}
			.footer_social_media:hover
			{
				transform:scale(0.8,0.8);
			}
			
			@media only screen and (min-width:768px) and (max-width:992px)
			{
				 
				header, main, footer
				{
					width:90%;
					margin:auto;
				}
			}
			@media only screen and (min-width:992px) and (max-width:1200px)
			{
				header, main, footer
				{
					width:80%;
					margin:auto;
				}
			}
			@media only screen and (min-width:1200px) and (max-width:1600px)
			{
				header, main, footer
				{
					width:70%;
					margin:auto;
				}
			}
			@media only screen and (min-width:1600px) and (max-width:2400px)
			{
				header, main, footer
				{
					width:1600px;
					margin:auto;
				}
			}
			@media only screen and (min-width:2400px)
			{
				
				header, main, footer
				{
					width:1600px;
					margin:auto;
				}
			}
        </style>
		 
    </head>
    <body >  
		 <header>
			 <img src="{{$message->embed(URL('logo/nav_logo.png'))}}" class="header_logo" alt="shivam electro tools">
		</header> 
		<main>
			<section >
				<h1 class="section_h1" >Welcome to Shivam Electro Tools</h1>
				<h3 class="section_h3" >Your Account is created successfully. You can login now.</h3>
				<a href="{{route('user_login')}}" class="btn" style="color:#fff;" >Login</a>
			</section> 
		</main>
		<footer>
			<h2 class="footer_h2"><span class="footer_h2_sub">Get In Touch</span></h2>
			<div class="footer_social_media_container">
				
				<a href=""  class="footer_social_media_link" ><img src="{{$message->embed(URL('images/instagram.png'))}}" class="footer_social_media  "  alt="instagram"> </a>
				<a href=""   class="footer_social_media_link"   ><img src="{{$message->embed(URL('images/facebook.png'))}}" class="footer_social_media  "  alt="facebook"> </a>
				<a href=""   class="footer_social_media_link"   ><img src="{{$message->embed(URL('images/whatsapp.png'))}}"  class="footer_social_media  "  alt="whatsapp"> </a>
				<a href=""   class="footer_social_media_link"   ><img src="{{$message->embed(URL('images/youtube.png'))}}" class="footer_social_media  "   alt="youtube"> </a>
			</div>
		</footer>
		 
	 </body>
</html>