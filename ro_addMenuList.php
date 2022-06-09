<?php
session_start();
$RO_username=$_SESSION['RO_username'];
// Set default display for img
$foodPhoto="no-image.png";
$testLoc="./resources/menu/$RO_username";

// Create dir for restaurant owner if not exist
if (!is_dir($testLoc)) {
    mkdir($testLoc, '0777', true);
    copy("./resources/menu/no-image.png", "./resources/menu/$RO_username/no-image.png");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody</title>
    <script src="./js/menu.js"></script>
    <link rel="icon" href="./resources/favicon.png">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/header_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <header class="wrapper">
        <img src="resources/umplogo.png" alt="UMP" width="5%">
        <img src="resources/foodylogo.png" alt="Foody" width="5%">
        <nav>
            <a href="ro_dashboard.php">Dashboard</a>
            <a class="active" href="ro_menuList.php">Menu List</a>
            <a href="ro_restaurantDetails.php">Restaurant Details</a>
            <a href="ro_orderList.php">Order List</a>
            <a href="ro_report.php">Restaurant Report</a>
            <a href="#">Logout</a>
        </nav>
        <img src="resources/profile.jpg" alt="profile" width="5%">
        <br>
        <h3 class="center-text">Off Oven, On Doorstep</h3>
    </header>

    <div class="wrapper">
        <h3>Add new menu</h3>
        <br>
        <form action="./db/insertdb.php" name="addForm" method="POST" enctype="multipart/form-data" onsubmit="return checkData()">
            <table>
                <tr>
                    <td style="width: 10%;">Food Photo</td>
                    <td>
                        <img id="image" style="padding-right: 10px;" src="./resources/menu/<?php echo $RO_username ?>/<?php echo $foodPhoto; ?>" alt="<?php echo $foodName; ?>">
                        <br>
                        <br>
                        <input type="file" name="foodPhoto" id="foodPhoto" accept="image/png, image/jpeg" onchange="previewImg(this)">
                        <span class="error" id="picErr"></span>
                    </td>
                </tr>
                <tr>
                    <td>Food Name</td>
                    <td>
                        <input type="text" name="foodName" value="" required>
                        <span class="error">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Food Description</td>
                    <td>
                        <textarea name="foodDesc" cols="40" rows="5" required></textarea>
                        <span class="error">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Food Availability</td>
                    <td>
                        <select name="foodAvail" required>
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                        <span class="error">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Food Category</td>
                    <td>
                        <select name="foodCat" required>
                            <option value="">Select Category</option>
                            <option value="6">Beverages</option>
                            <option value="1">Chicken</option>
                            <option value="4">Dessert</option>
                            <option value="2">Noodles</option>
                            <option value="5">Rice</option>
                            <option value="3">Soup</option>
                        </select>
                        <span class="error">*</span>
                    </td>
                </tr>
            </table>
            <br>
            <div>
                <input type="submit" value="Submit">
            </div>
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
        <span class="icon-text"> Universiti Malaysia Pahang 26600 Pekan Pahang, Malaysia. </span>
        <br><i class="material-icons">local_phone</i>
        <span class="icon-text"> +609 431 5000 </span>
        <br><i class="material-icons">email</i>
        <span class="icon-text"> pro@ump.edu.my </span>
    </footer>
</body>
</html>