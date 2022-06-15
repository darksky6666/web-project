<!--logout.php-->
<!-- To logout user and redirect to indexLogin.php. -->
<?php 
include '../db/db.php';
mysqli_close($conn);
session_start();
session_unset();
session_destroy();
header("Location: indexLogin.php");
exit();
?>