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

	if(isset($_POST['btn-add-item'])){
		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$item_price = $_POST['item_price'];
		$item_description = $_POST['item_description'];
		$item_brand = $_POST['item_brand'];

		$rand1 = rand();
		$rand2 = rand();
		$rand3 = rand();
		$rand = $rand1 ."_". $rand2 ."_". $rand3;

		$item_image1 = $_FILES['item_image1']['name'];
		$extension = explode('.', $item_image1);
		$extension = end($extension);
		$item_image1 = $rand ."_1.". $extension;
		 
		$item_image2 = $_FILES['item_image2']['name'];
		$extension = explode('.', $item_image2);
		$extension = end($extension);
		$item_image2 = $rand ."_2.". $extension;
		 
		$item_image3 = $_FILES['item_image3']['name'];
		$extension = explode('.', $item_image3);
		$extension = end($extension);
		$item_image3 = $rand ."_3.". $extension;
		 
		$item_image4 = $_FILES['item_image4']['name'];
		$extension = explode('.', $item_image4);
		$extension = end($extension);
		$item_image4 = $rand ."_4.". $extension;
		 
		$item_tmp_image1 = $_FILES['item_image1']['tmp_name'];
		$item_tmp_image2 = $_FILES['item_image2']['tmp_name'];
		$item_tmp_image3 = $_FILES['item_image3']['tmp_name'];
		$item_tmp_image4 = $_FILES['item_image4']['tmp_name'];  

		move_uploaded_file($item_tmp_image1, "images/products/". $item_image1);
		move_uploaded_file($item_tmp_image2, "images/products/". $item_image2);
		move_uploaded_file($item_tmp_image3, "images/products/". $item_image3);
		move_uploaded_file($item_tmp_image4, "images/products/". $item_image4);

		$search_key1 = "all / any";
		$search_key2 = "";
		if($item_brand == "Cellphone"){
			$search_key2 = "Smartphone";
		}
 
		$query1 = mysqli_query($sql, "INSERT INTO products VALUES('', '$item_name', '$item_description', '$item_brand', '$item_image1', '$item_image2', '$item_image3', '$item_image4', '$item_price', 0, '$item_number', '$search_key1', '$search_key2')");

		$auto_id = mysqli_query($sql, "SELECT * FROM products order by id desc");
		$row = mysqli_fetch_array($auto_id);
		$incre_id = $row['id']; 
 
		if(!empty($_POST['item_color'])) {
			
			$item_colors = $_POST['item_color'];
		    foreach($item_colors as $item_color) { 
		       	mysqli_query($sql, "INSERT INTO product_color VALUES('', '$incre_id', '$item_color')");
		    }
		}  
		// $query3 = mysqli_query($sql, "INSERT INTO product_image VALUES('', '$incre_id', '$item_image1', '$item_image2', '$item_image3', '$item_image4'");

		echo "<script> alert('Item Added.'); </script>";
		echo "<script> window.location = 'order.php?other_product_id=". $incre_id ."'; </script>";
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
					<form action="add_item.php" method="POST" enctype="multipart/form-data">
						<center><h2><kbd>ADD ITEM</kbd></h2></center>
						<br> 
							 
								<div class="form-group">
								    <label for="productName">Item Name:</label>
								    <input type="text" class="form-control" name="item_name" required />
								</div> 
								<div class="form-group">
								  <label for="description">Description:</label>
								  <textarea class="form-control" rows="5" name="item_description" required ></textarea>
								</div>
								<div class="form-group">
								    <label for="description">Price:</label>
								    <input type="text" class="form-control numbers-only" name="item_price" required />
								</div> 
								<div class="form-group">
								  <label for="sel1">Item Brand:</label>
								  <select class="form-control" id="sel1" name="item_brand" required>
								    <option value=""> -- Select Category --</option> 
								    <?php
								    $query_categ = mysqli_query($sql, "SELECT * FROM product_category");
								    while($row_categ = mysqli_fetch_array($query_categ)){
								    	$get_product_categ = $row_categ['category'];
								    	?>
								    	<option value="<?php echo $get_product_categ; ?>"><?php echo $get_product_categ; ?></option>
								    	<?php
								    } 
								    ?>
								  </select>
								</div>
								<div class="form-group">
								    <label for="numberOfStock">Number of Stock:</label>
								    <input type="text" class="form-control numbers-only" name="item_number" required />
								</div> 
								<div class="form-group" >
								    <label for="description">Select the available color(s) of an item:</label>
									<div style="padding-left: 30px;">
										<div class="checkbox">
										    <label><input type="checkbox" id="itemColorSelect" onchange = "togglecheckboxes(this,'itemClassSelect')" /> Select All </label>
										</div>
										<?php
										$query_data_color = mysqli_query($sql, "SELECT * FROM product_data_color");
										while($row_data_color = mysqli_fetch_array($query_data_color)){
											$get_data_color_name = $row_data_color['data_color'];
											?>
												<div class="checkbox">
												    <label><input type="checkbox" name="item_color[]" class="itemClassSelect" value="<?php echo $get_data_color_name; ?>"> <?php echo $get_data_color_name; ?> </label>
												</div>
											<?php
										}
										?>
									</div>
								</div>  
								<input name="upload_max_filesize" type="hidden" value="1000000" />
								<div class="form-group">
								    <label for="image1">Select 1st image:</label>
								    <input type="file" class="form-control" name="item_image1" />
								</div> 
								<div class="form-group">
								    <label for="image2">Select 2nd image:</label>
								    <input type="file" class="form-control" name="item_image2" />
								</div> 
								<div class="form-group">
								    <label for="image3">Select 3rd image:</label>
								    <input type="file" class="form-control" name="item_image3" />
								</div> 
								<div class="form-group">
								    <label for="image4">Select 4th image:</label>
								    <input type="file" class="form-control" name="item_image4" />
								</div> 
								<br><br>
							  	<button type="submit" class="btn btn-default" name="btn-add-item">Submit</button> 
							<br><br><br><br>
							<br><br> 
					</form> 
				</div> 
		</div>
	</div>
	<br><br>
	<?php

	include 'footer.php'
	?>

	<script>
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