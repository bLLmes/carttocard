<?php

session_start();

unset($_SESSION['user_xxDisplayxx_user']);
unset($_SESSION['xxuser_id_userxx']);
unset($_SESSION['user_password']);
unset($_SESSION['user_email']);
unset($_SESSION['user_address']);
unset($_SESSION['user_phone']);
unset($_SESSION['cart_denied']);
unset($_SESSION['order_block_id']);
unset($_SESSION['cart_denied']);
unset($_SESSION['order_block_id']);
unset($_SESSION['user_status']);

echo "<script> window.location = 'login.php'; </script>";

?>