<?php

include 'db.php';
session_start();


if(isset($_SESSION['user_xxDisplayxx_user'])){
	date_default_timezone_set('Asia/Manila');

	if(isset($_POST['idconvo'])){
		$id_convo = $_POST['idconvo'];

		$get_user_type = $_SESSION['user_type_status'];
		$get_date_now = date("Y-m-d G:i:s");
		$get_convo_now = $_POST['convo'];

		$query_send = mysqli_query($sql, "INSERT into users_conversation values('', '$id_convo', '$get_convo_now', '$get_user_type', 0, '$get_date_now')");

		mysqli_query($sql, "UPDATE users_convo_date set latest_convo_date = '$get_date_now', convo_read = convo_read + 1 where user_id = '$id_convo'");
	}
	else{
		$where_id = $_SESSION['xxuser_id_userxx'];
		$get_name = $_SESSION['user_xxDisplayxx_user'];
		$get_user_type = $_SESSION['user_type_status'];
		$get_date_now = date("Y-m-d G:i:s");
		$get_convo_now = $_POST['convo'];

		$query_send = mysqli_query($sql, "INSERT into users_conversation values('', '$where_id', '$get_convo_now', '$get_user_type', 0, '$get_date_now')");

		mysqli_query($sql, "UPDATE users_convo_date set latest_convo_date = '$get_date_now', convo_read = convo_read + 1 where user_id = '$where_id'");
	}
}
else{
	echo "<script> window.location = 'index.php' </script>";
}
?>