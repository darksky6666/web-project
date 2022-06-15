<?php
session_start();
if (empty($_SESSION['logged_in'])) {
    header("Location: ../manage_user/indexLogin.php");
    exit();
}
if(isset($_POST['submit'])) 
{ 
    $monthSelector = $_POST['monthSelector'];

}
else {
    $monthSelector = date('Y-m', strtotime("-1 months"));
}

include 'getInsight.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody</title>
    <link rel="icon" href="./resources/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script type="text/javascript">
        // Initialize
        function initialize() {
            // chartTotalAmount
            y_amount = <?php echo json_encode($totalPayment) ?>;
            x_amount = <?php echo json_encode($week) ?>;
            y_data = calcComm();
            chartTotalCommission();
            
            // Calculation
            var tPay = calcTotalPayment();
            calcRiderCommission(tPay);
           
        }

        function calcComm() {
            const tc=[];
            for (let i = 0; i < y_amount.length; i++) {
                tc.push(y_amount[i] * 0.05);
            }
            return tc;
        }
        // Calculate Total Payment
        function calcTotalPayment() {
            var totalPayment = 0;
            for (var i = 0; i < y_amount.length; i++) {
                totalPayment += parseFloat(y_amount[i]);
            }
            // document.getElementById('totalPayment').innerHTML = totalPayment.toFixed(2);
            return totalPayment;
        }

        // Calculate Rider Commission
        function calcRiderCommission(tPay) {
            var totalPayment = tPay;
            // Set Rider commission to 5%
            var commission = totalPayment * 0.05;
            document.getElementById('riderCommission').innerHTML = commission.toFixed(2);
            return commission;
        }
       

        function chartTotalCommission() {
            new Chart("chartTotalCommission", {
                type: "bar",
                data: {
                    labels: x_amount,
                    datasets: [{
                            label: "Total Commission",
                            backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9"],
                            data: y_data
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
                                labelString: "Weeks",
                            }
                        },
                            y: {
                            // beginAtZero: true,
                            title: {
                                display: true,
                                labelString: "RM",
                            }
                        }
                    }
                });
        }
    </script>
    <script>
    function checklogout(){
      return confirm('Are you sure to Logout?');
    }
    </script>
</head>
<style>
    /*header*/
    header {
        display: flex;
        flex-flow: wrap;
        justify-content: space-between;
        align-items: center;
        white-space: nowrap;
    }

    header > nav {
        margin-left: auto;
        margin-right: 1%;
     text-decoration: none;
    }

    header > nav > a {
        border: black solid 1px;
        text-decoration: none;
        padding: 0.5em;
        margin-right: 0.5em;
        border-radius: 5px;
        color: black;
        font-weight: bold;
        font-size: 18px;
    }

    header > nav > a:hover {
        background-color: rgb(0 ,128 ,255);
        color: black;
    }

    header > nav > a.active {
        color: black;
        background-color: rgb(0 ,128 ,255);
    }

    header > h3 {
        width: 100%;
        text-align: center;
        style=font-family:Georgia Garamond;
        font-size:300%;
    }
/**/

/*footer*/
    footer > div {
        display: flex;
        justify-content: space-between;
        align-items: center;
        white-space: nowrap;
    }

    footer > div > div {
        margin-left: auto;
    }

    .fa {
        padding: 10px;
        width: 1em;
        border-radius: 10px;
        text-align: center;
        font-size: 1.5em;
        text-decoration: none;
    }

    .fa:hover {
        opacity: 0.7;
    }

    .fa-facebook {
        background: #3B5998;
        color: white;
    }

    .fa-instagram {
        background: #125688;
        color: white;
    }

    .icon-text {
        display: inline-flex;
        align-items: center;
        padding:0 24px;
    }
/**/ 
    
</style>
<body onload="initialize()">
    <header class="wrapper">
        <img src="../resources/ump logo.png" alt="UMP" width="100" height="100">
        <img src="../resources/foody logo.png" alt="Foody" width="100" height="100">
        <nav>
        <a href="index.php">Pending Order</a> 
        <a href="acceptedOrder.php">Accepted Order</a> 
        <a href="deliveryRecord.php">Delivery Record</a> 
        <a class="active" href="riderReport.php">Rider Report</a>
        <script src="../js/logout.js"></script>
        <a href="javascript:void(0);" onclick="return logout();">Logout</a>
        </nav>
        <a href="#profile"><img src="../resources/profile.jpg" alt="profile" width="80" height="80"></a>
        <br>
        <h3>Off Oven, On Doorstep</h3>

        <div STYLE="background-color:#000000; height:3px; width:100%;"></div>
    <br>
    </header>

    
    <div class="wrapper height-50">
        <div style="font-size: 1.5em; text-align: center;">
            <h4>Rider Report</h4>
            <form action="" method="post">
                <input type="month" name="monthSelector" id="monthSelector" min="2022-01" value="2022-06">
                <input type="submit" name="submit" value="Generate Report">
            </form>
        </div>
        <br>
        <br>
        <!-- <h4 class="center-text" style="font-size: 1.3em;">Report for <?php echo $year . "-" . $month ?></h4> -->
        <br><br>
        <?php 
        if (mysqli_num_rows($resultAmount) > 0){
            echo('<div class="flex-container">');
        }
        else {
            echo('<div class="flex-container" style="display: none;"> ');
        }
        ?>
            
              
            <div align="center">
                <h3>Total Commission Since Rider First Joined Foody</h3>
                <canvas id="chartTotalCommission" style="width:100%;max-width:700px"></canvas>
                <br>
                <table>
                    <tr>
                        <td>Rider Commission = 5% from Total Payment<br><br></td>
                    </tr>
                    <tr>
                        <td>Total Commission: RM <span id="riderCommission"></span></td>
                    </tr>
                </table>
            </div>
         
        <br>
        <br>
            <!-- <h3 class="error center-text">No data found for <?php echo $year ."-". $month ?>!</h3> -->
        </div>
        <br>
    </div>

    <br><br><br><br>
<DIV STYLE="background-color:#000000; height:3px; width:100%;">

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