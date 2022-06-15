<?php
include ("../db/db.php");
 
extract ($_POST);
$idURL = $_GET['id'];

date_default_timezone_set("Asia/Kuala_Lumpur");

$fDate = date("Y-m-d", time());
$fTime = date("H:i:s", time());

$query = "INSERT INTO feedback (fDesc, fDate, fTime, order_ID) VALUES ('$fDesc', '$fDate', '$fTime', '$idURL')";

$result = mysqli_query($conn,$query) or die ("Could not execute query in viewComplaint.php");
if($result){
 echo "<script type='text/javascript'> window.location='updateComplaintStatus.php?id=" . $idURL . "' </script>";
}
?>