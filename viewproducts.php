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
 
	if(isset($_POST['btn-update-item'])){
		$get_now_id_prod = $_POST['item_id'];
		$post_item_name = $_POST['item_name'];
		$post_item_price = $_POST['item_price'];
		$post_item_sale_price = $_POST['item_sale_price'];
		$post_item_older_stock = $_POST['item_older_stock'];
		$post_item_add_stock = $_POST['item_add_stock'];
		$post_item_categ = $_POST['item_brand'];
		$post_item_description = $_POST['item_description'];
		$total_stock = $post_item_older_stock + $post_item_add_stock;

		$query_update_product = mysqli_query($sql, "UPDATE products SET product_name = '$post_item_name', product_description = '$post_item_description', product_category = '$post_item_categ', product_price = '$post_item_price', product_sale_price = '$post_item_sale_price', product_stock = '$total_stock' where id = '$get_now_id_prod'");

		mysqli_query($sql, "DELETE FROM product_color where product_id = '$get_now_id_prod'");

		if(!empty($_POST['item_color'])) {
			$item_colors = $_POST['item_color'];
		    foreach($item_colors as $item_color) { 
		       	$item_color. "<BR>";
		       	mysqli_query($sql, "INSERT INTO product_color VALUES('', '$get_now_id_prod', '$item_color')");
		    }
		}

		echo "<script> alert('Update Completed.'); </script>";
	}

	$query_data_color = mysqli_query($sql, "SELECT * FROM product_data_color");
	$count_data_color = mysqli_num_rows($query_data_color);
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
						if(isset($_GET['id_prod'])){
							$get_now_id_prod = $_GET['id_prod'];
							$query_edit_prod = mysqli_query($sql, "SELECT * FROM products where id = '$get_now_id_prod'");
							$row_edit_prod = mysqli_fetch_array($query_edit_prod);

							$get_edit_prod_id = $row_edit_prod['id'];
							$get_edit_prod_name = $row_edit_prod['product_name'];
							$get_edit_prod_description = $row_edit_prod['product_description'];
							$get_edit_prod_category = $row_edit_prod['product_category'];
							$get_edit_prod_price = $row_edit_prod['product_price'];
							$get_edit_prod_sale_price = $row_edit_prod['product_sale_price'];
							$get_edit_prod_stock = $row_edit_prod['product_stock'];
							?>
								<form action="viewproducts.php" method="POST">
								<center><h2><kbd>UPDATE ITEM</kbd></h2></center>
								<br> 
									 	<input type="hidden" name="item_id" value="<?php echo $get_edit_prod_id; ?>">
										<div class="form-group">
										    <label for="productName">Item Name:</label>
										    <input type="text" class="form-control" name="item_name" value="<?php echo $get_edit_prod_name; ?>" required />
										</div>
										<div class="form-group">
										    <label for="description">Price:</label>
										    <input type="number" class="form-control" name="item_price" value="<?php echo $get_edit_prod_price; ?>" readonly />
										</div> 
										<div class="form-group">
										    <label for="description">Sale Price:</label>
										    <input type="text" class="form-control numbers-only" name="item_sale_price" maxlength="2" value="<?php echo $get_edit_prod_sale_price; ?>" />
										</div>
										<div class="form-group">
										    <label for="numberOfStock">Older Stock:</label>
										    <input type="number" class="form-control" name="item_older_stock" value="<?php echo $get_edit_prod_stock; ?>" readonly />
										</div>
										<div class="form-group">
										    <label for="numberOfStock">Add Stock:</label>
										    <input type="text" class="form-control numbers-only" name="item_add_stock" value="0" />
										</div>
										<div class="form-group">
										  <label for="sel1">Item Brand:</label>
										  <select class="form-control" id="sel1" name="item_brand" required>
										    <option value=""> -- Select Category --</option> 
										    <?php
										    $query_categ = mysqli_query($sql, "SELECT * FROM product_category");
										    while($row_categ = mysqli_fetch_array($query_categ)){
										    	$get_product_categ = $row_categ['category'];
										    	if($get_edit_prod_category == $get_product_categ){
										    	?>
										    		<option value="<?php echo $get_product_categ; ?>" selected ><?php echo $get_product_categ; ?></option>
										    	<?php
										    	}
										    	else{
										    	?>
										    		<option value="<?php echo $get_product_categ; ?>"><?php echo $get_product_categ; ?></option>
										    	<?php
										    	}
										    } 
										    ?>
										  </select>
										</div>
										<div class="form-group" >
										    <label for="description">Select the available color(s) of an item:</label>
											<div style="padding-left: 30px;">
												<div class="checkbox">
												    <label><input type="checkbox" id="itemColorSelect" onchange = "togglecheckboxes(this,'itemClassSelect')" /> Select All </label>
												</div>
												<?php
												$query_data_color = mysqli_query($sql, "SELECT * FROM product_data_color");
												$count_data_color = mysqli_num_rows($query_data_color);
												while($row_data_color = mysqli_fetch_array($query_data_color)){
													$get_data_color_name = $row_data_color['data_color'];
													$query_equiv_data_color = mysqli_query($sql, "SELECT * FROM product_color where product_color = '$get_data_color_name' AND product_id = '$get_now_id_prod'");

													if(mysqli_num_rows($query_equiv_data_color) > 0){
													$count_data_color = $count_data_color - 1;
													?>
														<div class="checkbox">
												    		<label><input type="checkbox" name="item_color[]" class="itemClassSelect" value="<?php echo $get_data_color_name; ?>" checked /> <?php echo $get_data_color_name; ?> </label>
														</div>
													<?php
													}
													else{
													$count_data_color = $count_data_color + 1;
													?>
														<div class="checkbox">
														    <label><input type="checkbox" name="item_color[]" class="itemClassSelect" value="<?php echo $get_data_color_name; ?>" /> <?php echo $get_data_color_name; ?> </label>
														</div>
													<?php
													}
												}

												?>
											</div>
										</div>
										<div class="form-group">
										  <label for="description">Description:</label>
										  <textarea class="form-control" rows="5" name="item_description" required ><?php echo $get_edit_prod_description; ?></textarea>
										</div>
										
									  	<button type="submit" class="btn btn-default" name="btn-update-item">Update</button> 
									<br><br><br><br>
									<br><br> 
							</form> 
						<?php
						}
						else{
						?>
							<center><h2><kbd>MANAGE PRODUCTS</kbd></h2></center>
							<br>
							<a href="add_item.php" class="btn btn-default btn-md pull-right" >Add Item >>></a>
							<br><br>
							<div class="table-responsive" style="padding-top: 20px;">
								<table class="table table-hover table-striped">
									<thead>
										<tr> 
											<th>Item</th>
											<th>Product Name</th> 
											<th>Price</th>
											<th>Sale Price</th>
											<th>Stock</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query_table_product = mysqli_query($sql, "SELECT * FROM products");
											$autoNum = 0;
										while($row_product = mysqli_fetch_array($query_table_product)){
											$autoNum++;
											$get_product_id = $row_product['id'];
											$get_product_image1 = $row_product['product_image1'];
											$get_product_name = $row_product['product_name'];
											$get_product_price = $row_product['product_price'];
											$get_product_sale_price = $row_product['product_sale_price']; 
											$get_product_stock = $row_product['product_stock']; 
											?>
											<tr>
												<td style="width: 12%;"><img src="images/products/<?php echo $get_product_image1; ?>" class="img-responsive" style="width:100%;height:auto;" alt=""></td>
												<td><?php echo $get_product_name; ?></td> 
												<td>Php <?php echo number_format($get_product_price); ?></td>
												<td><?php 
													if($get_product_sale_price == 0){
														echo "<kbd>No Sale Price</kbd>";
													}
													else{
														echo "Php ". number_format($get_product_sale_price);
													}
												?></td>
												<td><?php echo $get_product_stock; ?></td>
												<td><a href="viewproducts.php?id_prod=<?php echo $get_product_id; ?>" class="btn btn-default btn-md">View Details</a></td>
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

	include 'footer.php'
	?>

	<script>
		$('#itemColorSelect').click(function(event) {
		  if(this.checked) {
		      // Iterate each checkbox
		      $('.itemClassSelect').each(function() {
		          this.checked = true;
		      });
		  }
		  else {
		    $('.itemClassSelect').each(function() {
		          this.checked = false;
		      });
		  }
		}); 
		$('.itemClassSelect').click(function(){
			$('#itemColorSelect').prop("checked", false);
		});
	</script>
	<?php
	if($count_data_color == 0){
	?>
	<script>
		document.getElementById('itemColorSelect').checked = true;
	</script>
	<?php
	}
	?>
	<script>
    $('.letters-only').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z _\b]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        } else {
        e.preventDefault();
        return false;
        }
    });
    $('.numbers-only').keypress(function (e) {
        var regex = new RegExp("^[0-9_\b]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        } else {
        e.preventDefault();
        return false;
        }
    });
    </script>
	</body>
</html>
<?php
}
?>