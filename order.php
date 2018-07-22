<?php 
session_start();

include 'db.php';

if(isset($_GET['other_product_id'])){
	$get_product_id = $_GET['other_product_id'];
	$item_price_order = 0;
	$query = mysqli_query($sql, "SELECT * FROM products WHERE id = '$get_product_id'");

	$row = mysqli_fetch_array($query);
	$product_id = $row['id'];
	$product_image1 = $row['product_image1'];
	$product_image2 = $row['product_image2'];
	$product_image3 = $row['product_image3'];
	$product_image4 = $row['product_image4'];
	$product_sale_price = $row['product_sale_price']; 
	$product_price = $row['product_price'];
	$orig_product_stock = $row['product_stock'];

	if($product_sale_price != 0){
		$sale = 0;

		$product_sale_price = $product_sale_price / 100;
		$sale = $product_price * $product_sale_price;

		$arr1 = str_split($product_sale_price, 2); 
							
		$str1 = $arr1[0];
		$str2 = $arr1[1];
		// $sale = $product_sale_price / $product_price;
		// $sale = floor($sale * 100) / 100; 
		// $arr1 = str_split($sale, 2); 
							
		// $str1 = $arr1[0];
		// $str2 = $arr1[1]; 
	}

	if($product_sale_price == 0){
		$item_price_order = $product_price;
	}
	else{
		$item_price_order = $sale;
	}
 
}
else{
	echo "<script> window.location = 'product.php'; </script>";
}


?>
<!DOCTYPE>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/mystylee.css"> 
		<link rel="stylesheet" type="text/css" href="css/starability/starability-all.min.css"/>
		<script src="js/jquery.js"></script> 
		<script src="js/bootstrap.js"></script>
		<script src="js/ul.js"></script>
		<script src="js/date_time123.js"></script>

		<title>IDOKZKIE v0.002</title>
		<style>
		body{background-color: white !important;}
		.list-group a .list-group-item{text-decoration: none;color:black;}
		.list-group a li:hover{border-left:20px solid #f4511e;background-color: hsl(0, 0%, 94%);text-decoration: none;color:black;} 
		.logo-brand{color:black;border-bottom: 3px solid #f4511e;padding: 10px;display: inline-block;margin-top: 2px;}
 		.href-image h2 small{text-decoration: none;font-size: 0.49em;}
 		.href-order{font-size: 1.8em;}
 		.container-text{width:100%;height: 15%;}
 		.btn-default:hover:disabled{background-color: red;}
 		.cursor-wait {cursor: wait !important;}
 		.carousel-inner img {border:0px solid transparent;height: auto;width: 100%;padding: 0px;margin: 0px;background-color: white;margin-bottom: 4px;}
		.carousel-caption h3 {color: #fff !important;}
		.carousel-hover:hover{cursor: pointer;}
		#myCarousel{padding-top: 40px;}
		#idFeedBack{height: 800px;overflow: auto;padding: 10px;border:1px solid hsl(0, 0%, 94%);}
 		@media (max-width: 1199px) {
			.image-product{height: auto !important;} 
		}
		@media (max-width: 1000px) {
			.mini-image{height: 35% !important;} 
		}
		@media (max-width: 580px) {
			.mini-image{height: 23% !important;} 
		}
		@media (max-width: 390px) {
			.mini-image{height: 15% !important;} 
		}
		@media (max-width: 310px) {
			.mini-image{height: 11% !important;} 
		}
		.affix {top: 0;width: 100%;z-index: 1030;}
		.padding-item{padding-bottom: 20px;}
		</style>
	</head>
	<body>

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
	
	<?php 
	include 'navbar.php';
	?>
 
	<div class="container" style="margin-top: 76px;">
		<div class="row"> 
			<div class="col-md-3 panel-default" style="border-top:2px solid #f4511e;padding:15px;"> 
				<h2>CATEGORIES</h2>
				<ul class="list-group">
				<?php
					$query_categ = mysqli_query($sql, "SELECT * FROM product_category");
					while($row_categ = mysqli_fetch_array($query_categ)){
						$get_product_categ = $row_categ['category'];
						$query_brand = mysqli_query($sql, "SELECT * FROM products where product_category = '$get_product_categ'");
						$count_categ = mysqli_num_rows($query_brand);  
						?>
							<a href="product.php?xproductBrandx=<?php echo $get_product_categ; ?>" style="text-decoration: none;"><li class="list-group-item"><span class="badge"><?php echo $count_categ; ?></span> <?php echo $get_product_categ; ?></li></a>
						<?php 
					}
				?>
				
                </ul>
			</div>
			<div class="col-md-9" style="border-top:2px solid #f4511e;margin-top: 0px;">
				<div class="row" style="padding-top: 0px;">
					<div class="col-md-6">
						
							<input type="hidden" id="product_id" value="<?php echo $product_id; ?>">
							<input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
							<input type="hidden" id="product_sale_price" value="<?php echo $item_price_order; ?>"> 
							<input type="hidden" id="orig_product_stock" value="<?php echo $orig_product_stock; ?>"> 

							<div id="myCarousel" class="carousel slide" data-ride="carousel">
						    <!-- Indicators -->

							    <!-- Wrapper for slides -->
							    <div class="carousel-inner" role="listbox">
							      <div class="item active">
							        <img src="images/products/<?php echo $product_image1; ?>" alt="Product" class="" style="width:100%;padding:5px;height:auto;">  
							      </div>

							      <div class="item">
							        <img src="images/products/<?php echo $product_image2; ?>" alt="Product" class="" style="width:100%;padding:5px;height:auto;">
							      </div>
							    
							      <div class="item">
							        <img src="images/products/<?php echo $product_image3; ?>" alt="Product" class="" style="width:100%;padding:5px;height:auto;">    
							      </div>
							      <div class="item">
							        <img src="images/products/<?php echo $product_image4; ?>" alt="Product" class="" style="width:100%;padding:5px;height:auto;">    
							      </div>
							    </div>

							    
							</div>



							<div class="row">
							<div class="col-md-12">
								<div class="mini-image" style="height: 18%;width: 100%;">
									<div style="border: 1px solid hsl(0, 0%, 80%);height: 100%;width: 24%;float:left;">
										<a data-target="#myCarousel" data-slide-to="0" class="carousel-hover">
											<img src="images/products/<?php echo $product_image1; ?>" alt="Product" class="image-responsive" style="width:100%;padding:5px;height:auto;">
										</a>
									</div>
									<div style="border: 1px solid transparent;height:auto;width: 1.333333333333333%;float:left;margin-left: 0px;"></div>
									<div style="border: 1px solid hsl(0, 0%, 80%);height: 100%;width: 24%;float:left;">
										<a data-target="#myCarousel" data-slide-to="1" class="carousel-hover">
											<img src="images/products/<?php echo $product_image2; ?>" alt="Product" class="image-responsive" style="width:100%;padding:5px;height:auto;">
										</a>
									</div>
									<div style="border: 1px solid transparent;height:auto;width: 1.333333333333333%;float:left;margin-left: 0px;"></div>
									<div style="border: 1px solid hsl(0, 0%, 80%);height: 100%;width: 24%;float:left;">
										<a data-target="#myCarousel" data-slide-to="2" class="carousel-hover">
											<img src="images/products/<?php echo $product_image3; ?>" alt="Product" class="image-responsive" style="width:100%;padding:5px;height:auto;">
										</a>
									</div>
									<div style="border: 1px solid transparent;height:auto;width: 1.333333333333333%;float:left;margin-left: 0px;"></div>
									<div style="border: 1px solid hsl(0, 0%, 80%);height: 100%;width: 24%;float:left;">
										<a data-target="#myCarousel" data-slide-to="3" class="carousel-hover">
											<img src="images/products/<?php echo $product_image4; ?>" alt="Product" class="image-responsive" style="width:100%;padding:5px;height:auto;">
										</a>
									</div>
								</div> 
							</div>
							</div>
							<br><br>
							<?php
							if(!isset($_SESSION['user_status'])){
							?>
								<center><button type="button" id="addtocart" class="btn btn-default btn-lg" style="">ADD TO CART</button></center> 
							<?php
							}
							?>
					</div>
					<div class="col-md-6" style="margin-top: 16px;">
						<h2><?php echo $row['product_name']; ?></h2>  
						<h2 class="href-order">
							<?php
					  		if($product_sale_price == 0){
					  		?>
					  		 	PRICE: <img src="images/cart.png" alt="" /><small>Php <?php echo number_format($product_price);?>
					  		 	</small>
					  		<?php
					  		}
					  		else{
					  		?> 
					  			<small style="font-size: 24px;color:black;">ORIGINAL PRICE:</small><br><small style="color:red;"> <del>Php <?php echo number_format($product_price);?></del> >>> SALE <?php echo $str2;?>% DISCOUNT</small><br>
					  			<br>PRICE: <img src="images/cart.png" alt="" /><small>Php <?php echo number_format($item_price_order);?></small> 
					  		<?php
					  		}
					  		?>
				  		</h2>  
				  		<br>
						<a style="letter-spacing:3px;color:hsl(0, 0%, 30%);font-size: 20px;">DESCRIPTION:</a>
						<br>
						<p style="text-align:left;word-spacing:5px;color:hsl(0, 0%, 50%);font-size: 17px;"><?php echo $row['product_description']; ?>.</p>
						<br>
						<a style="letter-spacing:3px;color:hsl(0, 0%, 15%);font-size: 24px;text-decoration: none;">AVAILABLE COLORS:</a><br>
						<?php
						$query_size = mysqli_query($sql, "SELECT * FROM product_color where product_id = '$product_id'");
						while($row_size = mysqli_fetch_array($query_size)){
						$product_color = $row_size['product_color'];
						?>
							<button type="button" class="btn btn-default btn-sm" style="float:left;background-color:<?php echo $product_color; ?>;color:<?php echo $product_color; ?>;">C</button>
						<?php
						}
						?>
						<br><br>
						<a style="letter-spacing:3px;color:hsl(0, 0%, 15%);font-size: 24px;text-decoration: none;">QUANTITY:</a><br>
						<?php
						if($orig_product_stock == 0){
							?><div style="margin-top: -18px;"><h3 style="color: #f4511e;">No Stock Available</h3></div>
							<script>document.getElementById("addtocart").disabled = true;</script>
						<?php
						}
						else{
						?>
							<select style="padding:6px;" id="quantity_id">
								<?php 
								$stock = $row['product_stock'];
								for($i = 1; $i <= $stock; $i++){
								?>
									<option><?php echo $i; ?></option>
								<?php
								}
								?>
							</select>
						<?php
						}
						?>
						<div id="noStock" style="margin-top: -18px;"></div>
						<br><br>
						
					</div>
				</div>
				<br><br> 
				<div class="row" style="border-top:1px solid hsl(0, 0%, 33%);">
					<h2 style="color: hsl(0, 0%, 11%);font-size: 25px;letter-spacing: 8px;word-spacing: 15px;">COMMENTS</h2><br>
					<!-- <fieldset class="starability-growRotate">
					      <input type="radio" id="rate1" name="rating" value="1" />
					      <label for="rate1">1 star.</label>

					      <input type="radio" id="rate2" name="rating" value="2" />
					      <label for="rate2">2 stars.</label>

					      <input type="radio" id="rate3" name="rating" value="3" />
					      <label for="rate3">3 stars.</label>

					      <input type="radio" id="rate4" name="rating" value="4" />
					      <label for="rate4">4 stars.</label>

					      <input type="radio" id="rate5" name="rating" value="5" />
					      <label for="rate5">5 stars.</label>
					</fieldset> -->
					<div class="feed-back-div" id="idFeedBack">
						<?php

						$query_product_feedback = mysqli_query($sql, "SELECT * FROM product_feedback where product_id = $product_id");

						if(mysqli_num_rows($query_product_feedback) > 0){
							while($row_feedback = mysqli_fetch_array($query_product_feedback)){
								$get_feedback = $row_feedback['user_comment'];
								$get_user_name = $row_feedback['user_name'];
								$get_date_comment = $row_feedback['date_comment'];

								$newDate = date("F d, Y g:i:A", strtotime($get_date_comment));
								?>

								<div class="feed-back-body" style="margin-left: 10px;border-bottom:1px dotted hsl(0, 0%, 38%);height: auto;padding-bottom: 15px;">
									<h3>
										<p><a style="color: hsl(0, 0%, 44%);font-size: 0.9em;letter-spacing: 5px;word-spacing: 7px;"><?php echo $get_user_name; ?></a> - <small><?php echo $newDate; ?></small> </p>
										<!-- <span class="" style="padding:8px;width: 11%;border:1px solid red;">
								            <img src="images/users/user-2.png" alt="User Avatar" class="" style="width: 100%;height: auto;" />
								        </span> -->
								        <p style="line-height: 30px;color: black;word-spacing: 4px;font-size: 0.6em;"><?php echo $get_feedback; ?></p>
									</h3>
								</div>
								<?php
							}
						}
						else{
							?>
								<center><h2 style="color: hsl(0, 0%, 11%);font-size: 55px;letter-spacing: 8px;word-spacing: 15px;">NO COMMENT</h2></center>
								<script> document.getElementById('idFeedBack').style.height = '130px'; </script>
							<?php
						}
						?>
						


					</div> 
					<br>
					<?php
					if(isset($_SESSION['user_xxDisplayxx_user'])){
						if(!isset($_SESSION['user_status'])){ 
						?>
						<h2 style="color: hsl(0, 0%, 45%);font-size: 25px;letter-spacing: 8px;word-spacing: 15px;">LEAVE COMMENT HERE</h2>
						<form method="POST" action="item_comment.php">
							<input type="hidden" id="product_id" name="product-id" value="<?php echo $product_id; ?>">
	                    	<textarea class="form-control" id="comments" name="comment-feedback" placeholder="Comment here..." rows="5" style="border-radius: 0px;"></textarea><br>

	                    	<button class="btn btn-default btn-md pull-right" id="btn-message" style="border-radius: 0px;" name="btn-feedback">Comment</button>
	                    </form>
	                    <?php
                		}
                	}
                	?>
				</div>
				<br><br><br>
				<div class="row" style="border-top:2px solid #f4511e;">
					<center>
						<h2 style="color: hsl(0, 0%, 11%);font-size: 25px;letter-spacing: 8px;word-spacing: 15px;">OTHER PRODUCT</h2>
					</center>
					<?php
						$query_other = mysqli_query($sql, "SELECT * FROM products"); 
						while($row_products = mysqli_fetch_array($query_other)){
							$other_product_image = $row_products['product_image1']; 	
							$other_product_id = $row_products['id'];	
							$product_name = $row_products['product_name'];	
							$product_sale_price = $row_products['product_sale_price'];
							$product_price = $row_products['product_price'];

							if($product_sale_price != 0){
								$sale = 0;

								$product_sale_price = $product_sale_price / 100;
								$sale = $product_price * $product_sale_price;

								$arr1 = str_split($product_sale_price, 2); 
													
								$str1 = $arr1[0];
								$str2 = $arr1[1];
								// $sale = $product_sale_price / $product_price;
								// $sale = floor($sale * 100) / 100; 
								// $arr1 = str_split($sale, 2); 
													
								// $str1 = $arr1[0];
								// $str2 = $arr1[1];

								// $str2 = 100 - $str2;
							} 

							?>
							<div class="col-md-3 padding-item">
								<a href="order.php?other_product_id=<?php echo $other_product_id; ?>" class="href-image">
									<div class="container-image">
									  <div style="height:auto;width: 100%;padding-top: 5px;">
											<img src="images/products/<?php echo $other_product_image; ?>" alt="Product" class="image-product" style="width:99%;height:25%;">
								   	  </div>
									  <center>
									  	<div class="container-text">
									  		<h2> 
										  		<?php
										  		if($product_sale_price == 0){
										  		?>
										  			<br>
										  		 	<img src="images/cart.png" alt="" /><small>Php <?php echo number_format($product_price);?>
										  		 	</small>
										  		<?php
										  		}
										  		else{
										  		?> 
										  			<small style="color:red;"><del>Php <?php echo number_format($product_price);?></del><br> SALE <?php echo $str2;?>% DISCOUNT</small><br>
										  			<img src="images/cart.png" alt="" /><small>Php <?php echo number_format($sale);?></small> 
										  		<?php
										  		}
										  		?>
										  		<br>
										  		<small style="color: hsl(0, 0%, 11%);text-decoration: none;"><?php echo $product_name; ?></small>
										 	</h2> 
									  	</div>
									  </center>
									  <div class="div-middle">
									    <a href="order.php?other_product_id=<?php echo $other_product_id; ?>" class="btn btn-default btn-md">Quick View</a>
									  </div>
									</div>
								</a>
							</div>
						<?php
						}
					?>
					
					
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<?php
	include 'footer.php'
	?>

	<script>
		$(document).ready(function(){
			$("#addtocart").click(function(){ 
				cursor_wait();
				var user_id = $('#user_id').val();
				var product_id = $('#product_id').val(); 
				var quantity_id = $('#quantity_id').val(); 
				var orig_product_stock = $('#orig_product_stock').val(); 
				var product_price = $('#product_sale_price').val(); 
				var total = document.getElementById('total').innerText;  
				var total_amount = $('#totalAmountNavbar').val();  
				
				$('#addtocart').prop('disabled', true);
				$.ajax({
	                url: "order_now.php",
	                type: 'POST',
	                data: {user_id:user_id,product_id:product_id,quantity_id:quantity_id,total:total,product_price:product_price,orig_product_stock:orig_product_stock},

	                success: function(data){
	                	if(data=="YES"){  
	                		var loopQuantity = new Number(orig_product_stock) - new Number(quantity_id);
	                		var autoNumber = 0;
	                		if(loopQuantity == 0){
	                			$('#quantity_id').hide();
	                			$('#noStock').append('<h3 style="color: #f4511e;">No Stock Available</h3>');
		                		$('#addtocart').prop('disabled', true);
	                		}
	                		else{
		                		for(i = 0; i < loopQuantity; i++){
		                			autoNumber++;
		                			$('#quantity_id').append('<option>'+ autoNumber +'</option>');
		                		} 
		                	}
		                	remove_cursor_wait();

	                		var getTotalAmount = new Number(total_amount) + new Number(product_price);
			               	var getTotalAmount = getTotalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

	                		$('#total').html(new Number(total) + new Number(quantity_id));
	                		$('#total_amount_navbar').html(getTotalAmount);
	                		$('#totalAmountNavbar').val(new Number(total_amount) + new Number(product_price));
		                    alert("You added " + quantity_id + " item(s)"); 
		                    $('#addtocart').prop('disabled', false);
		                }
		                else if(data=="block"){
		                	window.location = 'login.php';
		                	alert("Please login your account before adding an item to cart.")
		                }
		                else{
		                    alert("Error: Connection Problem." + data);
		                } 
	                }
                
           		});
		    }); 
		}); 
	</script> 
	<script>
		//kanin nga function mo loading tawagon ra kung ang ajax nag sige pag load
		cursor_wait = function()
		{
		    // switch to cursor wait for the current element over
		    var elements = $(':hover');
		    if (elements.length)
		    {
		        // get the last element which is the one on top
		        elements.last().addClass('cursor-wait');
		    }
		    // use .off() and a unique event name to avoid duplicates
		    $('html').
		    off('mouseover.cursorwait').
		    on('mouseover.cursorwait', function(e)
		    {
		        // switch to cursor wait for all elements you'll be over
		        $(e.target).addClass('cursor-wait');
		    });
		}

		remove_cursor_wait = function()
		{
		    $('html').off('mouseover.cursorwait'); // remove event handler
		    $('.cursor-wait').removeClass('cursor-wait'); // get back to default
		}
	</script>
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

