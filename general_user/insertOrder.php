<?php

include("../db/db.php");

extract ($_POST);

$menu_ID = $_GET['menu_ID'];

date_default_timezone_set("Asia/Kuala_Lumpur");
$orderDate = date("Y-m-d", time());
$orderTime = date("H:i:s", time());
$orderStatus = "Incomplete";


$query = "INSERT INTO `order_list`(`orderDate`, `ordertime`, `orderStatus`) VALUES ('$orderDate', '$orderTime', '$orderStatus')";

if (mysqli_query($conn, $query)) {
      
   echo "<script type='text/javascript'> window.location='orderList.php?rdName=" . $rdName . "' </script>";
	
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}




?>