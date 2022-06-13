<?php
include 'db.php';
$status=$_GET['status'] ?? '';
$id=$_GET['id'] ?? '';
extract($_POST);

$sql="UPDATE `order_list` SET `orderStatus`='$status' WHERE `orderID`=$id;";
$result=mysqli_query($con,$sql) or die(mysqli_error());

$successMsg="Order Status Changed to $status";
$failMsg="Failed to Update Order Status";
$result = mysqli_query($con,$sql) or die(mysqli_error());
if($result){
    echo "<script type = 'text/javascript'> alert('$successMsg'); </script>";
    echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_orderDetails.php?orderID=$id' </script>";
}
else {
    echo "<script type = 'text/javascript'> alert('$failMsg'); </script>";
    echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_orderDetails.php?orderID=$id' </script>";
}

mysqli_close();
?>