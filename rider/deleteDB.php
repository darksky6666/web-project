<?php

include ("../db/db.php");

$idURL = $_GET['id'];
//Delete Confirmation
echo "<script src='../js/menu.js'></script>";
echo "<script type = 'text/javascript'> deleteConfirmBox() </script>";

$query = "DELETE FROM feedback WHERE order_ID = '$idURL'";
$result = mysqli_query($conn,$query) or die ("Could not execute query in updateComplaintStatus.php");

if($result){
echo "<script type= 'text/javascript'> window.location='deliveryRecord.php'</script>";
}
?>yu