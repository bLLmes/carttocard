<?php

include 'db.php';
session_start();

$get_date_now = date("Y-m-d h:i:sa");
if(isset($_SESSION['user_xxDisplayxx_user'])){
	if(isset($_POST['idconvo'])){
			$id_convo = $_POST['idconvo'];
			$query_convo_messages = mysqli_query($sql, "SELECT * FROM users_conversation usc, users usr where usc.user_id = '$id_convo' and usc.user_id = usr.id");

				// mysqli_query($sql, "UPDATE users_convo_date set convo_read = convo_read + convo_read, convo_unread = 0 where user_id = '$id_convo'");

	    	while($row_convo = mysqli_fetch_array($query_convo_messages)){
				$get_user_conversation = $row_convo['user_conversation'];
				$get_convo_user_type = $row_convo['convo_user_type'];
				$get_convo_status = $row_convo['convo_status'];
				$get_convo_user_account = $row_convo['user_account'];

				$get_convo_date = $row_convo['convo_date'];
				$convo_date1 = strtotime($get_convo_date);
				$convo_date = date("Y-m-d", strtotime($get_convo_date));
				$convo_time = date("G:i:s", strtotime($get_convo_date));

				$array1 = explode(':', $convo_time);
				$hours = $array1[0];
				$mins = $array1[1];
				$secs = $array1[2];

				date_default_timezone_set('Asia/Manila');
				$get_convo_date_now = date('Y-m-d G:i:s');
				$get_convo_date_now1_strtotime = date('Y-m-d');
				$convo_date_now1 = strtotime($get_convo_date_now1_strtotime);
				$convo_date_now = date("Y-m-d", strtotime($get_convo_date_now));
				$convo_time_now = date("G:i:s", strtotime($get_convo_date_now));

				$ts1 = strtotime($convo_date_now);
				$ts2 = strtotime($convo_date);

				$diff_my_date = $convo_date_now1 - $convo_date1;
				$number_of_days = floor($diff_my_date / (60 * 60 * 24));

				$array2 = explode(':', $convo_time_now);
				$hours_now = $array2[0];
				$mins_now = $array2[1];
				$secs_now = $array2[2];

				$get_convo_datee = 0;
				$get_convo_date_final = "";
				if($convo_date == $convo_date_now){
					if($hours_now == $hours){
						if($mins_now == $mins){
							$get_convo_datee = $secs_now - $secs;
							if($get_convo_datee == 1){
								$get_convo_date_final = $get_convo_datee .' second ago';
							}
							else{
								$get_convo_date_final = $get_convo_datee .' seconds ago';
							}
						}
						else{
							$get_convo_datee = $mins_now - $mins;
							if($get_convo_datee == 1){
								$get_convo_date_final = $get_convo_datee .' minute ago';
							}
							else{
								$get_convo_date_final = $get_convo_datee .' minutes ago';
							}
						}
					}
					else{
						$get_convo_datee = $hours_now - $hours;
						if($get_convo_datee == 1){
							$get_convo_date_final = $get_convo_datee .' hour ago';
						}
						else{
							$get_convo_date_final = $get_convo_datee .' hours ago';
						}
					}
				}
				else{
					$get_convo_datee = $number_of_days + 1;
					if($get_convo_datee < 8){
						if($get_convo_datee == 1){
							$get_convo_date_final = $get_convo_datee .' day ago';
						}
						else{
							$get_convo_date_final = $get_convo_datee .' days ago';
						}
					}
					else{
						$get_convo_date_final = date("M. d, Y g:i:A", strtotime($get_convo_date));
					}
				}


	    	
	    		if($get_convo_user_type == 1){
					?>
					<li class="right clearfix">
						<span class="chat-img pull-right" style="width: 7%;">
				            <img src="images/users/user-1.png" alt="User Avatar" class="img-circle" style="width: 100%;height: auto;" />
				        </span>
			            <div class="chat-body clearfix">
			                <div class="header">
			                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?php echo $get_convo_date_final; ?></small>
			                    <strong class="pull-right primary-font">Admin</strong>
			                </div>
			                <p>
			                    <?php echo $get_user_conversation; ?>
			                </p>
			            </div>
			        </li> 
					<?php
				}
				else{
					?>
					<li class="left clearfix">
						<span class="chat-img pull-left" style="width: 7%;">
				            <img src="images/users/user-2.png" alt="User Avatar" class="img-circle" style="width: 100%;height: auto;" />
				        </span>
			            <div class="chat-body clearfix">
			                <div class="header">
			                    <strong class="primary-font"><?php echo $get_convo_user_account; ?></strong> <small class="pull-right text-muted">
			                        <span class="glyphicon glyphicon-time"></span><?php echo $get_convo_date_final; ?></small>
			                </div>
			                <p>
			                    <?php echo $get_user_conversation; ?>
			                </p>
			            </div>
			        </li>
					<?php
				}
			}
	}
	else{

		$where_id = $_SESSION['xxuser_id_userxx']; 
		$get_name = $_SESSION['user_xxDisplayxx_user'];

		$query_convo = mysqli_query($sql, "SELECT * FROM users_conversation where user_id = '$where_id'");

		while($row_convo = mysqli_fetch_array($query_convo)){
			$get_user_conversation = $row_convo['user_conversation'];
			$get_convo_user_type = $row_convo['convo_user_type'];
			$get_convo_status = $row_convo['convo_status'];

			$get_convo_date = $row_convo['convo_date'];
			$convo_date1 = strtotime($get_convo_date);
			$convo_date = date("Y-m-d", strtotime($get_convo_date));
			$convo_time = date("G:i:s", strtotime($get_convo_date));

			$array1 = explode(':', $convo_time);
			$hours = $array1[0];
			$mins = $array1[1];
			$secs = $array1[2];

			date_default_timezone_set('Asia/Manila');
			$get_convo_date_now = date('Y-m-d G:i:s');
			$get_convo_date_now1_strtotime = date('Y-m-d');
			$convo_date_now1 = strtotime($get_convo_date_now1_strtotime);
			$convo_date_now = date("Y-m-d", strtotime($get_convo_date_now));
			$convo_time_now = date("G:i:s", strtotime($get_convo_date_now));

			$ts1 = strtotime($convo_date_now);
			$ts2 = strtotime($convo_date);

			$diff_my_date = $convo_date_now1 - $convo_date1;
			$number_of_days = floor($diff_my_date / (60 * 60 * 24));

			$array2 = explode(':', $convo_time_now);
			$hours_now = $array2[0];
			$mins_now = $array2[1];
			$secs_now = $array2[2];

			$get_convo_datee = 0;
			$get_convo_date_final = "";
			if($convo_date == $convo_date_now){
				if($hours_now == $hours){
					if($mins_now == $mins){
						$get_convo_datee = $secs_now - $secs;
						if($get_convo_datee == 1){
							$get_convo_date_final = $get_convo_datee .' second ago';
						}
						else{
							$get_convo_date_final = $get_convo_datee .' seconds ago';
						}
					}
					else{
						$get_convo_datee = $mins_now - $mins;
						if($get_convo_datee == 1){
							$get_convo_date_final = $get_convo_datee .' minute ago';
						}
						else{
							$get_convo_date_final = $get_convo_datee .' minutes ago';
						}
					}
				}
				else{
					$get_convo_datee = $hours_now - $hours;
					if($get_convo_datee == 1){
						$get_convo_date_final = $get_convo_datee .' hour ago';
					}
					else{
						$get_convo_date_final = $get_convo_datee .' hours ago';
					}
				}
			}
			else{
				$get_convo_datee = $number_of_days + 1;
				if($get_convo_datee < 8){
					if($get_convo_datee == 1){
						$get_convo_date_final = $get_convo_datee .' day ago';
					}
					else{
						$get_convo_date_final = $get_convo_datee .' days ago';
					}
				}
				else{
					$get_convo_date_final = date("M. d, Y g:i:A", strtotime($get_convo_date));
				}
			}

			if($get_convo_user_type != 1){
				?>
				<li class="right clearfix">
					<span class="chat-img pull-right" style="width: 16%;">
			            <img src="images/users/user-2.png" alt="User Avatar" class="img-circle" style="width: 100%;height: auto;" />
			        </span>
		            <div class="chat-body clearfix">
		                <div class="header">
		                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?php echo $get_convo_date_final; ?></small>
		                    <strong class="pull-right primary-font"><?php echo $get_name; ?></strong>
		                </div>
		                <p>
		                    <?php echo $get_user_conversation; ?>
		                    <!-- <?php echo $convo_date; ?>
		                    <?php echo $convo_time; ?>
		                    <?php echo $convo_date_now; ?>
		                    <?php echo $convo_time_now; ?> -->
		                </p>
		            </div>
		        </li> 
				<?php
			}
			else{
				?>
				<li class="left clearfix">
					<span class="chat-img pull-left" style="width: 16%;">
			            <img src="images/users/user-1.png" alt="User Avatar" class="img-circle" style="width: 100%;height: auto;" />
			        </span>
		            <div class="chat-body clearfix">
		                <div class="header">
		                    <strong class="primary-font">Admin</strong> <small class="pull-right text-muted">
		                        <span class="glyphicon glyphicon-time"></span><?php echo $get_convo_date_final; ?></small>
		                </div>
		                <p>
		                    <?php echo $get_user_conversation; ?>
		                </p>
		            </div>
		        </li>
				<?php
			}
		}
	}
}
else{
	echo "<script> window.location = 'index.php' </script>";
}
?>