<?php
session_start();
include 'db.php';


if(!isset($_SESSION['user_xxDisplayxx_user'])){
	$_SESSION['order_block_id'] = "order block"; 
	echo "block";
}
else{
	echo "YES";
	$quantity_loop = $_POST['quantity_id'];
	for($i = 1; $i <= $quantity_loop; $i++){
		$query = mysqli_query($sql, "INSERT INTO mycart values('', '".$_POST['user_id']."', '".$_POST['product_id']."', '', 0, 0, '', 0)");  

		$query1 = mysqli_query($sql, "SELECT * FROM products where id = '". $_POST['product_id'] ."' "); 
		$row = mysqli_fetch_array($query1);
		$quantity = $row['product_stock'];
		$product_stock = $quantity - 1;

		mysqli_query($sql, "UPDATE products set product_stock = '$product_stock' where id='". $_POST['product_id'] ."' ");  
	}
}
?>