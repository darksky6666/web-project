<?php
include ("../db/db.php");

extract ($_POST);
$idURL = $_GET['id'];

$query = "UPDATE order_list SET rider_username = 'RU10001' WHERE order_ID = '$idURL'";

$result = mysqli_query($conn,$query) or die ("Could not execute query in index.php");
if($result){
 echo "<script type='text/javascript'> window.location='acceptedOrder.php?id=" . $idURL . "' </script>";
}
?>