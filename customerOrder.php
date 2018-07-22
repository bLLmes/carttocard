<?php 

session_start();

include 'db.php'; 



if(!isset($_SESSION['user_xxDisplayxx_user'])){
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">";
		$_SESSION['cart_denied'] = "YES";
}
else{ 


	if(isset($_SESSION['user_status'])){ 
		echo "<script> window.location = 'index.php'; </script>";
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
			.table tr th, .table tr td{text-align: center;}
			.table tr td{vertical-align: middle;}  
			.logo-brand{color:black;border-bottom: 3px solid #f4511e;padding: 10px;display: inline-block;margin-top: 2px;}
			.empty_cart td:hover{background-color: hsl(0, 0%, 92%);}
			.btn-default:hover:disabled{background-color: red;}
			.cursor-wait {cursor: wait !important;}
			.card {padding-top:20px;padding: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);max-width: 100%;margin: auto;text-align: left;} 
			.info {color: grey;font-size: 18px;}
			.shiporder li, .shiporder li ul li{list-style-type: none;}
			.title-profile{font-size: 1.3em;}
			.input-transparent{overflow: hidden; width:100%;border: 0px solid transparent;background-color: transparent;padding: 5px;}
			.affix {top: 0;width: 100%;z-index: 1030;} 
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

		if(isset($_POST['btn-order-cancel'])){
			$userId = $_SESSION['xxuser_id_userxx'];
			mysqli_query($sql, "UPDATE mycart SET order_status = 0 where user_id = '$userId'");
			echo "<script> alert('Your order has been remove to cart.'); </script>";
			echo "<script> window.location = 'cart.php' </script>";
		} 

		?> 
		<div class="container" style="margin-top: 116px;border-top:2px solid #f4511e;">
			<div class="row">
				<div class="col-md-3" style="padding-top: 40px;">
					<div class="card">
					    <h3 style="text-indent: 7px;"><input id="updName" class="input-transparent" type="text" name="" value="<?php echo $_SESSION['user_xxDisplayxx_user']; ?>" disabled /></h3>
					    <div style="border: 1px solid #f3511e;"></div>
					    <br>
					    <p class="title-profile">Address:</p>
					    <p style="text-indent: 7px;"><input id="updAddress" class="input-transparent" type="text" name="" value="<?php echo $_SESSION['user_address']; ?>" disabled /></p>
					    <p class="title-profile">Email:</p>
					    <p style="text-indent: 7px;"><input id="updEmail" class="input-transparent" type="text" name="" value="<?php echo $_SESSION['user_email']; ?>" disabled /></p>
					    <p class="title-profile">Phone #:</p>
					    <p style="text-indent: 7px;"><input id="updPhone" class="input-transparent" type="text" name="" value="<?php echo $_SESSION['user_phone']; ?>" disabled /></p>  
					    <button type="button" id="plusButton" class="btn btn-default btn-xs">Change Password</button>
					    <button type="button" id="minusButton" class="btn btn-default btn-xs">Hide Password</button>
					    <div id="hidePassword">
					    	<p class="title-profile">Current Password:</p>
					    	<p style="text-indent: 7px;"><input id="updCurrentPass" class="input-transparent showNow" type="password" name="" value="" /></p> 
					    	<p class="title-profile">New Password:</p>
					    	<p style="text-indent: 7px;"><input id="updNewPass" class="input-transparent showNow" type="password" name="" value="" /></p>
					    	<div class="checkbox">
							    <label><input type="checkbox" class="passwordShow" style="padding: 5px;" onchange = "togglecheckboxes(this,'itemClassSelect')" > <span id="spanLabelPass">Hide Password</span> </label>
							</div>
					    </div>
					    <br><br>
					    <button type="button" id="btnEditProfile" class="btn btn-default btn-md">Edit Profile</button>
					    <button type="button" id="btnUpdateProfile" class="btn btn-default btn-md">Update Profile</button> 
					</div> 
				</div>
				<div class="col-md-9">
					<div class="col-md-8" style="padding-top: 40px;">
						<div style="padding:15px;padding-top: 25px;width:100%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
							<div class="table-responsive">
								<center><h4 style="font-size: 1.5em;">ORDER LIST</h4></center>
								<table class="table table-hover table-striped" style="margin-top: 40px;">
									<thead>
										<tr>
											<th>NAME</th> 
											<th>PRICE</th> 
										</tr>
									</thead>
									<tbody>
									<?php
										$no_transaction = 0;
										$user_id_cart = $_SESSION['xxuser_id_userxx'];
										$query1 = mysqli_query($sql, "SELECT * FROM mycart ords, products prds WHERE ords.user_id = '$user_id_cart' AND ords.product_id = prds.id and ords.order_status = 1 ORDER BY ords.order_id DESC");
											$xxIDxx = 0; 
											$item_price_cart = 0;
										if(mysqli_num_rows($query1) > 0){
											$totalOrderPrice = 0;
											while($row1 = mysqli_fetch_array($query1)){ 
												$xxIDxx ++;
												$order_id = $row1['order_id'];
												$product_image = $row1['product_image1'];
												$product_name = $row1['product_name'];
												$product_sale_price = $row1['product_sale_price'];
												$product_price = $row1['product_price'];
												$product_stock = $row1['product_stock'];
												$product_id = $row1['product_id'];  

												if($product_sale_price == 0){
													$item_price_cart = $product_price;
												}
												else{
													$item_price_cart = $product_sale_price;
												}
												$totalOrderPrice = $totalOrderPrice + $item_price_cart
												?> 
												<tr> 
													<td><?php echo $product_name; ?></td> 
													<td><kbd>Php <?php echo number_format($item_price_cart); ?></kbd></td> 
												</tr>
												<?php
											} 
										}
										else{
											$no_transaction = 1;
											?>
											<tr class="empty_cart">
												<td colspan="4"><h2 style="letter-spacing: 10;word-spacing: 20;"><kbd>NO TRANSACTION</kbd></h2></td>
											</tr> 
											<?php
										}
										?> 

									</tbody> 
									<tfoot style="border-top: 4px solid hsl(0, 0%, 22%);">
										<tr>
											<th>TOTAL PAYMENT</th>
											<th><kbd>Php 
											<?php 
											if($no_transaction == 1){
												echo "0.00";
											}
											else{
												echo number_format($totalOrderPrice);
											}
											?></kbd></th>
										</tr>
									</tfoot>
								</table> 
							</div>
							<br><br>

						</div>
						
					</div>
					<div class="col-md-4" style="padding-top: 40px;">
						<form action="customerOrder.php" method="POST">
							<center>
								<?php
								if($no_transaction == 1){
									?>
									<button type="submit" class="btn btn-default btn-md" name="btn-order-cancel" disabled ><<< CANCEL ORDER</button>
									<?php
								}
								else{
									?>
									<button type="submit" class="btn btn-default btn-md" name="btn-order-cancel"><<< CANCEL ORDER</button>
									<?php
								}
								?>
							</center>
						</form>
						<br><br>
						<img src="images/myorder.png" alt="Truck" style="width:100%;height:auto;">
					</div>
				</div>
			</div>
		</div>
		<br><br>
		<?php
		include 'footer.php';
		?>
		<script>
			$(document).ready(function(){
				$('#btnUpdateProfile').hide(); 
				$('#hidePassword').hide();  
				$('#hideAgain').hide(); 
				$('#plusButton').hide(); 
				$('#minusButton').hide();

				$('.passwordShow').click(function(event) {
				  if(this.checked) {
				  	$('#spanLabelPass').html('Show Password');
				  	$('.showNow').attr('type', 'text');
				  }
				  else {
				  	$('#spanLabelPass').html('Hide Password');
				  	$('.showNow').attr('type', 'password');
				  }
				}); 

				$('#minusButton').click(function(){
					$('#hidePassword').hide();    
					$('#plusButton').show();  
					$('#minusButton').hide();  
				});

				$('#plusButton').click(function(){
					$('#hidePassword').show();    
					$('#minusButton').show();  
					$('#plusButton').hide();  
				});

				$("#btnEditProfile").click(function(){  
					$('#btnEditProfile').hide(); 
					$('#plusButton').show();  
					$('#btnUpdateProfile').show();  
					$('.input-transparent').css({"background-color": "hsl(0, 0%, 98%)","border": "1px solid hsl(0, 0%, 66%)"});
					$('.input-transparent').prop('disabled', false); 
				});
				$("#btnUpdateProfile").click(function(){  
					
					var updName = $('#updName').val();
					var updEmail = $('#updEmail').val();
					var updAddress = $('#updAddress').val();
					var updPhone = $('#updPhone').val();
					

					if ($('#hidePassword').is(":hidden")){
						var updCurrentPass = 1;
						var updNewPass = 1;
					}
					else{
						var updCurrentPass = $('#updCurrentPass').val();
						var updNewPass = $('#updNewPass').val(); 
					}

					$.ajax({
		                url: "update_profile.php",
		                type: 'POST',
		                data: {updCurrentPass:updCurrentPass,updName:updName,updEmail:updEmail,updAddress:updAddress,updPhone:updPhone,updNewPass:updNewPass},

		                success: function(data){
		                	if(data == "success"){
		                		$('#btnEditProfile').show(); 
								$('#btnUpdateProfile').hide(); 
								$('.input-transparent').css({"background-color": "transparent","border": "0px solid transparent"});
								$('.input-transparent').prop('disabled', true);
								$('#hidePassword').hide();
								$('#plusButton').hide();
								$('#minusButton').hide();

								$('#updName').val(updName);
								$('#updEmail').val(updEmail);
								$('#updAddress').val(updAddress);
								$('#updPhone').val(updPhone);  
								$('#updCurrentPass').val('');  
								$('#updNewPass').val('');  

								alert('Profile updated.');
		                	}
		                	else if(data == "empty current password"){
								alert('Empty Current Password.');
							}
							else if(data == "empty password"){
								alert('Empty New Password.');
							}
		                	else if(data == "not match"){
		                		alert('Password not match.');
		                	}
		                	else{
		                		alert("Error: Connection Problem. " + data);
		                	}
		                }
		        	});
				});
			});
		</script>
		</body>
	</html>
<?php
}
?>
