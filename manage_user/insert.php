<!--insert.php-->
<!-- To insert data of createNewUser.php into database. -->
<?php

include("../db/db.php");
extract($_POST);

$query = "INSERT INTO user (username,`password`,`name`,`address`,region,phoneNum,emailAdd,userType) VALUES('$Uname','$Pass','$Name','$Add','$Reg','$PhoneNum','$EmailAdd','$Utype')";

if (mysqli_query($conn, $query)) {
      
   echo "<script type='text/javascript'> window.location='userList.php' </script>";
	
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>