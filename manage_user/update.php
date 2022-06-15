<!--update.php-->
<!--To update data of updateProfile.php into database.-->

<?php
include ("../db/db.php");

extract ($_POST);

$query = "UPDATE user SET username = '$Uname', `password` = '$Pass', `name` = '$Name', `address` = '$Add', phoneNum = '$PhoneNum', emailAdd = '$EmailAdd', userType = '$Utype' WHERE `user_id` = '$id'";

$result = mysqli_query($conn,$query) or die ("Could not execute query in updateProfile.php");
if($result){
 echo "<script type = 'text/javascript'> window.location='userList.php' </script>";
}
?>