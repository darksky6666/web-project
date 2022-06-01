<?php
include 'db.php';
extract($_POST);

$action = $_GET['action'];

switch ($action) {
    // Update Food Category
    case 'category':
        $foodCat = $_GET['foodCat'];
        $sql2=sprintf("UPDATE `food_categories` SET `categoryPrice`='%s' WHERE `fc_ID`='$foodCat';",
                        mysqli_real_escape_string($con,$cPrice) );
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
    
    // Update restaurant details 
    case 'rDetails':
        $id=$_GET['id'];
        // Prevent SQL Injection
        $sql=sprintf("UPDATE `restaurant_details` SET `rdName`='%s',`rdLocation`='%s',`rdOpTime`='%s',`rdContactNo`='%s',`cuisinesType`='%s',`varietyType`='%s' WHERE `rd_ID`='$id';", 
                    mysqli_real_escape_string($con,$rdName),
                    mysqli_real_escape_string($con,$rdLocation),
                    mysqli_real_escape_string($con,$rdOpTime),
                    mysqli_real_escape_string($con,$rdContactNo),
                    mysqli_real_escape_string($con,$cuisinesType),
                    mysqli_real_escape_string($con,$varietyType) );
        $result=mysqli_query($con,$sql) or die(mysqli_error());

        if($result){
            echo "<script type = 'text/javascript'> alert('Restaurant Details Updated Successfully') </script>";
            echo "<script type = 'text/javascript'> window.location='../ro_restaurantDetails.php' </script>";
        }
        else {
            echo "<script type = 'text/javascript'> alert('Failed to Update Restaurant Details') </script>";
            echo "<script type = 'text/javascript'> window.location='../ro_restaurantDetails.php' </script>";
        }
        break;

    // Update Menu List
    default:
        // Delete the old photo
        $loc="../resources/menu/$oldPhoto";
        if (is_file($loc)) {
            // If Linux user, please uncomment the line below
            // chmod($loc, 0777);
            unlink(realpath($loc));
        }
        $id = $_GET['id'];
        print_r($_FILES['foodPhoto']['name']);
        if (isset( $_FILES['foodPhoto']['name'] ) && $_FILES['foodPhoto']['name'] != '' ) {
            $imageName=$id . str_replace(" ", "-", strtolower("$foodName")). ".png";
            $sourcePath=$_FILES['foodPhoto']['tmp_name'];
            $targetPath="../resources/menu/".$imageName;
            $upload=move_uploaded_file($sourcePath,$targetPath);
            $sql = sprintf("UPDATE `menu_list` SET `foodName`='%s',`foodPhoto`='%s',`foodDesc`='%s',`foodAvailability`='%s',`fc_ID`='%s' WHERE `menu_ID`=$id", 
                            mysqli_real_escape_string($con,$foodName),
                            mysqli_real_escape_string($con,$imageName),
                            mysqli_real_escape_string($con,$foodDesc),
                            mysqli_real_escape_string($con,$foodAvail),
                            mysqli_real_escape_string($con,$foodCat) );
        } 
        else {
            $sql = sprintf("UPDATE `menu_list` SET `foodName`='%s',`foodDesc`='%s',`foodAvailability`='%s',`fc_ID`='%s' WHERE `menu_ID`=$id", 
                            mysqli_real_escape_string($con,$foodName),
                            mysqli_real_escape_string($con,$foodDesc),
                            mysqli_real_escape_string($con,$foodAvail),
                            mysqli_real_escape_string($con,$foodCat) );
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
mysqli_close();
?>