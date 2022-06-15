<?php
session_start();
$RO_username=$_SESSION['RO_username'];
include 'db.php';
extract($_POST);

$action = $_GET['action'];
$sql="SELECT * FROM `res_details`;";
$result = mysqli_query($conn, $sql) or die (mysqli_error());
$rowcount = mysqli_num_rows($result);

switch ($action) {
    // Update Food Category
    case 'category':
        $foodCat = $_GET['foodCat'];
        $sql2=sprintf("UPDATE `food_categories` SET `categoryPrice`='%s' WHERE `fc_ID`='$foodCat';",
                        mysqli_real_escape_string($conn,$cPrice) );
        $successMsg2="Category Updated Successfully";
        $failMsg2="Failed to Update Category";
        $result2 = mysqli_query($conn,$sql2) or die(mysqli_error());

        if($result2){
            echo "<script type = 'text/javascript'> alert('$successMsg2') </script>";
            echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_menuList.php' </script>";
        }
        else {
            echo "<script type = 'text/javascript'> alert('$failMsg2') </script>";
            echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_menuList.php' </script>";
        }
        break;
    
    // Update restaurant details 
    case 'rDetails':
        $id=$_GET['id'];
        print_r($_FILES['rdPhoto']['name']);
        if (isset($rdPhoto) && $rdPhoto != '' ) {
            $sql=sprintf("UPDATE `res_details` SET `rdName`='%s',`rdLocation`='%s',`rdOpTime`='%s',`rdContactNo`='%s',`cuisinesType`='%s',`varietyType`='%s',`rdPhoto`='%s' WHERE `rd_ID`='$id';", 
                        mysqli_real_escape_string($conn,$rdName),
                        mysqli_real_escape_string($conn,$rdLocation),
                        mysqli_real_escape_string($conn,$rdOpTime),
                        mysqli_real_escape_string($conn,$rdContactNo),
                        mysqli_real_escape_string($conn,$cuisinesType),
                        mysqli_real_escape_string($conn,$varietyType),
                        mysqli_real_escape_string($conn,$rdPhoto));
        }
        else {
            $sql=sprintf("UPDATE `res_details` SET `rdName`='%s',`rdLocation`='%s',`rdOpTime`='%s',`rdContactNo`='%s',`cuisinesType`='%s',`varietyType`='%s' WHERE `rd_ID`='$id';", 
                    mysqli_real_escape_string($conn,$rdName),
                    mysqli_real_escape_string($conn,$rdLocation),
                    mysqli_real_escape_string($conn,$rdOpTime),
                    mysqli_real_escape_string($conn,$rdContactNo),
                    mysqli_real_escape_string($conn,$cuisinesType),
                    mysqli_real_escape_string($conn,$varietyType));
        }
        $result=mysqli_query($conn,$sql) or die(mysqli_error());
        if($result){
            echo "<script type = 'text/javascript'> alert('Restaurant Details Updated Successfully') </script>";
            echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_restaurantDetails.php' </script>";
        }
        else {
            echo "<script type = 'text/javascript'> alert('Failed to Update Restaurant Details') </script>";
            echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_restaurantDetails.php' </script>";
        }
        break;
    
    case 'rDetailsAdd':
        //Restaurant image file upload
        $sql=sprintf("INSERT INTO `res_details`(`rdName`, `rdLocation`, `rdOpTime`, `rdContactNo`, `cuisinesType`, `varietyType`, `rdPhoto`, `RO_username`) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s');", 
                    mysqli_real_escape_string($conn,$rdName),
                    mysqli_real_escape_string($conn,$rdLocation),
                    mysqli_real_escape_string($conn,$rdOpTime),
                    mysqli_real_escape_string($conn,$rdContactNo),
                    mysqli_real_escape_string($conn,$cuisinesType),
                    mysqli_real_escape_string($conn,$varietyType),
                    mysqli_real_escape_string($conn,$rdPhoto),
                    mysqli_real_escape_string($conn,$RO_username));
        $result=mysqli_query($conn,$sql) or die(mysqli_error());
        if($result){
            echo "<script type = 'text/javascript'> alert('Restaurant Details Updated Successfully') </script>";
            echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_restaurantDetails.php' </script>";
        }
        else {
            echo "<script type = 'text/javascript'> alert('Failed to Update Restaurant Details') </script>";
            echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_restaurantDetails.php' </script>";
        }
        break;

    // Update Menu List
    default:
        $id = $_GET['id'];
        print_r($_FILES['foodPhoto']['name']);
        if (isset($foodPhoto) && $foodPhoto != '' ) {
            // Delete the old photo
            $loc="../resources/menu/$RO_username/$oldPhoto";
            if (is_file($loc)) {
                chmod($loc, 0777);
                unlink(realpath($loc));
            }
            $sql = sprintf("UPDATE `menu_list` SET `foodName`='%s',`foodPhoto`='%s',`foodDesc`='%s',`foodAvailability`='%s',`fc_ID`='%s' WHERE `menu_ID`=$id", 
                            mysqli_real_escape_string($conn,$foodName),
                            mysqli_real_escape_string($conn,$foodPhoto),
                            mysqli_real_escape_string($conn,$foodDesc),
                            mysqli_real_escape_string($conn,$foodAvail),
                            mysqli_real_escape_string($conn,$foodCat) );
        } 
        else {
            $sql = sprintf("UPDATE `menu_list` SET `foodName`='%s',`foodDesc`='%s',`foodAvailability`='%s',`fc_ID`='%s' WHERE `menu_ID`=$id", 
                            mysqli_real_escape_string($conn,$foodName),
                            mysqli_real_escape_string($conn,$foodDesc),
                            mysqli_real_escape_string($conn,$foodAvail),
                            mysqli_real_escape_string($conn,$foodCat) );
        }

        $successMsg="Menu Updated Successfully";
        $failMsg="Failed to Update Menu";
        $result = mysqli_query($conn,$sql) or die(mysqli_error());

        if($result){
            echo "<script type = 'text/javascript'> alert('$successMsg') </script>";
            echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_menuList.php' </script>";
        }
        else {
            echo "<script type = 'text/javascript'> alert('$failMsg') </script>";
            echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_menuList.php' </script>";
        }
}
mysqli_close($conn);
?>