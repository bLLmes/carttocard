<?php 
session_start();

?>
<!DOCTYPE>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/mystylee.css">
		<link rel="shortcut icon" href="images/logo/logo2.png">

		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/ul.js"></script>
		<script src="js/date_time123.js"></script>
		
		<title>IDOKZKIE v0.002</title>
		<style>
		.list-group a .list-group-item{text-decoration: none;color:black;}
		.list-group a li:hover{border-left:20px solid #f4511e;background-color: hsl(0, 0%, 66%);text-decoration: none;color:white;} 
		.logo-brand{color:black;border-bottom: 3px solid #f4511e;padding: 10px;display: inline-block;margin-top: 2px;}
		.href-image h2 small{text-decoration: none;font-size: 0.49em;}
		
		.carousel-inner img {width: 100%;margin: auto;}
		.carousel-caption h3 {color: #fff !important;}
		@media (max-width: 600px) {
		    .carousel-caption {
		      display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
		    }
		    .banner-responsive{height: auto !important;} 
		}  
		@media (max-width: 1199px) {
			.image-product{height: auto !important;} 
		}
		.my-profilee{margin:10px;width: 100%;height: auto;border-radius: 0px;border:1px solid hsl(0, 0%, 88%);}
		.well{border-radius: 0px;background-color: hsl(0, 0%, 98%)}
		.profile-li li{padding-left:3px;}
		.profile-li{padding-left:15px;line-height: 18px;}
		</style>
	</head>
	<body>
	<?php
	include 'navbar.php';
	?>
	<script>
		$(document).ready(function(){
			$('#idChatContainer').hide();
			$('#btn-chat').click(function(){
				var convo = $('#btn-input-chat').val(); 
				$.ajax({
				    url: 'sendconvo.php',
				    type: 'post',
				    data: {convo:convo},
				    success: function(data) {
				    	var newVal = "";
				    	$('#btn-input-chat').val(newVal);
				    }
				});
			});
			$('#idChatClose').click(function(){
				$('#idChatContainer').hide();
			});
			$('#idOpenChatBtn').click(function(){
				$('#idChatContainer').toggle();
			});
		});
	</script>

	<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
	    <ol class="carousel-indicators">
	      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	      <li data-target="#myCarousel" data-slide-to="1"></li>
	      <li data-target="#myCarousel" data-slide-to="2"></li>
	    </ol>

	    <!-- Wrapper for slides -->
	    <div class="carousel-inner" role="listbox">
	      <div class="item active">
	        <img src="images/banners/banner1.jpg" alt="Banner1" class="banner-responsive" style="width: 100%;height: 70%;">
	        <div class="carousel-caption">
	          <h3><kbd>IDOKZKIE v0.002</kbd></h3>
	          <p><kbd>The latest online shopping (Ecommerce).</kbd></p>
	        </div>      
	      </div>

	      <div class="item">
	        <img src="images/banners/banner2.jpg" alt="Banner2" class="banner-responsive" style="width: 100%;height: 70%;">
	        <div class="carousel-caption">
	          <h3><kbd>IDOKZKIE v0.002</kbd></h3>
	          <p><kbd>Select our best products and affordable prices.</kbd></p>
	        </div>      
	      </div>
	    
	      <div class="item">
	        <img src="images/banners/banner3.jpg" alt="Banner3" class="banner-responsive" style="width: 100%;height: 70%;">
	        <div class="carousel-caption">
	          <h3><kbd>IDOKZKIE v0.002</kbd></h3>
	          <p><kbd>Up to date with the latest technology.</kbd></p>
	        </div>      
	      </div>
	    </div>

	    <!-- Left and right controls -->
	    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	      <span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	      <span class="sr-only">Next</span>
	    </a>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="border: 1px solid #f4511e;box-shadow: 0 130px 222px 22px rgba(244, 81, 30, 0.2);"></div> 
		</div>
		<div class="row" style="margin-top: 76px;">
			<div class="col-md-3">
				<div class="well">
					<h3 class="text-center">Billy James R. Marte
					<div style="border:1px solid #f4511e;margin: 4px;"></div>
					<small style="text-indent: 15px;">BS - Information Technology</small>
					</h3>
					<br>
					<h4>COMPETENCIES<br><br>
						<div class="well">
							Programming Skills<br><br>
							<small>
							<ul class="profile-li">
								<li> <p>Knowledgeable in PHP / HTML5 / CSS / BOOTSTRAP / JAVASCRIPT / JQuery.</p></li>
								<li> <p>Knowledge in SDLC.</p></li>
								<li> <p>Knowledge in PHP Laravel Framework.</p></li>
								<li> <p>Knowledge in MVC Framework.</p></li>
								<li> <p>Knowledge in SQL</p></li>
								<li> <p>Knowledge in C#</p></li>
								<li> <p>Knowledge in Visual Basic</p></li>
								<li> <p>Knowledge in Java(OOP)</p></li>
								<li> <p>Knowledge in Photoshop, Vegas and Audio Editing</p></li>
							</ul>
							</small>
						</div>
					</h4>
				</div>
			</div>
			<div class="col-md-9">
				<div class="well">
					<h3 class="">IDOKZKIE
					<div style="border:1px solid #f4511e;margin: 0px;"></div>
					<small>Online shopping(E-commerce)</small>
					<br><br>
					<p style="text-indent: 20px;font-size: 0.7em;">Simple but </p>
					<br>
					</h3>
					<h4>Programming Languages<br><br>
						<div class="well">
							Use to build this system.<br><br>
							<small>
							<p>- HTML</p>
							<p>- CSS</p>
							<p>- BOOTSTRAP</p>
							<p>- JAVASCRIPT</p>
							<p>- JQUERY</p>
							<p>- AJAX</p>
							<p>- PHP</p>
							</small>
						</div>
					</h4>
					<h4>Features<br><br>
						<div class="well">
							System<br><br>
							<small>
							<p>- Automatically calculate total amount and number of item selected(Seen at the top in left side of the navbar).</p>
							<p>- User Access Level.</p>
							<p style="color: red;">- Automatically sends notification via sms when ordering (the system requires load).</p>
							</small>
						</div>
						<div class="well">
							Admin<br><br>
							<small>
							<p>- Customer Support (Live Chat with Customer but not totally the same as facebook).</p>
							<p>- Can create with image, edit and update item.</p>
							<p>- Manage Customers Shipping Order and Customers Cart.</p>
							<p>- Can remove item from customer cart without refreshing(1 by 1 item) and also can remove all item.</p>
							<p>- Can cancel customer shipping order.</p>
							<p style="color: red;">- Can sends notification sms when ordering (the system requires load).</p>
							</small>
						</div>
						<div class="well">
							Customer<br><br>
							<small>
							<p>- Admin Support (Live Chat with Admin but not totally the same as facebook).</p>
							<p>- Can create, edit and update own profile.</p>
							<p>- Can remove item from cart without refreshing(1 by 1 item) and also can remove all item.</p>
							<p>- Can cancel shipping order.</p>
							<p>- Can leave a feedback / comment in every item.</p>
							</small>
						</div>
						
					</h4>
				</div>
			</div>
			<!-- <div class="col-md-2">
				<div class="well">
					<h4>Admin
					<small>
						<br><br>
						<label>- Customer Support (Live Chat with Customer)</label>
					</small>
					</h4>
					<br><br><br><br>
					<br><br><br><br>
					<br><br><br><br>
					<br><br><br><br>
				</div>
			</div> -->
		</div>
	</div>
	<br><br>
	<?php
	include 'footer.php'
	?>

	<script>
	var slideIndex = 0;
	showSlides();

	function plusSlides(n) {
	  showSlides(slideIndex += n);
	}

	function currentSlide(n) {
	  showSlides(slideIndex = n);
	} 

	function showSlides() {
	    var i;
	    var slides = document.getElementsByClassName("mySlides");
	    var dots = document.getElementsByClassName("dot");

	    slideIndex++;

	    for (i = 0; i < slides.length; i++) {
	       slides[i].style.display = "none";  
	    }
	    
	    if (slideIndex> slides.length) {slideIndex = 1}    
	    for (i = 0; i < dots.length; i++) {
	        dots[i].className = dots[i].className.replace(" active", "");
	    }
	    slides[slideIndex-1].style.display = "block";  
	    dots[slideIndex-1].className += " active";
	    setTimeout(showSlides, 2000); // Change image every 2 seconds
	}
	</script>
	
	</body>
</html>

