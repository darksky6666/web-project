<?php
include ("../db/db.php");
 
extract ($_POST);
$idURL = $_GET['id'];

date_default_timezone_set("Asia/Kuala_Lumpur");
echo date('d-m-Y H:i:s');

$fDate = date("Y-m-d", time());
$fTime = date("H:i:s", time());

$query = "UPDATE feedback SET `fDesc` = '$fDesc', `fDate` = '$fDate', `fTime` = '$fTime' WHERE order_ID = '$idURL'";

$result = mysqli_query($conn,$query) or die ("Could not execute query in viewComplaint.php");
if($result){
 echo "<script type='text/javascript'> window.location='updateComplaintStatus.php?id=" . $idURL . "' </script>";;
}
?>