<!--logout.php-->
<!-- To logout user and redirect to indexLogin.php. -->

<?php 
session_start();
session_unset();
session_destroy();
header("Location: indexLogin.php");