<?php

include ("../db/db.php");

// $idURL = $_GET['id'];
extract($_POST);

$query = "DELETE FROM feedback WHERE order_ID = '$id'";
$result = mysqli_query($conn,$query) or die ("Could not execute query in updateComplaintStatus.php");

if($result){
    echo "<script type= 'text/javascript'> alert('Deleted successfully'); </script>";
    echo "<script type = 'text/javascript'> window.location='../rider/viewComplaint.php?id=$id' </script>";
}
else {
    echo "<script type= 'text/javascript'> alert('Failed to delete'); </script>";
}
?>