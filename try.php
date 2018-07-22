<?php
include 'db.php';
session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Try Email</title>
  <style>

  </style>
</head>
<body>
<!-- renzpelegrino@yahoo.com -->
  <h1>TRY SEND EMAIL</h1>
  <form method="post" action="sent_email.php">
  Email: <input name="email" id="email" type="text" /><br />

  Message:<br />
  <textarea name="message" id="message" rows="15" cols="40"></textarea><br />

  <input type="submit" value="Submit" name="submit" />
</form>
</div>
<?php

echo $product_sale = 10000;
echo $product_sale_price = 66 / 100;
echo $sale = $product_sale * $product_sale_price;
// $arr1 = str_split($sale, 2); 
echo "<br><br>";
$a = 5;
if($a > 4){
  echo "lesser than";
}                            
echo "<br>";
date_default_timezone_set('Asia/Manila');
echo $get_convo_date_now = date('Y-m-d');
$convo_date_now = date("Y-m-d", strtotime($get_convo_date_now));
$convo_time_now = date("G:i:s", strtotime($get_convo_date_now));

$array = explode(':', $convo_time_now);

echo $array[0]. '<br>';
echo $array[1]. '<br>';
echo $array[2]. '<br>';
date_default_timezone_set('Asia/Manila');
      $get_convo_date_now = date('Y-m-d G:i:s');
      $get_convo_date_now1_strtotime = date('Y-m-d');
      $convo_date_now1 = strtotime($get_convo_date_now1_strtotime);
      echo $convo_date_now = date("Y-m-d", strtotime($get_convo_date_now));
      echo $convo_time_now = date("G:i:s", strtotime($get_convo_date_now));
// $str1 = $arr1[0];
// $str2 = $arr1[1];
// echo $sale
?>


</body>
</html>