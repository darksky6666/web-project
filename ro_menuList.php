<?php 
include './db/db.php'; 
$sql="SELECT menu.menu_ID, menu.foodName, menu.foodPhoto, menu.foodDesc, menu.foodAvailability, fc.categoryName, fc.categoryPrice, menu.RO_username FROM `menu_list` `menu`, `food_categories` `fc` WHERE menu.fc_ID = fc.fc_ID ORDER BY menu.menu_ID;";
$result=mysqli_query($con,$sql) or die (mysqli_error());
$rowcount=mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody</title>
    <script src="js/menu.js"></script>
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

    <div class="menu wrapper">
        <h3 class="center-text">Menu List</h3>
        <br>
        <div>
            Filter: <input type='button' class='btn' value='All' onclick="filterCat(this.value)">
            <?php 
            $sql2 = "SELECT * FROM `food_categories` ORDER BY `categoryName`;";
            $result2=mysqli_query($con,$sql2) or die (mysqli_error());
            while ($row2=mysqli_fetch_assoc($result2)) {
                $fCat = $row2['categoryName'];
                echo("<input type='button' class='btn' value='$fCat' onclick='filterCat(this.value)'>");
            }
            ?>
        </div>
        <div class="search-container">
            <form action="ro_searchMenu.php" method="post">
                <input type="text" placeholder="Search Food Name..." name="search" id="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <br>
        <br>
        <?php
        if ($rowcount<10) {
            echo("<h4 class='error'>At least 10 food items are required. (" . $rowcount . "/10)". "</h4>");
        }
        if($rowcount>0){
            while ($row=mysqli_fetch_assoc($result)) {
            $id=$row['menu_ID'];
            $foodName=$row['foodName'];
            $foodPhoto=$row['foodPhoto'];
            $foodDesc=$row['foodDesc'];
            $foodAvailability=$row['foodAvailability'];
            $categoryName=$row['categoryName'];
            $fPrice=$row['categoryPrice'];
            ?>
            <div>
            <table>
                <span class="fCat" style="display: none;"><?php echo $categoryName ?></span>
                <tr>
                    <td rowspan=2 class="td-1">
                        <img src="./resources/menu/<?php echo $foodPhoto; ?>" alt="<?php echo $foodName; ?>">
                    </td>
                    <td class="td-2">
                        <?php echo $foodName; ?>
                    </td>
                    <td class="td-3">
                        <?php echo $foodAvailability; ?>
                    </td>
                    <td rowspan=2 class="td-3">
                        <a href='ro_editMenuList.php?id=<?php echo $id ?>'>Edit</a> &nbsp <a href='./db/deletedb.php?id=<?php echo $id ?>&foodPhoto=<?php echo $foodPhoto ?>'>Delete</a>
                    </td>
                </tr>
                <tr>
                    <td class="td-2">
                        <?php echo $foodDesc; ?>
                    </td>
                    <td class="td-3">
                        <?php printf("RM %.2f", $fPrice); ?>
                    </td>
                </tr>
                <br>
            </table>
            </div>
        <?php
            }
        }
        else {
            echo "No data found";
        }
        ?>
        <br>
        <input type="button" class="btn" value="Add Menu" style="float: right" onclick="window.location.href = './ro_addMenuList.php';">
        <br>
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