<?php
include 'db.php';
extract($_POST);
$id = $_GET['id'];

if (isset($_FILES['foodPhoto']['name'])) {
    $image=$_FILES['foodPhoto']['name'];
    $imageName=$id . str_replace(" ", "-", strtolower("$foodName")). ".png";
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
    $imageName="$foodPhoto";
}

$sql = "UPDATE `menu_list` SET `foodName`='$foodName',`foodPhoto`='$imageName',`foodDesc`='$foodDesc',`foodAvailability`='$foodAvail',`fc_ID`='$foodCat' WHERE `menu_ID`=$id";
$successMsg="Updated Successfully";
$failMsg="Failed to Update";
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