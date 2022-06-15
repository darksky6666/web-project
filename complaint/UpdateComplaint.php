<?php
include '../db/db.php';
extract($_POST);

//$order_ID = $_GET['order_ID'];
$complaintID = $_GET['complaintID'];

$query = "UPDATE complaint_list SET complaintType='$complaintType',complaintDesc='$complaintDesc'
        WHERE complaint_ID='$complaintID'";

$result = mysqli_query($conn,$query) or die(mysqli_error());
if($result){
    echo "<script type = 'text/javascript'> window.location='../complaint/UserViewComplaint.php' </script>";
}
?>
