<?php

include("../db/db.php");

extract ($_POST);

$order_ID = $_GET['order_ID'];


$query = "UPDATE order_list SET totalPayment = '$totalPayment', orderStatus = 'Ordered', delLocation = '$delLocation' WHERE order_ID = '$order_ID'";

if (mysqli_query($conn, $query)) {
      
   echo "<script type='text/javascript'> window.location='checkout.php?order_ID=" . $order_ID . "' </script>";
	
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>

