<?php
include ("../db/db.php");
 
extract ($_POST);
$idURL = $_GET['id'];

date_default_timezone_set("Asia/Kuala_Lumpur");

$timeDelivered = date("H:i:s", time());

$query = "INSERT INTO delivery (timeDelivered, order_ID) VALUES ('$timeDelivered', '$idURL')";

$result = mysqli_query($conn,$query) or die ("Could not execute query in deliveryRecord.php");
if($result){
 echo "<script type='text/javascript'> window.location='recordDetails.php?id=" . $idURL . "' </script>";
}
?>