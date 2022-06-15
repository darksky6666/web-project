<!-- delete.php -->
<!-- To delete one particular data. -->

<?php

include ("../db/db.php");

$id = $_GET['id'];

echo "<script src='../js/user.js'></script>";
echo "<script type = 'text/javascript'> deleteConfirmBox() </script>";

$query = "DELETE FROM user WHERE `user_id` = '$id'";
$result = mysqli_query($conn,$query) or die ("Could not execute query in updateProfile.php");

if($result){
echo "<script type= 'text/javascript'> window.location='userList.php'</script>";
}
?>