<?php
session_start();
include 'db.php';


if(isset($_SESSION['user_xxDisplayxx_user'])){
	$updName = $_POST['updName'];
	$updAddress = $_POST['updAddress'];
	$updEmail = $_POST['updEmail'];
	$updPhone = $_POST['updPhone'];
	$updCurrentPass = $_POST['updCurrentPass'];
	$updNewPass = $_POST['updNewPass'];
	$user_id_user = $_SESSION['xxuser_id_userxx'];
	$user_password_user = $_SESSION['user_password'];


	if($updNewPass == 1){
		$updNewPass = md5($updNewPass);
		echo "success";
		mysqli_query($sql, "UPDATE users set user_account = '$updName', user_email = '$updEmail', user_address = '$updAddress', user_phone = '$updPhone' where id = '$user_id_user'");

		$_SESSION['user_xxDisplayxx_user'] = $updName; 
		$_SESSION['user_email'] = $updEmail;
		$_SESSION['user_address'] = $updAddress;
		$_SESSION['user_phone'] = $updPhone;
	}
	else{
		if($updCurrentPass == ""){
			echo "empty current password";
		}
		else if($updNewPass == ""){
			echo "empty password";
		}
		else{
			$updCurrentPass = md5($updCurrentPass);

			if($user_password_user != $updCurrentPass){
				echo "not match";
			}
			else{
				$updNewPass = md5($updNewPass);
				echo "success";
				mysqli_query($sql, "UPDATE users set user_account = '$updName', user_password = '$updNewPass', user_email = '$updEmail', user_address = '$updAddress', user_phone = '$updPhone' where id = '$user_id_user'");

				$_SESSION['user_xxDisplayxx_user'] = $updName;
				$_SESSION['user_password'] = $updNewPass;
				$_SESSION['user_email'] = $updEmail;
				$_SESSION['user_address'] = $updAddress;
				$_SESSION['user_phone'] = $updPhone;
			}
		}
	}
}
else{
	echo "<script> window.location = 'index.php' </script>";
}
?>