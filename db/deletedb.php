<?php
include 'db.php';
$id = $_GET['id'];
$sql = "DELETE FROM `menu_list` WHERE `menu_ID`='$id'";

$result = mysqli_query($con,$sql) or die(mysqli_error());
$successMsg="Deleted Successfully";
$failMsg="Failed to Delete";
if($result){
    echo "<script type = 'text/javascript'> alert('$successMsg') </script>";
    echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
}
else {
    echo "<script type = 'text/javascript'> alert('$failMsg') </script>";
    echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
}
mysqli_close();
?>