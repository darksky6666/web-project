<?php
if(isset($_POST['submit'])) 
{ 
    $monthSelector = $_POST['monthSelector'];

}
else {
    $monthSelector = date('Y-m', strtotime("-1 months"));
}

session_start();
$RO_username=$_SESSION['RO_username'];

include '../db/getInsight.php';
include '../db/validateRestaurant.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody</title>
    <link rel="icon" href="../resources/favicon.png">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/header_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script type="text/javascript">
        // Initialize
        function initialize() {
            // chartTotalAmount
            y_amount = <?php echo json_encode($totalAmount) ?>;
            x_amount = <?php echo json_encode($week) ?>;
            chartTotalAmount();
            
            // chartTotalOrder
            y_order = <?php echo json_encode($totalOrder) ?>;
            x_order = <?php echo json_encode($orderDate) ?>;
            chartTotalOrder();

            // chartAccumulatedPayment
            y_accumulated = <?php echo json_encode($accumulatedPayment) ?>;
            x_accumulated = <?php echo json_encode($monthAccumulated) ?>;
            chartAccumulatedPayment();

            // Calculation
            getHighLow();
            var tPay = calcTotalPayment();
            calcTotalOrder();
            var tFCom = calcFoodyCommission(tPay);
            var tRCom =calcRiderCommission(tPay);
            calcProfit(tPay, tFCom, tRCom);
            calcAccumulatedPayment();
        }

        // Get highest and lowest value
        function getHighLow() {
            document.getElementById('highPayment').innerHTML = Math.max(...y_amount).toFixed(2);
            document.getElementById('lowPayment').innerHTML = Math.min(...y_amount).toFixed(2);
        }

        // Calculate Total Order
        function calcTotalOrder() {
            var totalOrder = 0;
            for (var i = 0; i < y_order.length; i++) {
                totalOrder += parseInt(y_order[i]);
            }
            document.getElementById('totalOrder').innerHTML = totalOrder;
        }

        // Calculate Total Payment
        function calcTotalPayment() {
            var totalPayment = 0;
            for (var i = 0; i < y_amount.length; i++) {
                totalPayment += parseFloat(y_amount[i]);
            }
            document.getElementById('totalPayment').innerHTML = totalPayment.toFixed(2);
            return totalPayment;
        }

        // Calculate Foody Commission
        function calcFoodyCommission(tPay) {
            var totalPayment = tPay;
            // Set Foody commission to 3%
            var commission = totalPayment * 0.03;
            document.getElementById('foodyCommission').innerHTML = commission.toFixed(2);
            return commission;
        }

        // Calculate Rider Commission
        function calcRiderCommission(tPay) {
            var totalPayment = tPay;
            // Set Rider commission to 5%
            var commission = totalPayment * 0.05;
            document.getElementById('riderCommission').innerHTML = commission.toFixed(2);
            return commission;
        }

        // Calculate Profit
        function calcProfit(tPay, tFCom, tRCom) {
            var totalPayment = tPay;
            var foodyCommission = tFCom;
            var riderCommission = tRCom;
            var profit = totalPayment - foodyCommission - riderCommission;
            document.getElementById('profit').innerHTML = profit.toFixed(2);
        }

        // Calculate Accumulated Payment
        function calcAccumulatedPayment() {
            var accumulatedPayment = 0;
            for (var i = 0; i < y_accumulated.length; i++) {
                accumulatedPayment += parseFloat(y_accumulated[i]);
            }
            document.getElementById('accumulatedPayment').innerHTML = accumulatedPayment.toFixed(2);
        }

        // Total amount
        function chartTotalAmount() {
            new Chart("chartTotalAmount", {
                type: "bar",
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
                                text: "RM",
                            }
                        },
                        },
                    }
                });
        }

        // Total order
        function chartTotalOrder() {
            new Chart("chartTotalOrder", {
                type: "line",
                data: {
                    labels: x_order,
                    datasets: [{
                            label: "Total amount",
                            backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9"],
                            data: y_order
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
                                    text: "Date",
                                }
                            },
                            y: {
                            display: true,
                            title: {
                                display: true,
                                text: "No of orders",
                            }
                        },
                        },
                    }
                });
        }

        // Accumulated payment
        function chartAccumulatedPayment() {
            new Chart("chartAccumulatedPayment", {
                type: "line",
                data: {
                    labels: x_accumulated,
                    datasets: [{
                            label: "Total amount",
                            backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9"],
                            data: y_accumulated
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
                                text: "RM",
                            }
                        },
                        },
                    }
                });
        }
    </script>
</head>
<body onload="initialize()">
    <header class="wrapper">
        <img src="../resources/ump logo.png" alt="UMP" width="5%">
        <img src="../resources/foody logo.png" alt="Foody" width="5%">
        <nav>
            <a href="ro_dashboard.php">Dashboard</a>
            <a href="ro_menuList.php">Menu List</a>
            <a href="ro_restaurantDetails.php">Restaurant Details</a>
            <a href="ro_orderList.php">Order List</a>
            <a class="active" href="ro_report.php">Restaurant Report</a>
            <a href="#">Logout</a>
        </nav>
        <img src="../resources/../resources/profile.jpg" alt="profile" width="5%">
        <br>
        <h3 class="center-text">Off Oven, On Doorstep</h3>
    </header>

    <div class="wrapper height-50">
        <div class="center-text" style="font-size: 1.5em;">
            <h3>Restaurant Owner Report</h3>
            <br>
            <form action="" method="post">
                <input type="month" name="monthSelector" id="monthSelector" min="2022-01" value="<?php echo $year.'-'.$month?>">
                <input type="submit" name="submit" value="Generate">
            </form>
        </div>
        <br>
        <br>
        <h4 class="center-text" style="font-size: 1.3em;">Report for <?php echo $year . "-" . $month ?></h4>
        <br><br>
        <?php 
        if (mysqli_num_rows($resultAmount) > 0){
            echo('<div class="flex-container">');
        }
        else {
            echo('<div class="flex-container" style="display: none;"> ');
        }
        ?>
            <!-- 
                Collected Payment 
            -->
            <div class="flex-item">
                <h5>Collected Payment</h5>
                <canvas id="chartTotalAmount" style="width:100%;max-width:700px"></canvas>
                <br>
                <table>
                    <tr>
                        <td>Highest collected payment:</td>
                        <td class="right-text">RM <span id="highPayment"></span></td>
                    </tr>
                    <tr>
                        <td>Lowest collected payment:</td>
                        <td class="right-text">RM <span id="lowPayment"></span></td>
                    </tr>
                </table>
            </div>
            <!-- 
                Number of orders
            -->
            <div class="flex-item">
                <h5>Number of Orders</h5>
                <canvas id="chartTotalOrder" style="width:100%;max-width:700px"></canvas>
                <br>
                <table>
                    <tr>
                        <td>Total Number of Orders:</td>
                        <td><span id="totalOrder"></span></td>
                    </tr>
                </table>
            </div>
            <!-- 
                Accumulated received payment
            -->
            <div class="flex-item">
                <h5>Accumulated Received Payment Since Joined Foody</h5>
                <canvas id="chartAccumulatedPayment" style="width:100%;max-width:700px"></canvas>
                <br>
                <table>
                    <tr>
                        <td>Accumulated Payment:</td>
                        <td class="right-text">RM <span id="accumulatedPayment"></span></td>
                    </tr>
                </table>
            </div>
            <!-- 
                Commission
            -->
            <div class="flex-item">
                <h5>Commission</h5>
                <br>
                <table>
                    <tr>
                        <td>Total Payment Received:</td>
                        <td class="right-text">RM <span id="totalPayment"></span></td>
                    </tr>
                    <tr>
                        <td>Total Foody Commission (3%):</td>
                        <td class="right-text">RM <span id="foodyCommission"></td>
                    </tr>
                    <tr>
                        <td>Total Rider Commission (5%):</td>
                        <td class="right-text">RM <span id="riderCommission"></td>
                    </tr>
                    <tr>
                        <td>Profit:</td>
                        <td class="right-text">RM <span id="profit"></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php 
        if (mysqli_num_rows($resultAmount) == 0){
            echo('<div style="display: block;">');
        }
        else {
            echo('<div style="display: none;">');
        }
        ?>
        <br>
        <br>
            <h3 class="error center-text">No data found for <?php echo $year ."-". $month ?>!</h3>
        </div>
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
        <span class="icon-text"> Universiti Malaysia Pahang 26600 Pekan Pahang, Malaysia. </span>
        <br><i class="material-icons">local_phone</i>
        <span class="icon-text"> +609 431 5000 </span>
        <br><i class="material-icons">email</i>
        <span class="icon-text"> pro@ump.edu.my </span>
    </footer>
</body>
</html>