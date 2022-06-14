<?php
session_start();
$RO_username=$_SESSION['RO_username'];
include 'db.php';
extract($_POST);
$sql="SELECT * FROM `menu_list`";
$result=mysqli_query($conn,$sql) or die (mysqli_error());
$rowcount=mysqli_num_rows($result);

if (isset($_FILES['foodPhoto']['name']) && $_FILES['foodPhoto']['name'] != '') {
    $imageName=++$rowcount . "-" . str_replace(" ", "-", strtolower("$foodName")). ".png";
    $sourcePath=$_FILES['foodPhoto']['tmp_name'];
    $targetPath="../resources/menu/$RO_username/".$imageName;
    $upload=move_uploaded_file($sourcePath,$targetPath);

    if ($upload==false) {
        echo "<script type = 'text/javascript'> alert('Upload failed') </script>";
        echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_menuList.php' </script>";
        die();
    }
} 
else {
    $imageName="";
}

$resultrdID = mysqli_query($conn, "SELECT `rd_ID` FROM `res_details` WHERE `RO_username`='$RO_username'") or die(mysqli_error());
$rowrdID=mysqli_fetch_assoc($resultrdID);
$rd_ID = $rowrdID['rd_ID'];

$sql = sprintf("INSERT INTO `menu_list`(`foodName`, `foodPhoto`, `foodDesc`, `foodAvailability`, `fc_ID`, `rd_ID`) VALUES ('%s','%s','%s','%s','%s', '%s')", 
                mysqli_real_escape_string($conn,$foodName),
                mysqli_real_escape_string($conn,$imageName),
                mysqli_real_escape_string($conn,$foodDesc),
                mysqli_real_escape_string($conn,$foodAvail),
                mysqli_real_escape_string($conn,$foodCat),
                mysqli_real_escape_string($conn,$rd_ID));
$successMsg="Inserted Successfully";
$failMsg="Failed to Insert";
$result = mysqli_query($conn,$sql) or die(mysqli_error());



if($result){
    echo "<script type = 'text/javascript'> alert('$successMsg') </script>";
    echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_menuList.php' </script>";
}
else {
    echo "<script type = 'text/javascript'> alert('$failMsg') </script>";
    echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_menuList.php' </script>";
}
mysqli_close();
?>