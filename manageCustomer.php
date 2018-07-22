<?php 
session_start();

include 'db.php'; 

if(!isset($_SESSION['user_status'])){ 
	echo "<script> window.location = 'index.php'; </script>";
}
else{ 

	if(!isset($_SESSION['user_status'])){ 
		echo "<script> window.location = 'index.php'; </script>";
	}

?>
<!DOCTYPE>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="css/bootstrap.css"> 
		<link rel="stylesheet" href="css/mystylee.css"> 
		 
		<script src="js/jquery.js"></script>  
		<script src="js/bootstrap.js"></script>
		<script src="js/ul.js"></script>
		<script src="js/date_time123.js"></script>

		<title>IDOKZKIE v0.002</title>
		<style>
		.list-group a .list-group-item{text-decoration: none;color:black;}
		.list-group a li:hover{border-left:30px solid #f4511e;background-color: hsl(0, 0%, 94%);text-decoration: none;color:black;} 
		.list-group a .active-now{border-left:30px solid #f4511e;background-color: hsl(0, 0%, 89%);text-decoration: none;color:black;} 
		.logo-brand{color:black;border-bottom: 3px solid #f4511e;padding: 10px;display: inline-block;margin-top: 2px;}

		.container-image{height: 315px;position: relative;overflow: hidden;}
		.href-image{color: black;};
		.href-image:hover{text-decoration: none;color:#f4511e;}
		.image-product{width: auto;overflow: auto;}
		.affix {top: 0;width: 100%;z-index: 1030;} 
		.table-customer{padding:5px;border: 0px solid grey;box-shadow: 8px 4px 18px 6px rgba(10, 5, 5, 0.2);}
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
 		$get_id_cus = $_POST['id_cus'];
 		$get_cus_name = $_POST['cus_name'];
 		
 		$emptyId = $_SESSION['xxuser_id_userxx'];

		$query_order1 = mysqli_query($sql, "SELECT * FROM mycart where user_id = '$get_id_cus'");
		while($row_delete = mysqli_fetch_array($query_order1)){
			$get_product_id = $row_delete['product_id']; 

			$query_order2 = mysqli_query($sql, "UPDATE products SET product_stock = product_stock + 1 where id = '$get_product_id'");
		}
		mysqli_query($sql, "DELETE FROM mycart where user_id = '$get_id_cus'");
		echo "<script> alert('$get_cus_name's CART is empty.'); </script>"; 
 	}

 	if(isset($_POST['btn-order-cancel'])){
 		$get_id_cus = $_POST['id_cus'];
 		$get_cus_name = $_POST['cus_name']; 
		mysqli_query($sql, "UPDATE mycart SET order_status = 0 where user_id = '$get_id_cus'");
		echo "<script> alert('$get_cus_name's order has been remove to cart.'); </script>";
 	} 

 	if(isset($_GET['id_cus'])){
		$get_id_cus = $_GET['id_cus'];
		$get_cus_name = $_GET['cus_name'];
	}

	?>

	<div class="container " style="margin-top: 76px;">
		<div class="row"> 
				<div class="col-md-3" style="padding:20px;border-top:2px solid #f4511e;"> 
					
					<center><h2>MENU</h2></center>
					<ul class="list-group">
                      <a href="manageCustomer.php" style="text-decoration: none;"><li class="list-group-item"><span class="badge"><?php echo $count_costumer_ul_li; ?></span> VIEW CUSTOMERS</li></a> 
                      <a href="viewproducts.php" style="text-decoration: none;"><li class="list-group-item"><span class="badge"><?php echo $count_product_ul_li; ?></span> VIEW PRODUCTS</li></a> 
                    </ul>
				</div>
				<div class="col-md-9" style="border-top:2px solid #f4511e;margin-top: 0px;padding-left: 20px; padding-right: 20px;padding-top: 30px;">  
						<?php
						if(isset($get_id_cus)){ 

						?>	<center><h2><kbd><?php echo $get_cus_name; ?>'s Profile</kbd></h2></center>
							<br>
							<input type="hidden" id="idCusCart" value="<?php echo $get_id_cus; ?>">
							<a href="manageCustomer.php" class="btn btn-default btn-md" ><<< Back to Customer</a>
							<br><br>
							<div class="table-responsive table-customer">
								<center><h2>My Cart (<span id="idTotCart"></span>)</h2></center>
								<table class="table table-hover table-striped">
									<thead style="padding-top: 40px;">
										<tr> 
											<th>Item</th>
											<th>Product</th>
											<th>Price</th> 
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$empty_cart1 = 0;
										$query1 = mysqli_query($sql, "SELECT * FROM mycart ords, products prds WHERE ords.user_id = '$get_id_cus' AND ords.product_id = prds.id and ords.order_status = 0 ORDER BY ords.order_id DESC");
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
													$item_price_cart = $product_sale_price;
												}

												?> 
												<tr id="cart-tr-<?php echo $xxIDxx; ?>">
													<td style="width:20%;"><a href="" ><img src="images/products/<?php echo $product_image; ?>" class="img-responsive" style="width:80%;height:auto;display: inline-block;" alt=""></a></td>
													<td><?php echo $product_name; ?></td> 
													<td><kbd>Php <?php echo number_format($item_price_cart); ?></kbd></td>
													<td>
													<input type="hidden" id="order_id-<?php echo $xxIDxx; ?>" value="<?php echo $order_id; ?>">  
													<input type="hidden" id="sale_price_id-<?php echo $xxIDxx; ?>" value="<?php echo $item_price_cart; ?>"> 
													<button type="button" class="btn btn-default btn-sm btn-manage" id="btn-table-<?php echo $xxIDxx; ?>" style="">REMOVE</button></td>
												</tr>
												<?php
											} 
										}
										else{
											$empty_cart1 = 1;
											?>
											<tr class="empty_cart">
												<td colspan="4"><h2 style="letter-spacing: 10;word-spacing: 20;"><kbd>EMPTY CART</kbd></h2></td>
											</tr> 
											<?php
										}
										?> 

									</tbody>
								</table>
							</div> 
							<br>
							<form action="manageCustomer.php" method="POST">
							<input type="hidden" name="id_cus" value="<?php echo $get_id_cus; ?>">
							<input type="hidden" name="cus_name" value="<?php echo $get_cus_name; ?>">
								<center>
									<?php
									if($empty_cart1 == 1){
									?>
										<button name="btnEmptyCart" class="btn btn-default btn-md" id="buttonEmptyCart" disabled ><<< EMPTY CART</button>
									<?php
									}
									else{
									?>
										<button name="btnEmptyCart" class="btn btn-default btn-md" id="buttonEmptyCart" ><<< EMPTY CART</button>
									<?php
									}
									?>
									
								</center> 
							</form> 
							<br><br>
							
							<div class="table-responsive table-customer">
								<center><h2>Shipping Order (<span id="idTotOrder"></span>)</h2></center>
								<table class="table table-hover table-striped">
									<thead style="padding-top: 40px;">
										<tr> 
											<th>Item</th>
											<th>Product</th>
											<th>Price</th>  
										</tr>
									</thead>
									<tbody>
										<?php 
										$no_transaction = 0;
										$query1 = mysqli_query($sql, "SELECT * FROM mycart ords, products prds WHERE ords.user_id = '$get_id_cus' AND ords.product_id = prds.id and ords.order_status = 1 ORDER BY ords.order_id DESC");
											$xxIDxxs = 0; 
											$item_price_cart = 0;
										if(mysqli_num_rows($query1) > 0){
											$totalOrderPrice = 0;
											while($row1 = mysqli_fetch_array($query1)){ 
												$xxIDxxs ++;
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
													<td style="width:20%;"><a href="" ><img src="images/products/<?php echo $product_image; ?>" class="img-responsive" style="width:80%;height:auto;display: inline-block;" alt=""></a></td>
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
											<th></th>
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
							<br>
							<form action="manageCustomer.php" method="POST">
							<input type="hidden" name="id_cus" value="<?php echo $get_id_cus; ?>">
							<input type="hidden" name="cus_name" value="<?php echo $get_cus_name; ?>">
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
						<?php
						}
						else{
						?>
							<center><h2><kbd>MANAGE CUSTOMER</kbd></h2></center>
							<br> 
							<div class="table-responsive table-customer">
								<table class="table table-hover table-striped">
									<thead>
										<tr>
											<th></th>
											<th>Account</th>
											<th>Phone #</th>
											<th>Address</th> 
											<th>Cart</th>
											<th>Shipping Order</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query_table_customer = mysqli_query($sql, "SELECT * FROM users where user_status != 1");
											$autoNum = 0;
										while($row_customer = mysqli_fetch_array($query_table_customer)){
											$autoNum++;
											$getName = $row_customer['user_account'];
											$getEmail = $row_customer['user_email'];
											$getAddress = $row_customer['user_address'];
											$getPhone = $row_customer['user_phone']; 
											$getforcount = $row_customer['id']; 

											$query_count_item = mysqli_query($sql, "SELECT * FROM mycart where user_id = '$getforcount' and order_status = 1");
											$get_count_order = mysqli_num_rows($query_count_item); 

											$query_count_item = mysqli_query($sql, "SELECT * FROM mycart where user_id = '$getforcount' and order_status = 0");
											$get_count_cart = mysqli_num_rows($query_count_item); 

											?>
											<tr>
												<td><?php echo $autoNum; ?></td>
												<td><?php echo $getName; ?></td> 
												<td><?php echo $getPhone; ?></td>
												<td><?php echo $getAddress; ?></td>
												<td style="text-align: center;"><?php echo $get_count_cart; ?></td>
												<td style="text-align: center;"><?php echo $get_count_order; ?></td>
												<td><a href="manageCustomer.php?id_cus=<?php echo $getforcount; ?>&&cus_name=<?php echo $getName; ?>" class="btn btn-default btn-md">View Profile</a></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div> 
						<?php
						}
						?>
				</div> 
		</div>
	</div>
	<br><br>
	<?php

	include 'footer.php';

	if(isset($_GET['id_cus'])){
		$get_id_cus = $_GET['id_cus'];

		$query1 = mysqli_query($sql, "SELECT * FROM mycart ords, products prds WHERE ords.user_id = '$get_id_cus' AND ords.order_status = 0 AND ords.product_id = prds.id ORDER BY ords.order_id DESC");
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
						var idtotcart = document.getElementById('idTotCart').innerHTML;

						$("#cart-tr-<?php echo $xxIDxx; ?>").fadeOut(1000);   
						
						$('.btn-manage').prop('disabled', true);
				        $.ajax({
			                url: "remove_item.php",
			                type: 'POST',
			                data: {order_id:order_id,sale_price_id:sale_price_id,idtotcart:idtotcart},

			                success: function(data){
			                	if(data=="YES"){
			                		var getTotCart = new Number(idtotcart) - 1;
			                		$('#idTotCart').html(getTotCart);
			                		$('.btn-manage').prop('disabled', false);

			                		if(getTotCart == 0){
			                			$('#buttonEmptyCart').prop('disabled', true);	
			                		}
			                		remove_cursor_wait();
									
				                    alert("1 Item Remove."); 
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
	<script>

	document.getElementById('idTotOrder').innerHTML = <?php echo $xxIDxxs; ?>;
	document.getElementById('idTotCart').innerHTML = <?php echo $xxIDxx; ?>;
		// $(document).ready(function(){
  //       	$('#btn_incre_item').click(function(){
  //       		var incre_add = $('#incre_add_item').val();

  //       		if(incre_add > 0){ 
  //       			$('#appendAddItem').empty(); 
  //       			var auto = 0;
  //       			for(i = 0; i < incre_add; i++){
  //       				auto++;
  //       				$('#appendAddItem').append('<div class="form-group"><label for="email">Product Name:</label><input type="email" class="form-control" id="email"></div><div class="form-group"<label for="pwd">Password:</label><input type="password" class="form-control" id="pwd"></div><div class="checkbox"><label><input type="checkbox"> Remember me</label></div>'); 
  //       			}


  //       		}
  //       		else if(incre_add == 0){
  //       			alert('Please enter greater than 0.')
  //       		}
  //       		else{
  //       			alert('Please enter a whole number.');
  //       		}
  //       	});
  //   	});	 
	</script>
	</body>
</html>
<?php
}
?>