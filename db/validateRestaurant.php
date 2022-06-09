<?php
$sqlValidate="SELECT `rdName` FROM `restaurant_details` WHERE `RO_username`='$RO_username';";
$resultValidate=mysqli_query($con,$sqlValidate) or die (mysqli_error());
$rowValidate=mysqli_fetch_assoc($resultValidate);

if ($rowValidate == 0) {
    echo "<script type = 'text/javascript'> alert('No Restaurant Details Found') </script>";
    echo "<script type = 'text/javascript'> window.location='../ro_restaurantDetails.php' </script>";
}

?>