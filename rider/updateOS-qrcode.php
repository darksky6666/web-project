<?php
include '../db/db.php';
$orderStatus=$_GET['orderStatus'] ?? '';
$idURL=$_GET['id'] ?? '';
extract($_POST);

$sql="UPDATE `order_list` SET `orderStatus`='$orderStatus' WHERE `order_ID`=$idURL;";
$result=mysqli_query($conn,$sql) or die(mysqli_error());

$successMsg="Order Status Changed to $orderStatus";
$failMsg="Failed to Update Order Status";
$result = mysqli_query($conn,$sql) or die(mysqli_error());
if($result){
    echo "<script type = 'text/javascript'> alert('$successMsg'); </script>";
    echo "<script type = 'text/javascript'> window.location='../index.php?order_ID=$id' </script>";
}
else {
    echo "<script type = 'text/javascript'> alert('$failMsg'); </script>";
    echo "<script type = 'text/javascript'> window.location='../index.php?order_ID=$id' </script>";
}

mysqli_close();
?>