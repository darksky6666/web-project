<?php
include ("../db/db.php");

//extract ($_POST);
$order_ID = $_GET['order_ID'];

$query = "UPDATE order_details SET order_ID = '$order_ID' WHERE order_ID IS NULL";

$result = mysqli_query($conn,$query) or die ("Could not execute query in orderList.php");
if($result){
 echo "<script type='text/javascript'> window.location='orderDetail.php?order_ID=" . $order_ID . "' </script>";
}
?>