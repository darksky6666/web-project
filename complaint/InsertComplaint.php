<?php
include("../db/db.php");

$order_ID = $_GET['order_ID'];

extract($_POST);

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date("Y-m-d", time());
$time = date("H:i:s", time());
$complaintStatus="IN INVESTIGATION";

$query = "INSERT INTO complaint_list(order_ID, complaintType, complaintDesc, complaintDate, complaintTime, complaintStatus) 
        VALUES ('$order_ID','$complaintType','$complaintDesc', '$date', '$time', '$complaintStatus')";

$result = mysqli_query($conn,$query) or die(mysqli_error());
if($result){
    echo "<script type = 'text/javascript'> window.location='../complaint/UserViewComplaint.php' </script>";
    echo "<script type = 'text/javascript'> window.location='../complaint/IndexAdminViewComplaint.php' </script>";
}
?>