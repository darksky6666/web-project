<?php
include 'db.php';
extract($_POST);

$action = $_GET['action'];

switch ($action) {
    case 'category':
        $sql="";
        $foodCat = $_GET['foodCat'];
        $sql2="UPDATE `food_categories` SET `categoryPrice`='$cPrice' WHERE `fc_ID`='$foodCat';";
        $successMsg2="Category Updated Successfully";
        $failMsg2="Failed to Update Category";
        $result2 = mysqli_query($con,$sql2) or die(mysqli_error());

        if($result2){
            echo "<script type = 'text/javascript'> alert('$successMsg2') </script>";
            echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
        }
        else {
            echo "<script type = 'text/javascript'> alert('$failMsg2') </script>";
            echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
        }
        break;

    default:
        $id = $_GET['id'];
        print_r($_FILES['foodPhoto']['name']);
        if (isset( $_FILES['foodPhoto']['name'] ) && $_FILES['foodPhoto']['name'] != '' ) {
            $image=$_FILES['foodPhoto']['name'];
            $imageName=$id . str_replace(" ", "-", strtolower("$foodName")). ".png";
            $sourcePath=$_FILES['foodPhoto']['tmp_name'];
            $targetPath="../resources/menu/".$imageName;
            $upload=move_uploaded_file($sourcePath,$targetPath);
            $sql = "UPDATE `menu_list` SET `foodName`='$foodName',`foodPhoto`='$imageName',`foodDesc`='$foodDesc',`foodAvailability`='$foodAvail',`fc_ID`='$foodCat' WHERE `menu_ID`=$id";
        } 
        else {
            $sql = "UPDATE `menu_list` SET `foodName`='$foodName',`foodDesc`='$foodDesc',`foodAvailability`='$foodAvail',`fc_ID`='$foodCat' WHERE `menu_ID`=$id";
        }

        $successMsg="Menu Updated Successfully";
        $failMsg="Failed to Update Menu";
        $result = mysqli_query($con,$sql) or die(mysqli_error());

        if($result){
            echo "<script type = 'text/javascript'> alert('$successMsg') </script>";
            echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
        }
        else {
            echo "<script type = 'text/javascript'> alert('$failMsg') </script>";
            echo "<script type = 'text/javascript'> window.location='../ro_menuList.php' </script>";
        }
}
?>