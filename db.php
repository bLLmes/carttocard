<?php

$sql = @mysqli_connect('localhost','root','','carttocard');

if(!$sql){
	echo "Error:". mysqli_connect_error();
} 
?>