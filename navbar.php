<?php 
 
// echo "<BR><BR><BR><BR><BR><BR><BR>"; 
// echo "<BR><BR><BR><BR><BR><BR><BR>"; 
// echo "<BR><BR><BR><BR><BR><BR><BR>";

include 'db.php';
$navbar_total_amount = 0.00;
$count_item_span = 0;
if(isset($_SESSION['user_xxDisplayxx_user'])){
	$user_id = $_SESSION['xxuser_id_userxx'];
	$query_item_span = mysqli_query($sql, "SELECT * FROM mycart ords, products prds WHERE ords.user_id = '$user_id' AND ords.product_id = prds.id AND ords.order_status = 0"); 
	$count_item_span = mysqli_num_rows($query_item_span); 
	while($row_navbar = mysqli_fetch_array($query_item_span)){
		$product_sale_price_navbar = $row_navbar['product_sale_price'];  
		$product_price_navbar = $row_navbar['product_price'];  

		if($product_sale_price_navbar == 0){
			$navbar_total_amount = $navbar_total_amount + $product_price_navbar;
		}
		else{
			$sale = 0;

			$product_sale_price_navbar = $product_sale_price_navbar / 100;
			$sale = $product_price_navbar * $product_sale_price_navbar;

			// $arr1 = str_split($product_sale_price, 2); 
								
			// $str1 = $arr1[0];
			// $str2 = $arr1[1];
			$navbar_total_amount = $navbar_total_amount + $sale;
		}
	}
}
 
// this query is for ul li menu
$query_product_ul_li = mysqli_query($sql, "SELECT * FROM products");
$count_product_ul_li = mysqli_num_rows($query_product_ul_li);

$query_costumer_ul_li = mysqli_query($sql, "SELECT * FROM users where user_status = 0");
$count_costumer_ul_li = mysqli_num_rows($query_costumer_ul_li);

$query_product_ul_li = mysqli_query($sql, "SELECT * FROM products");
$count_product_ul_li = mysqli_num_rows($query_product_ul_li);

?> 

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span> 
	      </button>
	      <?php
	      if(isset($_SESSION['user_xxDisplayxx_user'])){
	      	if(!isset($_SESSION['user_status'])){
		      	?>
		      		<a class="logo-brand" href="cart.php"><input type="hidden" id="totalAmountNavbar" value="<?php echo $navbar_total_amount; ?>" /> Php <span id="total_amount_navbar"><?php echo number_format($navbar_total_amount); ?></span> <img src="images/cart-1.png" alt="" /> <span id="total"><?php echo $count_item_span; ?></span> Items</a>
		      	<?php
	      	}
	      	else{
	      		?>
		      		<a class="logo-brand" href="manageCustomer.php"><img src="images/cart-manage.png" alt="" /> <span
		      	>Manage Orders</span></a>
		      	<?php
	      	}
	      }
	      else{
	      	?>
	      		<a class="logo-brand" href="cart.php">Php <span id="total_amount_navbar">0.00</span> <img src="images/cart-1.png" alt="" /> <span id="total">0</span> Items</a>
	      	<?php
	      }
	      ?> 
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav"> 
	        <li class=""><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	        <li><a href="product.php"><span class="glyphicon glyphicon-list-alt"></span> Products</a></li>
	        <?php
	        if(isset($_SESSION['user_xxDisplayxx_user'])){
	        	if(!isset($_SESSION['user_status'])){
		        ?>
		        	<li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user_xxDisplayxx_user']; ?>
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
				          <li><a href="customerOrder.php"><span class="glyphicon glyphicon-send"></span> My Order</a></li>
				        </ul>
				    </li>
		        <?php
	        	}
	        	else{
	        		?>
			        	<li class="dropdown">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user_xxDisplayxx_user']; ?>
					        <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					          <li><a href="manageCustomer.php"><span class="glyphicon glyphicon-send"></span> Customer Order</a></li>
					          <li><a href="viewproducts.php"><span class="glyphicon glyphicon-list-alt"></span> Update Product</a></li>
					          <li><a href="add_item.php"><span class="glyphicon glyphicon-plus"></span> Add Product</a></li>
					        </ul>
					    </li>
			        <?php
	        	}
	        }
	        else{
	        ?>
	        	<!-- <li class="dropdown">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user_xxDisplayxx_user']; ?>
			        <span class="caret"></span></a>
			        <ul class="dropdown-menu">
			          <li><a href="#"><span class="glyphicon glyphicon-send"></span> Customer Order</a></li>
			          <li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Update Product</a></li>
			          <li><a href="#"><span class="glyphicon glyphicon-plus"></span> Add Product</a></li>
			        </ul>
			    </li> -->
	        <?php
	        }
	        ?>
	        
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	      	<?php
	      	
			if(!isset($_SESSION['user_xxDisplayxx_user'])){
			?>
				<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
	       		<li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Login</a></li> 
			<?php
			}
			else{
				if(!isset($_SESSION['user_status'])){ 
	      		?>
					<li><a type="button" class="open-chat" id="idOpenChatBtn"><span class="glyphicon glyphicon-comment"></span> Admin Support</a></li>
	      		<?php
	      		}
	      		else{
	      		?>
	      			<li><a href="messages.php"><span class="glyphicon glyphicon-comment"></span> Customer Support</a></li>
	      		<?php
	      		}
				?>
	       		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> 
			<?php
			}			 
			?>
	      </ul>
	    </div> 
  </div>
</nav>
<div class="container-fluid" style="box-shadow: 0 5px 122px 52px rgba(244, 81, 30, 0.2);padding-top: 56px;border-bottom: 1px solid #fcc6b6;">
	<div class="row" style="width: 100%:height:auto;">
		<div class="col-md-2" style="border: 0px solid white;"><img src="images/logo/logo2.png" class="image-responsive" style="width:100%;height:auto;"></div>
		<div class="col-md-7" style="padding-top: 10px;border: 0px solid white;">
			<form method="POST" action="product.php">
				<input name="navbar-search-engine" type="text" class="navbar-search input-md" placeholder="Search..." style="border-radius: 0px;" />
			</form>
		</div>
		<div class="col-md-3"><center><h3 style="padding-top: 3px;"><span id="date_time"></span>
		<script type="text/javascript">window.onload = date_time('date_time');</script></h3></center></div>
	</div>
</div>