<?php
include './db/db.php';
// Temp placeholder
$username="RE10003";

$sql="SELECT * FROM `restaurant_details` WHERE RO_username='$username';";
$result = mysqli_query($con, $sql) or die (mysqli_error());
$row = mysqli_fetch_array($result);

$id = $row['rd_ID'];
$rdName = $row['rdName'];
$rdLocation = $row['rdLocation'];
$rdOpTime = $row['rdOpTime'];
$rdContactNo = $row['rdContactNo'];
$cuisinesType = $row['cuisinesType'];
$varietyType = $row['varietyType'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody</title>
    <link rel="icon" href="./resources/favicon.png">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <header class="wrapper">
        <img src="resources/umplogo.png" alt="UMP" width="5%">
        <img src="resources/foodylogo.png" alt="Foody" width="5%">
        <nav>
            <a href="ro_menuList.php">Menu List</a>
            <a href="ro_restaurantDetails">Restaurant Details</a>
            <a href="ro_orderList.php">Order List</a>
            <a href="#">Restaurant Report</a>
            <a href="#">Logout</a>
        </nav>
        <img src="resources/profile.jpg" alt="profile" width="5%">
        <br>
        <h3 class="center-text">Off Oven, On Doorstep</h3>
    </header>

    <div class="wrapper">
        <br>
        <h3 style="text-align: center;">Manage Restaurant Details</h3>
        <br>
        <br>
        <form action="./db/updatedb.php?id=<?php echo $id ?>&action=rDetails" method="post">
            <div class="con-table">
            <table class="table-border">
                <tr>
                    <td class="t-border th">Name</td>
                    <td class="t-border col-20"><input type="text" name="rdName" size="23px" value="<?php echo $rdName ?>"></td>
                </tr>
                <tr>
                    <td class="t-border th">Address</td>
                    <td class="t-border col-20"><textarea name="rdLocation" cols="25" rows="5"><?php echo $rdLocation ?></textarea></td>
                </tr>
                <tr>
                    <td class="t-border th">Operating Time</td>
                    <td class="t-border col-20"><input type="text" name="rdOpTime" size="23px" value="<?php echo $rdOpTime ?>"></td>
                </tr>
                <tr>
                    <td class="t-border th">Contact No</td>
                    <td class="t-border col-20"><input type="tel" name="rdContactNo" size="23px" value="<?php echo $rdContactNo ?>"></td>
                </tr>
                <tr>
                    <td class="t-border th">Cuisine Type</td>
                    <td class="t-border col-20"><select name="cuisinesType" style="width: 200px;">
                        <option <?=strpos($cuisinesType, "Rice Noodles") !== false?'selected="selected"':'';?> value="Rice Noodles">Rice Noodles</option>
                        <option <?=strpos($cuisinesType, "Malaysian Food") !== false?'selected="selected"':'';?> value="Malaysian Food">Malaysian Food</option>
                        <option <?=strpos($cuisinesType, "Western") !== false?'selected="selected"':'';?> value="Western">Western</option>
                        <option <?=strpos($cuisinesType, "Thai") !== false?'selected="selected"':'';?> value="Thai">Thai</option>
                        <option <?=strpos($cuisinesType, "Beverages") !== false?'selected="selected"':'';?> value="Beverages">Beverages</option>
                        <option <?=strpos($cuisinesType, "Fast Food") !== false?'selected="selected"':'';?> value="Fast Food">Fast Food</option>
                    </select></td>
                </tr>
                <tr>
                    <td class="t-border th">Variety Type</td>
                    <td class="t-border col-20"><select name="varietyType" style="width: 200px;">
                        <option <?=strpos($varietyType, "Halal") !== false?'selected="selected"':'';?> value="Halal">Halal</option>
                        <option <?=strpos($varietyType, "Non-Halal") !== false?'selected="selected"':'';?> value="Non-Halal">Non-Halal</option>
                    </select></td>
                </tr>
            </table>
        </div>
        <br>
            <input type="submit" value="Update" class="btn" style="left: 50%;">
        </form>
    </div>

    <footer class="wrapper">
        <div>
            <p style="font-size: 20px;"> <b>About Foody</b> </p>
            <div>
                <a href="#" class="fa fa-facebook fa-lg"></a>
                <a href="#" class="fa fa-instagram fa-lg"></a>
            </div>
        </div>
        <br><i class="material-icons">location_on</i>
        <p> Universiti Malaysia Pahang 26600 Pekan Pahang, Malaysia. </p>
        <br><i class="material-icons">local_phone</i>
        <p> +609 431 5000 </p>
        <br><i class="material-icons">email</i>
        <p>pro@ump.edu.my </p>
    </footer>
</body>
</html>