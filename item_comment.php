<?php

include 'db.php';
session_start();



if(isset($_POST['btn-feedback'])){
	$product_id = $_POST['product-id'];
	$my_comment_here = $_POST['comment-feedback'];
	$display_name = $_SESSION['user_xxDisplayxx_user'];
	$get_date_now = date("Y-m-d h:i:sa");

	mysqli_query($sql, "INSERT INTO product_feedback values('', '$product_id', '$my_comment_here', '$display_name', '$get_date_now') ");

	echo "<script> window.location = 'order.php?other_product_id=$product_id'; </script>";
}

?>