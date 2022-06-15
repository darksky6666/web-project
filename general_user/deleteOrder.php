<?php

include ("../db/db.php");

$idURL = $_GET['order_ID'];

// Delete confirmation
echo "<script src='../js/menu.js'></script>";
echo "<script type = 'text/javascript'> deleteConfirmBox() </script>";

$query = "DELETE FROM order_list WHERE order_ID = '$idURL'";
$result = mysqli_query($conn,$query) or die ("Could not execute query in orderList.php");

if($result){
echo "<script type='text/javascript'> window.location='orderList.php?rdName=" . $rdName . "' </script>";
}
?>