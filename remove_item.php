<?php
include 'db.php';
session_start();

if(isset($_SESSION['user_xxDisplayxx_user'])){
	echo "YES";
	$order_id = $_POST['order_id'];
	$query1 = mysqli_query($sql, "SELECT * FROM mycart ords, products prds WHERE ords.order_id = '$order_id' AND ords.product_id = prds.id"); 
	$row1 = mysqli_fetch_array($query1);
	$quantity = $row1['product_stock']; 
	$product_id = $row1['product_id']; 
	$product_stock = $quantity + 1;

	$query2 = "UPDATE products SET product_stock = '$product_stock' WHERE id = '$product_id'";  
	mysqli_query($sql, $query2);

	$query = mysqli_query($sql, "DELETE FROM mycart WHERE order_id = '$order_id' ");
}
else{
	echo "<script> window.location = 'index.php' </script>";
}
?>