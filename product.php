<?php
session_start();

include 'db.php';

if(isset($_GET['xproductBrandx'])){
	$get_product_brand = $_GET['xproductBrandx'];
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
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/ul.js"></script>
		<script src="js/date_time123.js"></script>

		<title>IDOKZKIE v0.002</title>
		<style>
		.list-group a .list-group-item{text-decoration: none;color:black;}
		.list-group a li:hover{border-left:20px solid #f4511e;background-color: hsl(0, 0%, 94%);text-decoration: none;color:black;} 
		.logo-brand{color:black;border-bottom: 3px solid #f4511e;padding: 10px;display: inline-block;margin-top: 2px;}

		.container-image{height: 315px;position: relative;overflow: hidden;}
		.href-image h2 small{text-decoration: none;font-size: 0.49em;}
		.href-image h2 small:hover{text-decoration: none;color:black;}
		.image-product{width: auto;overflow: auto;}
		.container-text{width:100%;height: 15%;}
		@media (max-width: 1199px) {
			.image-product{height: auto !important;} 
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
				<div class="row" style="padding-top: 40px;">
					
					<?php
						if(isset($_POST['navbar-search-engine'])){
							$get_search_engine = $_POST['navbar-search-engine'];
							$query_other = mysqli_query($sql, "SELECT * FROM products where product_category LIKE '%$get_search_engine%' OR product_name LIKE '%$get_search_engine%' OR product_description LIKE '%$get_search_engine%' OR product_search_key1 LIKE '%$get_search_engine%' OR product_search_key2 LIKE '%$get_search_engine%'");
							if(mysqli_num_rows($query_other) > 0){
								?>
								<h2 style="margin-left:12px;color: hsl(0, 0%, 11%);font-size: 25px;letter-spacing: 1px;word-spacing: 4px;color:red;">Searching For <?php echo '"'.$get_search_engine.'".'; ?><br><br></h2>
								<?php
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
											<div class="container-image" style="padding-top: 15px;height:auto;">
											  <div style="height:28%;width: 100%;padding-top: 5px;">
													<img src="images/products/<?php echo $other_product_image; ?>" alt="Product" class="image-product" style="width:99%;height:100%;">
										   	  </div> 
											  <center>
											  <br>
											  <div class="container-text">
											  	<h2> 
											  		<?php
											  		if($product_sale_price == 0){
											  		?>	<br>
											  		 	<img src="images/cart.png" alt="" /><small>Php <?php echo number_format($product_price);?>
											  		 	</small>
											  		<?php
											  		}
											  		else{
											  		?> 
											  			<small style="color:red;"><del>Php <?php echo number_format($product_price);?></del><br>SALE <?php echo $str2;?>% DISCOUNT</small><br>
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
											    <a  class="btn btn-default btn-md" href="order.php?other_product_id=<?php echo $other_product_id; ?>">Quick View</a>
											  </div>
											</div>
										</a>
									</div>
								<?php
								}
							}
							else{
								?>
								<h2 style="margin-left:40px;color: hsl(0, 0%, 11%);font-size: 25px;letter-spacing: 1px;word-spacing: 4px;color:red;">No Result Found, Searching For <?php echo '"'.$get_search_engine.'".'; ?><br><br><br>
								<center><small style="color:black;font-size: 28px;">Try Again.</small></center></h2>
								<?php
							}
						}
						else if(isset($_GET['xproductBrandx'])){
							$query_other = mysqli_query($sql, "SELECT * FROM products where product_category = '$get_product_brand'");
							if(mysqli_num_rows($query_other) > 0){
								?>
								<h2 style="margin-left:12px;color: hsl(0, 0%, 11%);font-size: 25px;letter-spacing: 1px;word-spacing: 4px;color:red;">Looking For <?php echo '"'.$get_product_brand.'".'; ?><br><br></h2>
								<?php
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
											<div class="container-image" style="padding-top: 15px;height:auto;">
											  <div style="height:28%;width: 100%;padding-top: 5px;">
													<img src="images/products/<?php echo $other_product_image; ?>" alt="Product" class="image-product" style="width:99%;height:100%;">
										   	  </div> 
											  <center>
											  <br>
											  <div class="container-text">
											  	<h2> 
											  		<?php
											  		if($product_sale_price == 0){
											  		?>	<br>
											  		 	<img src="images/cart.png" alt="" /><small>Php <?php echo number_format($product_price);?>
											  		 	</small>
											  		<?php
											  		}
											  		else{
											  		?> 
											  			<small style="color:red;"><del>Php <?php echo number_format($product_price);?></del><br>SALE <?php echo $str2;?>% DISCOUNT</small><br>
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
											    <a  class="btn btn-default btn-md" href="order.php?other_product_id=<?php echo $other_product_id; ?>">Quick View</a>
											  </div>
											</div>
										</a>
									</div>
								<?php
								}
							}
							else{
								?>
								<h2 style="margin-left:40px;color: hsl(0, 0%, 11%);font-size: 25px;letter-spacing: 1px;word-spacing: 4px;color:red;">No Item Found, Looking for <?php echo '"'.$get_product_brand.'".'; ?><br><br><br>
								<center><small style="color:black;font-size: 28px;">Try Again.</small></center></h2>
								<?php
							}
						}
						else{

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
									//binali na paagi
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
										<div class="container-image" style="padding-top: 15px;height:auto;">
										  <div style="height:auto;width: 100%;padding-top: 5px;">
												<img src="images/products/<?php echo $other_product_image; ?>" alt="Product" class="image-product" style="width:99%;height:25%;">
									   	  </div> 
										  <center>
										  <br>
										  <div class="container-text">
										  	<h2> 
										  		<?php
										  		if($product_sale_price == 0){
										  		?>	<br>
										  		 	<img src="images/cart.png" alt="" /><small>Php <?php echo number_format($product_price);?>
										  		 	</small>
										  		<?php
										  		}
										  		else{
										  		?> 
										  			<small style="color:red;"><del>Php <?php echo number_format($product_price);?></del><br>SALE <?php echo $str2;?>% DISCOUNT</small><br>
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
										    <a  class="btn btn-default btn-md" href="order.php?other_product_id=<?php echo $other_product_id; ?>">Quick View</a>
										  </div>
										</div>
									</a>
								</div>
							<?php
							}
					
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

	</script>
	</body>
</html>

