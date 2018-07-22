<?php 
session_start();

?>
<!DOCTYPE>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/mystylee.css">
		<link rel="shortcut icon" href="images/logo/logo2.png">

		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/ul.js"></script>
		<script src="js/date_time123.js"></script>

		<title>IDOKZKIE v0.002</title>
		<style>
		.list-group a .list-group-item{text-decoration: none;color:black;}
		.list-group a li:hover{border-left:20px solid #f4511e;background-color: hsl(0, 0%, 66%);text-decoration: none;color:white;} 
		.logo-brand{color:black;border-bottom: 3px solid #f4511e;padding: 10px;display: inline-block;margin-top: 2px;}
		.href-image h2 small{text-decoration: none;font-size: 0.49em;}
		
		.navbar-search{width: 130px;box-sizing: border-box;border: 2px solid #ccc;border-radius: 4px;font-size: 16px;background-color: white;background-image: url('images/searchicon.png');background-position: 10px 10px;background-repeat: no-repeat;padding: 12px 20px 12px 40px;-webkit-transition: width 0.4s ease-in-out;transition: width 0.4s ease-in-out;}
		.navbar-search:focus{width: 100%;}
		.affix {top: 0;width: 100%;z-index: 1030;} 

		/*chat box */ 
		@media (max-width: 1110px) {
            .panel-default{width: 45% !important;} 
        }
        @media (max-width: 720px) {
            .panel-default{width: 70% !important;} 
        }
        @media (max-width: 440px) {
            .panel-default{width: 94% !important;} 
        }
        .panel-primary-messages{width: 100%;}
        .panel-heading{}
        .chat
		{
		    list-style: none;
		    margin: 0;
		    padding: 0;
		}

		.chat li
		{
		    margin-bottom: 10px;
		    padding-bottom: 5px;
		    border-bottom: 1px dotted #B3A9A9;
		}

		.chat li.left .chat-body
		{
		    margin-left: 60px;
		}

		.chat li.right .chat-body
		{
		    margin-right: 60px;
		}


		.chat li .chat-body p
		{
		    margin: 0;
		    color: #777777;
		}

		.panel .slidedown .glyphicon, .chat .glyphicon
		{
		    margin-right: 5px;
		}

		.panel-body
		{
		    overflow-y: scroll;
		    height: 250px;
		}
		.messages-user-list{list-style-type: none;margin: 0;padding: 0;width: 100%;background-color: white;height: 100%;overflow-y: scroll;}
		.li-user-list{display: block;color: #000;padding: 0.5px 4px;text-decoration: none;}
		.li-user-list a {height:auto;display: block;color: #000;padding: 12px 18px;text-decoration: none;  
		}
		.li-user-list button{height:auto;color: #000;padding: 10px;border:0px;background-color: transparent;width: 100%;}
		.li-user-list a:hover{cursor:pointer;background-color: hsl(0, 0%, 96%);}
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

	if(isset($_GET['id_convo'])){
		$get_top_id = $_GET['id_convo'];
		$get_top_name = $_GET['user_name'];

	}
	else{
		$query_latest = mysqli_query($sql, "SELECT * FROM users_convo_date ucd, users usr where ucd.user_id = usr.id ORDER BY ucd.latest_convo_date DESC");
		$row_messages = mysqli_fetch_array($query_latest);
		$get_top_id = $row_messages['user_id'];
		$get_top_name = $row_messages['user_account'];
		// $get_count_convo = $row_messages['convo_read']; 

	} 

	?>

	
	<div class="container" style="margin-top: 96px;"> 
		<div class="row">  
			<div class="col-md-4" style="margin-top: -18px;">
				<center><h3><kbd>Customer List</kbd></h3></center>
				<div class="panel panel-default-messages" style="border-radius: 0px;border:1px solid grey;height:345px;padding-top: 0px;padding-bottom: 3px;">
					
                    <div class="panel-body" style="overflow: auto !important;height: 340px;">
                    	<ul class="chat">
	                    	<?php
	                    	$query_latest = mysqli_query($sql, "SELECT * FROM users_convo_date ucd, users usr where ucd.user_id = usr.id ORDER BY ucd.latest_convo_date DESC"); 
							while($row_messages = mysqli_fetch_array($query_latest)){
								$get_convo_latest_convo_date = $row_messages['latest_convo_date'];
								$get_convo_user_account = $row_messages['user_account'];
								$get_convo_user_id = $row_messages['user_id']; 
	 							
	 							$get_convo_latest_convo_date = date("M. d, Y g:i:A", strtotime($get_convo_latest_convo_date));
								?>
									<li class="left clearfix">
									<a href="messages.php?id_convo=<?php echo $get_convo_user_id; ?>&&user_name=<?php echo $get_convo_user_account; ?>">
										<span class="chat-img pull-left" style="width: 16%;">
								            <img src="images/users/user-2.png" alt="User Avatar" class="img-circle" style="width: 100%;height: auto;" />
								        </span>
							            <div class="chat-body clearfix">
							                <div class="header">
							                    <strong class="primary-font" style="color: hsl(0, 0%, 15%);"><?php echo $get_convo_user_account; ?></strong> - <span class="glyphicon glyphicon-time" style="color: #f4511e;"></span><label style="color: hsl(0, 0%, 36%);"><?php echo $get_convo_latest_convo_date; ?>
							                    </label>
							                </div>
							                <p>
							                </p>
							            </div>
							        </a>
							        </li>
								<?php
							}

	                    	?>

	                    </ul>
                    </div>
                </div>
                <br><br>
			</div>
	        <div class="col-md-8" style="margin-top: -18px;">
	        	<center><h3><kbd>Customer Conversation</kbd></h3></center>
	            <div class="panel panel-default-messages" style="border-top:2px solid #f4511e;border:1px solid grey;border-radius: 0px;">
	                <div class="panel-heading" id="accordion" style="background-color: hsl(0, 0%, 94%);">
	                    <span class="glyphicon glyphicon-comment"></span> 
	                    <span id="userChatName"><?php echo $get_top_name; ?></span>
	                    <span class="badge" id="idCountConvo"></span>
	                    <div class="btn-group pull-right"><!-- 
	                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
	                            <span class="glyphicon glyphicon-chevron-up"></span>
	                        </a> -->
	                    </div>
	                </div>
	                <div class="panel-collapse" id="collapseOne">
	                    <div class="panel-body" id="scrollNow">
	                    	<input type="hidden" id="idConvo" value="<?php echo $get_top_id; ?>">
	                        <ul class="chat convertationNow">
	                            
	                        </ul>
	                    </div>
	                    <div class="panel-footer">
	                        <div class="input-group">
	                            <input id="btn-input-message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
	                            <span class="input-group-btn">
	                                <button class="btn btn-default btn-sm" id="btn-message">
	                                    Send</button>
	                            </span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
		</div>
	</div>
	<br><br>
	<?php
	include 'footer.php'
	?>

	<script>
	setInterval(function(){ getConvo(); }, 5000);

	function getConvo()
	{
	  var idconvo = document.getElementById('idConvo').value; 
	  $.ajax({
	    url: 'getconvo.php',
	    type: 'post',
	    data: {idconvo:idconvo},
	    success: function(data) {
	      $('.convertationNow').html(data);
	    }
	  }); 
	}
	</script>
	<script>
		$(document).ready(function(){
			$('#btn-message').click(function(){
				var convo = $('#btn-input-message').val();
				var idconvo = $('#idConvo').val();
				$.ajax({
				    url: 'sendconvo.php',
				    type: 'post',
				    data: {convo:convo,idconvo:idconvo},
				    success: function(data) {
				    	var newVal = "";
				    	$('#btn-input-message').val(newVal);
				    }
				});
			}); 
		});
	</script>
	</body>
</html>

