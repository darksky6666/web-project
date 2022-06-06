<?php
include './db/db.php';
$sql="SELECT ol.orderID, user.name, user.address, ol.orderDate, ol.orderTime, ol.orderStatus FROM `order_list` `ol`, `user` WHERE user.username=ol.username ORDER BY ol.orderDate DESC";
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
    <link rel="icon" href="./resources/favicon.png">
    <link rel="stylesheet" href="css/order.css">
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
    <h2>Order List</h2>
    <br><br>
        <div class="order-list">
            <table class="order-list-table">
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Order Date</th>
                    <th>Order Time</th>
                    <th>Order Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                $i=0;
                if($rowcount>0){
                    while($row=mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>".++$i."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['address']."</td>";
                        echo "<td>".$row['orderDate']."</td>";
                        echo "<td>".$row['orderTime']."</td>";
                        echo "<td>".$row['orderStatus']."</td>";
                        echo "<td><a class='btn' href='ro_orderDetails.php?orderID=".$row['orderID']."'>Details</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
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