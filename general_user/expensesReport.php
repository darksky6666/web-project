<?php
if(isset($_POST['submit'])) 
{ 
    $monthSelector = $_POST['monthSelector'];

}
else {
    $monthSelector = date('Y-m');
}

include("../db/db.php");
include("getInsight.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody System-Expenses Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <style>

        h3 {
            font-family:arial;
            text-align: center;
        }

        .center-text {
            text-align: center;
        }
        
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

        .icon-text{
            display: inline-flex;
            align-items: center;
            padding:0 24px;
        }
        /**/
      </style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
<script type="text/javascript">
// Initialize
function initialize() {
    // chartTotalExpenses
    y_amount = <?php echo json_encode($totalPayment) ?>;
    x_amount = <?php echo json_encode($week) ?>;
    expenses = <?php echo json_encode($expenses) ?>;
    chartTotalExpenses();
    averageExpenses();
    getMinMaxExpenses();
}

// Total expenses
function chartTotalExpenses() {
    new Chart("chartTotalExpenses", {
    type: "bar",
    data: {
        labels: x_amount,
        datasets: [{
                label: "Total expenses",
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

function averageExpenses() {
    var totalPayment = 0;
    var totalWeek = 4;
    for (let i = 0; i < y_amount.length; i++) {
        totalPayment += parseFloat(y_amount[i]);
    }

    let average = totalPayment / totalWeek;
    document.getElementById('averageExpenses').innerHTML = average.toFixed(2);
}

function getMinMaxExpenses() {
    document.getElementById('maxExpenses').innerHTML = Math.max(...expenses).toFixed(2);
    document.getElementById('minExpenses').innerHTML = Math.min(...expenses).toFixed(2);
}
</script>
    
    </head>

<script>
  function checklogout(){
    return confirm('Are you sure to Logout?');
  }

</script>
<body onload="initialize()">
 <header class="wrapper">
        <img src="../resources/ump logo.png" alt="UMP" width="100" height="100">
        <img src="../resources/foody logo.png" alt="Foody" width="100" height="100">
        <nav>
        <a href="resList.php">Restaurant List</a> 
        <a href="orderList.php">Order List</a> 
        <a class="active" href="expensesReport.php">Expenses Report</a>
        <a href="UserViewComplaint.php">My Complaint</a>
        <a href="logout.php" onclick="return checklogout()">Logout</a>
        </nav>
        <a><img src="../resources/profile.jpg" alt="profile" width="80" height="80"></a>
        <br>
        <h3>Off Oven, On Doorstep</h3>

<div STYLE="background-color:#000000; height:3px; width:100%;"></div>
<br>

</header>

<div class="wrapper height-50">
        <div class="center-text" style="font-size: 1.5em;">
            <h3>Expenses Report</h3>
            <br>
            <form action="" method="post">
                <input type="month" name="monthSelector" id="monthSelector" min="2022-01" value="2022-05">
                <input type="submit" name="submit" value="Generate">
            </form>
        </div>
        <br>
        <br>
        <h4 class="center-text" style="font-size: 1.3em;">Report for <?php echo $year . "-" . $month ?></h4>
        <br><br>
            <div align="center">
                <h5>Total Expenses</h5>
                <canvas id="chartTotalExpenses" style="width:100%;max-width:700px"></canvas>
                <br>
                <br>
                <caption>
                    Average expenses: RM <span id="averageExpenses"></span>
                </caption>
                <br>
                <br>
                    Maximum expenses: RM <span id="maxExpenses"></span>
                </caption>
                <br>
                <br>
                <caption>
                    Minimum expenses: RM <span id="minExpenses"></span>
                </caption>
            </div>
        </div>
        <br>
    </div>

    </body>



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
        <i class="material-icons">location_on</i>
        <span class="icon-text"> Universiti Malaysia Pahang 26600 Pekan Pahang, Malaysia. </span>
        <br><br><i class="material-icons">local_phone</i>
        <span class="icon-text"> +609 431 5000 </span>
        <br><br><i class="material-icons">email</i>
        <span class="icon-text"> pro@ump.edu.my </span>
        <br><br>
</footer>
</html>