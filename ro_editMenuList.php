<?php
include './db/db.php';
$id = $_GET['id'];
$sql="SELECT menu.menu_ID, menu.foodName, menu.foodPhoto, menu.foodDesc, menu.foodAvailability, menu.fc_ID, fc.categoryPrice, fc.categoryName, menu.RO_username FROM `menu_list` `menu`, `food_categories` `fc` WHERE menu.menu_ID=$id AND menu.fc_ID = fc.fc_ID ORDER BY menu.menu_ID;";
$result = mysqli_query($con, $sql) or die (mysqli_error());
$row = mysqli_fetch_array($result);

$foodName = $row['foodName'];
$foodPhoto = $row['foodPhoto'];
$foodDesc = $row['foodDesc'];
$foodAvail = $row['foodAvailability'];
$foodCat = $row['fc_ID'];
$fcName=$row['categoryName'];
$cPrice = $row['categoryPrice'];

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
    <link rel="stylesheet" href="css/header_footer.css">
    <script src="./js/menu.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <header class="wrapper">
        <img src="resources/umplogo.png" alt="UMP" width="5%">
        <img src="resources/foodylogo.png" alt="Foody" width="5%">
        <nav>
            <a href="ro_menuList.php">Menu List</a>
            <a href="ro_restaurantDetails.php">Restaurant Details</a>
            <a href="ro_orderList.php">Order List</a>
            <a href="#">Restaurant Report</a>
            <a href="#">Logout</a>
        </nav>
        <img src="resources/profile.jpg" alt="profile" width="5%">
        <br>
        <h3 class="center-text">Off Oven, On Doorstep</h3>
    </header>

    <div class="wrapper container">
        <div class="item1">
        <h3>Update menu</h3>
        <br>
        <form action="./db/updatedb.php?id=<?php echo $id; ?>&action=menu" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td style="width: 10%;">Food Photo</td>
                    <td>
                        <img id="image" style="padding-right: 10px;" src="./resources/menu/<?php echo $foodPhoto; ?>" alt="<?php echo $foodName; ?>">
                        <br>
                        <br>
                        <input type="file" name="foodPhoto" id="foodPhoto" onchange="previewImg(this)">
                    </td>
                </tr>
                <tr>
                    <td>Food Name</td>
                    <td><input type="text" name="foodName" value="<?php echo $foodName ?>"></td>
                </tr>
                <tr>
                    <td>Food Description</td>
                    <td><textarea name="foodDesc" cols="40" rows="5"><?php echo $foodDesc ?></textarea></td>
                </tr>
                <tr>
                    <td>Food Availability</td>
                    <td>
                        <select name="foodAvail">
                            <option <?=strpos($foodAvail, "Available") !== false?'selected="selected"':'';?> value="Available">Available</option>
                            <option <?=strpos($foodAvail, "Not Available") !== false?'selected="selected"':'';?>value="Not Available">Not Available</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Food Category</td>
                    <td>
                        <select name="foodCat">
                            <option <?=strpos($foodCat, "0") !== false?'selected="selected"':'';?> value="">Select Category</option>
                            <option <?=strpos($foodCat, "6") !== false?'selected="selected"':'';?> value="6">Beverages</option>
                            <option <?=strpos($foodCat, "1") !== false?'selected="selected"':'';?> value="1">Chicken</option>
                            <option <?=strpos($foodCat, "4") !== false?'selected="selected"':'';?> value="4">Dessert</option>
                            <option <?=strpos($foodCat, "2") !== false?'selected="selected"':'';?> value="2">Noodles</option>
                            <option <?=strpos($foodCat, "5") !== false?'selected="selected"':'';?> value="5">Rice</option>
                            <option <?=strpos($foodCat, "3") !== false?'selected="selected"':'';?> value="3">Soup</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <div>
                <!-- Send oldPhoto name -->
                <input type="hidden" name="oldPhoto" value="<?php echo $foodPhoto ?>">
                <input type="submit" value="Submit">
            </div>
        </form>
        </div>

        <div class="item2">
            <h3>Category Price for <?php echo "$fcName" ?></h3>
            <br>
            <form action="./db/updatedb.php?foodCat=<?php echo $foodCat; ?>&action=category" method="POST" enctype="multipart/form-data">
            <label for="catPrice-input">RM<input type="number" name="cPrice" id="catPrice-input" step="0.01" value="<?php printf("%.2f", $cPrice) ?>"></label>
            <input type="submit" value="Update" class="btn">
            </form>
        </div>

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