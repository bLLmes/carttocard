<?php 

session_start();

include 'db.php'; 

if(isset($_SESSION['user_status'])){ 
	echo "<script> window.location = 'index.php'; </script>";
}

if(!isset($_SESSION['user_xxDisplayxx_user'])){
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">";
		$_SESSION['cart_denied'] = "YES";
}
else{ 
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

		if(isset($_POST['btnEmptyCart'])){
			$emptyId = $_SESSION['xxuser_id_userxx'];

			$query_order1 = mysqli_query($sql, "SELECT * FROM mycart where user_id = '$emptyId'");
			while($row_delete = mysqli_fetch_array($query_order1)){
				$get_product_id = $row_delete['product_id']; 

				$query_order2 = mysqli_query($sql, "UPDATE products SET product_stock = product_stock + 1 where id = '$get_product_id'");
			}
			mysqli_query($sql, "DELETE FROM mycart where user_id = '$emptyId'");
			echo "<script> alert('You have an empty CART.'); </script>";
			echo "<script> window.location = 'product.php' </script>";
		}
		if(isset($_POST['btnShip'])){
			$userId = $_SESSION['xxuser_id_userxx'];
			mysqli_query($sql, "UPDATE mycart SET order_status = 1 where user_id = '$userId'");

			// comment below is for sending email
			// $query_user_item = mysqli_query($sql, "SELECT * FROM mycart ords, products prds WHERE ords.user_id = '$user_id_cart' AND ords.product_id = prds.id and ords.order_status = 0 ORDER BY ords.order_id DESC");
			// $to_user_message = "";
			// while($row1 = mysqli_fetch_array($query1)){
			// 	$order_id = $row1['order_id'];
			// 	$product_image = $row1['product_image1'];
			// 	$product_name = $row1['product_name'];
			// 	$product_sale_price = $row1['product_sale_price'];
			// 	$product_price = $row1['product_price'];
			// 	$product_stock = $row1['product_stock'];
			// 	$product_id = $row1['product_id'];  

				// 	if($product_sale_price == 0){
				// 		$item_price_cart = $product_price;
				// 	}
				// 	else{
				// 		$item_price_cart = $product_sale_price;
				// 	}

				// 	$to_user_message = $to_user_message. "* Product name: ".$product_name." - Price: ".$item_price_cart. ". <br> ";
			// }

			// $to      = 'martebillyjames@gmail.com';
			// $subject = 'Notification from Cart To Card';
			// $message = 'hello';
			// $headers = 'From: carttocard.com' . "\r\n" .
			//     'Reply-To: martebillyjames@gmail.com' . "\r\n" .
			//     'X-Mailer: PHP/' . phpversion();

			// mail($to, $subject, $message, $headers);

			// include "api/smsGateway.php";
			//   $smsGateway = new SmsGateway('martebillyjames@gmail.com', 'whatsmyname419');

			//   $deviceID = 55867;
			//   $number = '+639061976864';
			//   $message = '1';

			//   echo $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);

			echo "<script> alert('View order now.'); </script>";
			echo "<script> window.location = 'customerOrder.php' </script>";
		}

		?> 
		<div class="container" style="margin-top: 116px;border-top:2px solid #f4511e;">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive" style="padding:5px;padding-top: 10px;">
						<center>
							<h3>TOTAL AMOUNT: <br><kbd>Php <span id="total_amount"><?php echo number_format($navbar_total_amount); ?></span></kbd>
							</h3>
						
							<br>
						</center>
						<form action="cart.php" method="POST">
							<button name="btnEmptyCart" class="btn btn-default btn-md pull-left" id="buttonEmptyCart" ><<< EMPTY CART</button>
							<button name="btnShip" class="btn btn-default btn-md pull-right" id="buttonShip" >SHIP NOW >>></button>
						</form>
						<br>
						<table class="table table-hover table-striped" style="margin-top: 40px;">
							<thead>
								<tr>
									<th>ITEM</th>
									<th>PRODUCT</th> 
									<th>PRICE</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$user_id_cart = $_SESSION['xxuser_id_userxx'];
								$query1 = mysqli_query($sql, "SELECT * FROM mycart ords, products prds WHERE ords.user_id = '$user_id_cart' AND ords.product_id = prds.id and ords.order_status = 0 ORDER BY ords.order_id DESC");
									$xxIDxx = 0; 
									$item_price_cart = 0;
								if(mysqli_num_rows($query1) > 0){

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
											$sale = 0;

											$product_sale_price = $product_sale_price / 100;
											$item_price_cart = $product_price * $product_sale_price;

											// $arr1 = str_split($product_sale_price, 2); 
																
											// $str1 = $arr1[0];
											// $str2 = $arr1[1];
										}

										?> 
										<tr id="cart-tr-<?php echo $xxIDxx; ?>">
											<td style="width:20%;"><a href="" ><img src="images/products/<?php echo $product_image; ?>" class="img-responsive" style="width:80%;height:auto;display: inline-block;" alt=""></a></td>
											<td><?php echo $product_name; ?></td> 
											<td><kbd>Php <?php echo number_format($item_price_cart); ?></kbd></td>
											<td>
											<input type="hidden" id="order_id-<?php echo $xxIDxx; ?>" value="<?php echo $order_id; ?>">  
											<input type="hidden" id="sale_price_id-<?php echo $xxIDxx; ?>" value="<?php echo $item_price_cart; ?>"> 
											<button type="button" class="btn btn-default btn-sm" id="btn-table-<?php echo $xxIDxx; ?>" style="">REMOVE</button></td>
										</tr>
										<?php
									} 
								}
								else{
									?>
									<tr class="empty_cart">
										<td colspan="4"><h2 style="letter-spacing: 10;word-spacing: 20;"><kbd>EMPTY CART</kbd></h2></td>
									</tr> 
									<?php
								}
								?> 

							</tbody> 
						</table>
						<center>
							<div id="emptyCartDiv"></div>
						</center>
						<?php
						if(mysqli_num_rows($query1) > 0){

						}
						else{
							?>
							<script>
								document.getElementById("buttonShip").disabled = true;
							    document.getElementById("buttonEmptyCart").disabled = true;
							</script> 
							<br><br><br><br><br>
							<br><br><br><br><br>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<br><br>
		<?php
		include 'footer.php';

		$query1 = mysqli_query($sql, "SELECT * FROM mycart ords, products prds WHERE ords.user_id = '". $_SESSION['xxuser_id_userxx'] ."' AND ords.order_status = 0 AND ords.product_id = prds.id ORDER BY ords.order_id DESC");
			$xxIDxx = 0;
		while($row1 = mysqli_fetch_array($query1)){ 
			$xxIDxx ++;
			?>
			<script>
				$(document).ready(function(){
					$("#btn-table-<?php echo $xxIDxx; ?>").click(function(){ 
						cursor_wait();
						var order_id = $('#order_id-<?php echo $xxIDxx; ?>').val(); 
						var sale_price_id = $('#sale_price_id-<?php echo $xxIDxx; ?>').val(); 
						var total = document.getElementById('total').innerText; 
						var total_amount = $('#totalAmountNavbar').val(); 

						$("#cart-tr-<?php echo $xxIDxx; ?>").fadeOut(1000);   
						
						$('.btn-default').prop('disabled', true);
				        $.ajax({
			                url: "remove_item.php",
			                type: 'POST',
			                data: {order_id:order_id,total:total,total_amount:total_amount,sale_price_id:sale_price_id},

			                success: function(data){
			                	if(data=="YES"){
			                		remove_cursor_wait();
			                		var getTotalAmount = new Number(total_amount) - new Number(sale_price_id);
			                		var getTotalAmount = getTotalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			                		var totalIsEmpty = new Number(total) - 1;

			                		$('#total_amount_navbar').html(getTotalAmount);
			                		$('#total_amount').html(getTotalAmount);
			                		$('#totalAmountNavbar').val(new Number(total_amount) - new Number(sale_price_id));
			                		$('#total').html(totalIsEmpty); 
				                    alert("1 Item Remove."); 
				                    $('.btn-default').prop('disabled', false);
				                    if(totalIsEmpty ==0){
				                    	$('#buttonShip').prop('disabled', true);
				                    	$('#buttonEmptyCart').prop('disabled', true);
				                    	$('#emptyCartDiv').append('<h2 style="letter-spacing: 10;word-spacing: 20;"><kbd>EMPTY CART</kbd></h2>');
				                    }  
				                }else{
				                    alert("Error: Connection Problem. " + data);
				                } 
			                }
		                
		           		});
				    });  
				});
			</script>
		<?php
		}
		?> 
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
		</body>
	</html>
<?php
}
?>
