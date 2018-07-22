<?php
session_start();

include 'db.php';

if(isset($_SESSION['user_xxDisplayxx_user'])){
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
}
 
?>
<!DOCTYPE>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/mystyle.css">
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<title>IDOKZKIE v0.002</title>
		<style>   
		.table tr th, .table tr td{text-align: center;}
		.table tr td{vertical-align: middle;}  
		.logo-brand{color:black;border-bottom: 3px solid #f4511e;padding: 10px;display: inline-block;margin-top: 2px;}
		.login-div{background-color: hsl(0, 0%, 100%);border:1px solid hsl(0, 0%, 78%);width: 100%;height:auto;padding: 30px;padding-bottom: 70px;}
		body{background-color: hsl(0, 0%, 96%);}
		h2{font-size: 2.4em;letter-spacing: 2px;color: hsl(0, 0%, 44%);}
		a{color:#f4511e;}
		a:hover{color:blue;}
		</style>
	</head>
	<body> 
	<?php
		if((isset($_POST['acc'])) and (isset($_POST['pass']))){
			$acc = $_POST['acc'];
			$pass = $_POST['pass'];
			$pass = md5($pass);

			$query = mysqli_query($sql, "SELECT * FROM users where user_account = '$acc' AND user_password = '$pass'"); 

			if(mysqli_num_rows($query) > 0){

				$row = mysqli_fetch_array($query);
				$display = $row['user_account'];

				$_SESSION['xxuser_id_userxx'] = $row['id'];
				$_SESSION['user_xxDisplayxx_user'] = $row['user_account'];
				$_SESSION['user_password'] = $row['user_password'];
				$_SESSION['user_email'] = $row['user_email'];
				$_SESSION['user_address'] = $row['user_address'];
				$_SESSION['user_phone'] = $row['user_phone'];
				$_SESSION['user_type_status'] = $row['user_status'];
				
				$blockUser = $row['user_status'];
				if($blockUser == 1){
					$_SESSION['user_status'] = $row['user_status'];
				}
				echo "<script> alert('Welcome $display'); </script>";

				if(isset($_SESSION['order_block_id'])){
					echo "<script> window.location = 'order.php'; </script>";
				}
				else if(isset($_SESSION['cart_denied'])){
					echo "<script> window.location = 'cart.php'; </script>";
				}
				else{
					
					echo "<script> window.location = 'product.php'; </script>";
				} 

			}
			else{
				echo "<script> alert('Invalid, Try again.'); </script>";
				echo "<script> window.location = 'login.php'; </script>";
			}

		}
	?>
	<div class="container-fluid" >
		<div class="row" style="padding-top:0px;"> 
			<center><img src="images/logo/logo2.png" class="image-responsive" style="width:30%;height:auto;"></center>
			<div class="col-md-4"></div>
			<div class="col-md-4">

				<div class="login-div">
					<form action="login.php" method="POST">
					  <center> 
					  <h2>LOGIN</h2></center>
					  <br>
					  <div class="form-group">
					    <label>Username:</label>
					    <input id="email" type="text" class="form-control" name="acc" placeholder="Account">
					  </div> 
					  <div class="form-group">
					    <label>Password:</label>
					    <input id="password" type="password" class="form-control" name="pass" placeholder="Password">
					  </div> 
					  <br> 
					  	<center>
					  		<a href="register.php" class="pull-left">Register Here</a>
					  		<input type="submit" name="btn-login" class="btn btn-default btn-sm pull-right" value="LOGIN">
					  		
					  		
					  	</center> 
					</form>
				</div>
			</div>
			<div class="col-md-4"></div>

		</div>
	</div> 

	<script>

	</script>
	</body>
</html>

