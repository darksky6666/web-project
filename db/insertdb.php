<?php
include 'db.php';
extract($_POST);
$sql="SELECT * FROM `menu_list`";
$result=mysqli_query($con,$sql) or die (mysqli_error());
$rowcount=mysqli_num_rows($result);

if (isset($_FILES['foodPhoto']['name'])) {
    $image=$_FILES['foodPhoto']['name'];
    $imageName=++$rowcount . str_replace(" ", "-", strtolower("$foodName")). ".png";
    $sourcePath=$_FILES['foodPhoto']['tmp_name'];
    $targetPath="../resources/menu/".$imageName;
    $upload=move_uploaded_file($sourcePath,$targetPath);

    if ($upload==false) {
        echo "<script type = 'text/javascript'> alert('Upload failed') </script>";
        echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
        die();
    }
} 
else {
    $imageName="";
}

$sql = "INSERT INTO `menu_list`(`foodName`, `foodPhoto`, `foodDesc`, `foodAvailability`, `fc_ID`) VALUES ('$foodName','$imageName','$foodDesc','$foodAvail','$foodCat')";
$successMsg="Inserted Successfully";
$failMsg="Failed to Insert";
$result = mysqli_query($con,$sql) or die(mysqli_error());



if($result){
    echo "<script type = 'text/javascript'> alert('$successMsg') </script>";
    echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
}
else {
    echo "<script type = 'text/javascript'> alert('$failMsg') </script>";
    echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
}
?>