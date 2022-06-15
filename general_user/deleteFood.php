<?php

include ("../db/db.php");

$menu_ID = $_GET['menu_ID'];
$rdName = $_GET['rName'];

// Delete confirmation
echo "<script src='../js/menu.js'></script>";
echo "<script type = 'text/javascript'> deleteConfirmBox() </script>";

$query = "DELETE FROM order_details WHERE menu_ID = '$menu_ID'";
$result = mysqli_query($conn,$query) or die ("Could not execute query in displayFood.php");

if($result){
echo "<script type='text/javascript'> window.location='displayFood.php?rdName=" . $rdName . "' </script>";
}
?>
