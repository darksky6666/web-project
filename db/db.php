<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "123456");

$conn = mysqli_connect(DBHOST, DBUSER, DBPASS);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_select_db($conn, "foody") or die(mysqli_error());

//mysqli_close();
?>