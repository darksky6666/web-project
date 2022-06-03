<?php
include 'db.php';
$id = $_GET['id'];
$foodPhoto = $_GET['foodPhoto'];

// Delete confirmation
echo "<script src='../js/menu.js'></script>";
echo "<script type = 'text/javascript'> deleteConfirmBox() </script>";

$sql = "DELETE FROM `menu_list` WHERE `menu_ID`='$id'";

$result = mysqli_query($con,$sql) or die(mysqli_error());
$successMsg="Deleted Successfully";
$failMsg="Failed to Delete";
$loc="../resources/menu/$foodPhoto";

if($result){
    // Delete the photo when sql query is successful
    if (is_file($loc)) {
        // If Linux user, please uncomment the line below
        // chmod($loc, 0777);
        unlink(realpath($loc));
    }
    echo "<script type = 'text/javascript'> alert('$successMsg') </script>";
    echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
}
else {
    echo "<script type = 'text/javascript'> alert('$failMsg') </script>";
    echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
}
mysqli_close();
?>