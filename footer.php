<?php
if(isset($_SESSION['user_xxDisplayxx_user'])){
	if(!isset($_SESSION['user_status'])){ 
	?>
		<div class="container" id="idChatContainer" style="">
		    <div class="row">
		        <div class="col-md-7"></div>
		        <div class="col-md-5">
		            <div class="panel panel-warning" style="border-top:2px solid #f4511e;border:1px solid grey;">
		                <div class="panel-heading" id="accordion" style="border-radius: 0px !important;color:white;background-color: hsl(0, 0%, 22%);">
		                    <span class="glyphicon glyphicon-comment"></span> Admin | CART2CARD
		                    <div class="btn-group pull-right">
		                        <a type="button" id="readUpdate" class="btn btn-default btn-sm btn-chat" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
		                            <span class="glyphicon glyphicon-minus"></span>
		                        </a>
		                        <a type="button" class="btn btn-default btn-sm btn-chat" id="idChatClose">
		                            <span class="glyphicon glyphicon-remove"></span>
		                        </a>
		                    </div>
		                </div>
		                <div class="panel-collapse collapse" id="collapseOne">
		                    <div class="panel-body" id="scrollNow">
		                        <ul class="chat ulInfo">
		                            

		                        </ul>
		                    </div>
		                    <div class="panel-footer">
		                        <div class="input-group">
		                            <input id="btn-input-chat" type="text" class="form-control input-sm" placeholder="Type your message here..." />
		                            <span class="input-group-btn">
		                                <button class="btn btn-default btn-sm" id="btn-chat">
		                                    Send</button>
		                            </span>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	<?php
	}
}

?>
<footer>
	<div class="container footer-top-break">
		<div class="footer-top">
			<center>
				<div class="col-md-4">
					<h3>SERVICES</h3>
					<ul class="footer-details"> 
						<li><a href="#">Shipping</a></li> 
						<li><a href="#">Returns</a></li>
						<li><a href="#">Bulk Orders</a></li>
						<li><a href="#">Buying Guides</a></li>					 
					</ul> 
				</div>
				<div class="col-md-4">
					<h3>ACCOUNT</h3>
					<ul class="footer-details">
						<li><a href="#">Your Account</a></li>
						<li><a href="#">Personal Information</a></li>
						<li><a href="#">Discount</a></li>
						<li><a href="#">Track your order</a></li>					 					 
						<li><a href="#">Cancel your order</a></li>					 					 
					</ul>
				</div>
				<div class="col-md-4">
					<h3>ABOUT US</h3>
					<ul class="footer-details">
						<li><a href="#">Team</a></li>
						<li><a href="#">Carrers</a></li>
						<li><a href="#">Latest Product</a></li>
						<li><a href="#contact">Contact Us</a></li>			 
					</ul>
				</div>
			</center>
		</div>
	</div> 
	<div class="container-fluid bg-grey" style="box-shadow: 0 -130px 222px 22px rgba(244, 81, 30, 0.2);">
		<section id="#contact">
		  <br><br>
		  <h2 class="text-center">CONTACT</h2>
		  <br>
		  <div class="row">
		  	<div class="col-sm-2">

		  	</div>
		    <div class="col-sm-3">
		      <p>You can reach me at:</p>
		      <p><span class="glyphicon glyphicon-map-marker"></span> Duhat St. Western Bicutan, Taguig City</p>
		      <p><span class="glyphicon glyphicon-phone"></span> +369061976864</p>
		      <p><span class="glyphicon glyphicon-envelope"></span> martebillyjames@gmail.com</p> 
		    </div>
		    <div class="col-sm-5">
		      <form action="sent_email.php" method="POST">
		      <div class="row">
		        <div class="col-sm-6 form-group">
		          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
		        </div>
		        <div class="col-sm-6 form-group">
		          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
		        </div>
		      </div>
		      <textarea class="form-control" id="comments" name="comment" placeholder="Comment" rows="5"></textarea><br>
		      <div class="row">
		        <div class="col-sm-12 form-group">
		          <button class="btn btn-default pull-right"" type="submit" name="btn-customer-request">Send</button>
		        </div>
		      </div>
		      </form> 
		    </div>
		    <div class="col-sm-2">

		  	</div>
		  </div>
		</section>
	</div>
	<div class="container-fluid" style="background-color: #f55524;padding: 10px;"> 
			<div class="" style="font-size: 16px;letter-spacing: 3px;word-spacing: 10px;color: white;"> 
					<p>Develop || Design By: Billy James Marte E-Commerce v0.002</p> 
			</div>  
	</div>
</footer>
<script>
	$(document).ready(function(){
		$('.btn-chat').click(function(){
			var scroll_Now = document.getElementById('scrollNow'); scroll_Now.scrollTop = scroll_Now.scrollHeight;
		});
	});
</script>