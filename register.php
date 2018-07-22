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
		.login-div{background-color: hsl(0, 0%, 100%);border:1px solid hsl(0, 0%, 78%);width: 100%;height:auto;padding: 35px;padding-bottom: 70px;padding-top: 20px;}
		body{background-color: hsl(0, 0%, 96%);}
		h2{font-size: 2.4em;letter-spacing: 2px;color: hsl(0, 0%, 44%);}
		a{color:#f4511e;}
		a:hover{color:blue;}
		</style>
	</head>
	<body>  
	<?php
		if(isset($_POST['btn-register'])){
			$acc = $_POST['acc'];
			$pass = $_POST['pass'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$phone = $_POST['phone']; 

			$query = "INSERT INTO users VALUES('', '$acc', '$pass', '$email', '$address', '$phone', '0')";
			$query = mysqli_query($sql, $query);

			$query_id = mysqli_query($sql, "SELECT id FROM users ORDER BY id DESC");
			$row_id = mysqli_fetch_array($query_id);
			$get_latest_id = $row_id['id'];
			$set_message = "Good day Mr/Ms. ". $acc . ", how may i help you?";
			$get_date_now = date("Y-m-d h:i:sa");

			$query1 = mysqli_query($sql, "INSERT INTO users_conversation values('', '$get_latest_id', '$set_message', 1, 0, '$get_date_now')");
			$query2 = mysqli_query($sql, "INSERT INTO users_convo_date values('', '$get_latest_id', '$get_date_now', 0, 0)");

			echo "<script> alert('Account added'); </script>";
			echo "<script> window.location = 'login.php'; </script>";
		}
	?>
	<div class="container-fluid" >
		<div class="row"> 
			<div class="col-md-3"></div>
			<div class="col-md-6" style="padding-top:45px;">
				<div class="login-div">
					<form action="register.php" method="POST">
					  <center><h2>REGISTER</h2></center>
					  <br>
					  <div class="form-group">
					    <label>Account:</label>
					    <input id="" type="text" class="form-control" name="acc" placeholder="Account" required />
					  </div> 
					  <div class="form-group">
					    <label>Password:</label>
					    <input id="" type="password" class="form-control" name="pass" placeholder="Password" required />
					  </div> 
					  <div class="form-group">
					    <label>Email:</label>
					    <input id="" type="text" class="form-control" name="email" placeholder="Email" required />
					  </div> 
					  <div class="form-group">
					    <label>Address:</label>
					    <input id="" type="text" class="form-control" name="address" placeholder="Address" required />
					  </div> 
					  <div class="form-group">
					    <label>Phone #:</label>
					    <div class="input-group">
						    <span class="input-group-addon">+63</span>
						    <input type="text" maxlength="10" minlength="10" class="form-control numbers-only" name="phone" placeholder="Phone #" required >
						</div>
					  </div>
					  
					  <br> 
					  	<center>
					  		<a href="login.php" class="pull-left">I already have an account.</a>
					  		<input type="submit" name="btn-register" class="btn btn-default btn-sm pull-right"  value="SUBMIT" /> 
					  	</center> 
					</form>
				</div>
			</div>
			<div class="col-md-3"></div>

		</div>
	</div> 

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

