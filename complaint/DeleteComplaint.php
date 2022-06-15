<?php
include '../db/db.php';
$id = $_GET['id'];

echo "<script src='../js/menu.js'></script>";
echo "<script type = 'text/javascript'> deleteConfirmBox() </script>";


$query = "DELETE FROM complaint_List WHERE complaint_ID ='$id'";

$result = mysqli_query($conn,$query) or die(mysqli_error());
if($result){
    echo "<script type = 'text/javascript'> window.location='../complaint/UserViewComplaint.php' </script>";
}
?>