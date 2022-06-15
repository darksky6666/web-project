<?php
include("../db/db.php");
extract( $_POST );

$totalPrice = $categoryPrice * $orderQuantity;

$query = "INSERT INTO `order_details`(`totalPrice`, `menu_ID`, `orderQuantity`) VALUES ('$totalPrice', '$menu_ID', '$orderQuantity')";

if (mysqli_query($conn, $query)) {
    echo "<script type='text/javascript'> window.location='displayFood.php?rdName=" . $rdName . "' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>