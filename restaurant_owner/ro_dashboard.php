<?php
include '../db/db.php';
session_start();
$_SESSION['RO_username']='RE10001';
$RO_username=$_SESSION['RO_username'];

$sqlrName="SELECT `rdName` FROM `restaurant_details` WHERE `RO_username`='$RO_username';";
$resultrName=mysqli_query($con,$sqlrName) or die (mysqli_error());
$rowrName=mysqli_fetch_assoc($resultrName);
if ($rowrName == 0) {
    echo "<script type = 'text/javascript'> alert('No Restaurant Details Found') </script>";
    echo "<script type = 'text/javascript'> window.location='../restaurant_owner/ro_restaurantDetails.php' </script>";
}
$rdName=$rowrName['rdName'];

// Total Amount
$sqlAmount="SELECT COUNT(`orderID`), WEEK(`orderDate`), SUM(`totalAmount`) FROM `order_list` WHERE `RO_username`='$RO_username' GROUP BY WEEK(`orderDate`) ORDER BY `orderDate` ASC;";
$resultAmount=mysqli_query($con,$sqlAmount) or die(mysqli_error($con));

$totalAmount=array();
$week=array();
while ($rowAmount=mysqli_fetch_array($resultAmount)) {
    array_push($totalAmount,$rowAmount['SUM(`totalAmount`)']);
    array_push($week,$rowAmount['WEEK(`orderDate`)']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody</title>
    <link rel="icon" href="../resources/favicon.png">
    <link rel="stylesheet" href="../css/header_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script type="text/javascript">
        function initialize() {
            // chartTotalAmount
            y_amount = <?php echo json_encode($totalAmount) ?>;
            x_amount = <?php echo json_encode($week) ?>;
            chartTotalAmount();
        }
        function chartTotalAmount() {
            new Chart("chartTotalAmount", {
                type: "line",
                data: {
                    labels: x_amount,
                    datasets: [{
                            label: "Total amount",
                            backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9"],
                            data: y_amount
                            }]
                    },
                    options: {
                        plugins:{
                            legend: {
                                display: false
                            },
                        },
                        scales: {
                            x: {
                                display: true,
                                title: {
                                    display: true,
                                    text: "Weeks",
                                }
                            },
                            y: {
                            display: true,
                            title: {
                                display: true,
                                text: "Total Amount",
                            }
                        },
                        },
                    }
                });
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .wrapper {
            width: 95%;
            padding: 1%;
            margin: 0 auto;
            border-bottom: 1px solid black;
        }
        
        .center-text {
            text-align: center;
        }

        .column {
            float: left;
            width: 23%;
            padding: 0 10px;
            margin-top: 10px;
        }

        .order-summary {
            width: 40%;
            padding: 0 10px;
            margin-top: 30px;
        }

        .row {
            margin: 0 -5px;
            box-sizing: border-box;
        }

        h3 {
            font-size: medium;
            font-weight: 400;
        }

        h5 {
            font-size: small;
            font-weight: 400;
        }

        p {
            padding-top: 30px;
            font-weight: bold;
            font-size: x-large;
        }

        .icon {
            width: 60px;
            float: right;
            display: inline;
        }

        .rotate-320 {
            transform: rotate(320deg);
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); 
            padding: 16px;
            background-color: #f1f1f1;
            min-height: 120px;
        }
        
        table {
            margin-left: 1%;
            width: 95%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-weight: 400;
            font-size: small;
        }

        td {
            text-align: left;
            font-weight: bold;
            font-size: medium;
        }

        th, td {
            line-height: 40px;
            border-bottom: 1px solid black;
        }

        .title-popular {
            font-weight: bold;
            margin-left: 1%;
        }

        .error {
            color: red;
            font-size: small;
        }

        .welcome {
            font-size: large;
            font-weight: 500;
        }
    </style>
</head>

<body onload="initialize()">
    <header class="wrapper">
        <img src="../resources/umplogo.png" alt="UMP" width="5%">
        <img src="../resources/foodylogo.png" alt="Foody" width="5%">
        <nav>
            <a class="active" href="ro_dashboard.php">Dashboard</a>
            <a href="ro_menuList.php">Menu List</a>
            <a href="ro_restaurantDetails.php">Restaurant Details</a>
            <a href="ro_orderList.php">Order List</a>
            <a href="ro_report.php">Restaurant Report</a>
            <a href="#">Logout</a>
        </nav>
        <img src="../resources/profile.jpg" alt="profile" width="5%">
        <br>
        <h3 class="center-text">Off Oven, On Doorstep</h3>
    </header>

    <div class="wrapper">
        <h2 class="center-text">Dashboard</h2>
        <br>
        <?php
            // Get restaurant name
            $sqlRestaurantName = "SELECT `rdName` FROM `restaurant_details` WHERE `RO_username` = '$RO_username';";
            $resultRestaurantName = mysqli_query($con, $sqlRestaurantName);
            $rowRestaurantName = mysqli_fetch_assoc($resultRestaurantName);
            $rdName = $rowRestaurantName['rdName'];
        ?>
        <h2 class="center-text welcome">Welcome, <?php echo $rdName ?></h2>
        <br>
        <div class="row">
            <div class="column">
                <div class="card">
                    <h3>Total Menu</h3>
                    <?php
                        $sqlMenu = "SELECT * FROM `menu_list` WHERE `RO_username`='$RO_username';";
                        $resultMenu = mysqli_query($con, $sqlMenu);
                        $countMenu = mysqli_num_rows($resultMenu);
                    ?>
                    <p><?php echo $countMenu ?? 'Error'?></p>
                    <?php
                        if ($countMenu < 10) {
                            echo('<span class="error">* At least 10 menus are required</span>');
                        }
                    ?>
                    <img class="icon rotate-320" src="https://cdn-icons-png.flaticon.com/512/857/857681.png" alt="food-icon">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <h3>Total Revenue</h3>
                    <?php
                        $sqlRevenue = "SELECT `totalAmount` FROM `order_list` WHERE `RO_username`='$RO_username';";
                        $resultRevenue = mysqli_query($con, $sqlRevenue);
                        $countRevenue = mysqli_num_rows($resultRevenue);
                        if ($countRevenue = 0) {
                            $totalRevenue = 0;
                        } else {
                            $totalRevenue = 0;
                            while ($rowRevenue = mysqli_fetch_assoc($resultRevenue)) {
                                $totalRevenue += $rowRevenue['totalAmount'];
                            }
                        }
                        $foodyCommission = $totalRevenue * 0.03;
                        $riderCommission = $totalRevenue * 0.05;
                        $totalRevenue -= $foodyCommission + $riderCommission;
                    ?>
                    <p>RM <?php printf("%.2f", $totalRevenue)?></p>
                    <img class="icon" src="https://cdn-icons-png.flaticon.com/512/631/631180.png" alt="food-icon">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <h3>Total Orders</h3>
                    <?php
                        $sqlOrder = "SELECT * FROM `order_list` WHERE `RO_username`='$RO_username';";
                        $resultOrder = mysqli_query($con, $sqlOrder);
                        $countOrder = mysqli_num_rows($resultOrder);
                    ?>
                    <p><?php echo $countOrder?></p>
                    <img class="icon" src="https://cdn-icons-png.flaticon.com/512/743/743131.png" alt="food-icon">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <h3>Total Customers</h3>
                    <?php
                        $sqlCustomer = "SELECT `username` FROM `order_list` WHERE `RO_username`='$RO_username' GROUP BY `username`;";
                        $resultCustomer = mysqli_query($con, $sqlCustomer);
                        $countCustomer = mysqli_num_rows($resultCustomer);
                    ?>
                    <p><?php echo $countCustomer?></p>
                    <img class="icon" src="https://cdn-icons-png.flaticon.com/512/3126/3126647.png" alt="food-icon">
                </div>
            </div>
            <div class="column order-summary">
                <div class="card">
                    <h3>Orders Summary</h3>
                    <h5>Summary of total order price in <?php echo $rdName ?></h5>
                    <br>
                    <canvas id="chartTotalAmount" style="width:100%;max-width:700px"></canvas>
                </div>
            </div>
        </div>
        <br><br><br>
        <h3 class="title-popular">Popular Menu Dishes</h3>
        <br>
        <table>
            <tr>
                <th>RANK</th>
                <th>NAME</th>
                <th>CATEGORY</th>
                <th>PRICE</th>
                <th>SOLD</th>
            </tr>
            <?php
            $sqlPopular = "SELECT ml.menu_ID, ml.foodName, fc.categoryName, fc.categoryPrice, SUM(od.`orderQuantity`) FROM `order_details` od, `menu_list` ml, `order_list` ol, `food_categories` fc WHERE ol.orderID=od.orderID AND od.menu_ID=ml.menu_ID AND ml.fc_ID=fc.fc_ID AND ol.RO_username='$RO_username' GROUP BY od.menu_ID ORDER BY SUM(od.`orderQuantity`) DESC LIMIT 5;";
            $resultPopular = mysqli_query($con, $sqlPopular);
            $countPopular = mysqli_num_rows($resultPopular);
            $rank = 1;
            if ($countPopular > 0) {
                while ($rowPopular = mysqli_fetch_assoc($resultPopular)) {
                    echo('<tr>');
                    echo('<td>'.$rank.'</td>');
                    echo('<td>'.$rowPopular['foodName'].'</td>');
                    echo('<td>'.$rowPopular['categoryName'].'</td>');
                    echo('<td>RM '.number_format($rowPopular['categoryPrice'], 2).'</td>');
                    echo('<td>'.$rowPopular['SUM(od.`orderQuantity`)'].'</td>');
                    echo('</tr>');
                    ++$rank;
                }
                
            } else {
                echo('<tr><td colspan=5>No popular menu dishes</td></tr>');
            }
            ?>
        </table>
        <br><br>
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