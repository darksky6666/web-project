<?php
$id = $_GET['orderID'];
$length = 5;

include './db/db.php';
$sql="SELECT ol.orderID, user.name, user.address, ol.orderDate, ol.orderTime, ol.orderStatus, ml.foodName, od.orderQuantity, fc.categoryPrice FROM `order_list` `ol`, `order_details` `od`, `user`, `menu_list` `ml`, `food_categories` `fc` WHERE user.username=ol.username AND ol.orderID=od.orderID AND od.menu_ID=ml.menu_ID AND ml.fc_ID=fc.fc_ID AND ol.orderID=$id;";
$result=mysqli_query($con,$sql) or die (mysqli_error());
$rowcount=mysqli_num_rows($result);
if ($rowcount==0) {
    echo("<script>alert('No order found!');</script>");
    echo("<script>history.back();</script>");
}
$row=mysqli_fetch_all($result, MYSQLI_ASSOC);
$name=$row[0]['name'];
$address=$row[0]['address'];
$orderDate=$row[0]['orderDate'];
$orderTime=$row[0]['orderTime'];
$orderStatus=$row[0]['orderStatus'];
$totalPrice=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody</title>
    <link rel="icon" href="./resources/favicon.png">
    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="css/header_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="./js/qr.js"></script>
</head>

<body>
    <header class="wrapper">
        <img src="resources/umplogo.png" alt="UMP" width="5%">
        <img src="resources/foodylogo.png" alt="Foody" width="5%">
        <nav>
            <a href="ro_dashboard.php">Dashboard</a>
            <a href="ro_menuList.php">Menu List</a>
            <a href="ro_restaurantDetails.php">Restaurant Details</a>
            <a class="active" href="ro_orderList.php">Order List</a>
            <a href="ro_report.php">Restaurant Report</a>
            <a href="#">Logout</a>
        </nav>
        <img src="resources/profile.jpg" alt="profile" width="5%">
        <br>
        <h3 class="center-text">Off Oven, On Doorstep</h3>
    </header>

    <div class="wrapper">
        <div class="container">
            <div class="flex-item">
                <table class="order-detail-table">
                    <tr>
                        <th class="pad-btm" colspan=3>Order ID: OL<?php echo str_pad($id,$length,"0", STR_PAD_LEFT);?></th>
                    </tr>
                    <tr>
                        <td colspan=3>Customer Name: <span class="text-bold"><?php echo $name ?></span></td>
                    </tr>
                    <tr>
                        <td class="pad-btm" colspan=3>Customer Address: <span class="text-bold"><?php echo $address ?></span></td>
                    </tr>
                    <tr>
                        <td colspan=3>Order Date: <span class="text-bold"><?php echo $orderDate ?></span></td>
                    </tr>
                    <tr>
                        <td class="pad-btm" colspan=3>Order Time: <span class="text-bold"><?php echo $orderTime ?></span></td>
                    </tr>
                    <tr>
                        <td>Ordered Item:</td>
                        <td style="text-align:left;">Quantity:</td>
                        <td style="text-align:right;">Price:</td>
                    </tr>
                    <?php
                    for ($i=0; $i < $rowcount; $i++) { 
                    ?>
                    <tr>
                        <td><?php echo $row[$i]['foodName'] ?></td>
                        <td><?php echo $row[$i]['orderQuantity']  ?></td>
                        <td style="text-align: right;">RM <?php printf("%.2f", $row[$i]['categoryPrice']) ?></td>
                    </tr>
                    <?php
                        $totalPrice += $row[$i]['categoryPrice'] * $row[$i]['orderQuantity'];
                    }
                    ?>
                    <tr>
                        <td style="border-top: 1px solid #ddd">Total Payment: </td>
                        <td colspan=2 style="border-top: 1px solid #ddd; text-align: right;">RM <?php printf("%.2f", $totalPrice) ?></td>
                    </tr>
                </table>
                <br>
                <br>
                <br>
                <input class="btn" type="button" value="Back" onclick="window.location='ro_orderList.php';">
            </div>
            <div class="flex-item order-status">
                <h4>Order Status: <span style="padding-left: 0.8em;"><?php echo $orderStatus ?></span></h4>
                <br><br>
                <!-- <input class="btn" type="button" name="status" value="Ordered" onclick="generateQR('<?php echo $id ?>', 'Ordered')"> -->
                <input class="btn" type="button" name="status" value="Prepared" onclick="generateQR('<?php echo $id ?>', 'Prepared')">
                <input class="btn" type="button" name="status" value="Cancel" onclick="generateQR('<?php echo $id ?>', 'Cancel')">
                <br><br><br>
                <div id="statusText"></div>
                <br>
                <div id="qrcode"></div>
                <!-- <form action="./db/updateOrderStatus.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input class="btn" type="submit" name="status" value="Ordered">
                    <input class="btn" type="submit" name="status" value="Prepared">
                    <input class="btn" type="submit" name="status" value="Cancel">
                </form> -->
            </div>
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
        <span class="icon-text"> Universiti Malaysia Pahang 26600 Pekan Pahang, Malaysia. </span>
        <br><i class="material-icons">local_phone</i>
        <span class="icon-text"> +609 431 5000 </span>
        <br><i class="material-icons">email</i>
        <span class="icon-text"> pro@ump.edu.my </span>
    </footer>
</body>
</html>
<?php
mysqli_close($con);
?>