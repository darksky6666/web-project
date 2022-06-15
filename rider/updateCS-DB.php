<?php
include ("../db/db.php");

extract ($_POST);
$idURL = $_GET['id'];

$query = "UPDATE complaint_list SET complaintStatus = 'Resolved' WHERE order_ID = '$idURL'";

$result = mysqli_query($conn,$query) or die ("Could not execute query in updateComplaintStatus.php");
if($result){
 echo "<script type='text/javascript'> window.location='updatedCS2.php?id=" . $idURL . "' </script>";
}
?>