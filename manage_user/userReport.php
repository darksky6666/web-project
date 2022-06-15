<!-- userReport.php -->
<!-- Interface of calc num of user based on user type, region and display the generated graph based on the value -->
<?php
session_start();
if (empty($_SESSION['logged_in'])) {
    header("Location: ../manage_user/indexLogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report Page</title>
    <link rel="icon" href="../resources/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        table, th, td {
            border: 2px solid black;
            border-collapse: collapse;
            padding: 10px 10px;
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

        table {
            margin-left: auto;
            margin-right: auto;
        }

        th {
            background-color: skyblue;
        }

        .graph {
            width: 300px;
            padding: 50px;
            margin-left: 60px;
        }
    </style>
</head>

<script>
    function checklogout(){
    return confirm('Are you sure to Logout?');
    }
</script>

<header class="wrapper">
<img src="../resources/ump logo.png" alt="UMP" width="100" height="100">
        <img src="../resources/foody logo.png" alt="Foody" width="100" height="100">
        <nav>
        <a href="userList.php">User List</a> 
        <a class="active" href="../manage_user/userReport.php">User Report</a> 
        <a href="../complaint/IndexAdminViewComplaint.php">Complaint List</a>
        <a href="../complaint/complaintReport.php">Complaint Report</a>
        <script src="../js/logout.js"></script>
        <a href="javascript:void(0);" onclick="return logout();">Logout</a>
        </nav>
        <a href="#profile"><img src="../resources/profile.jpg" alt="profile" width="80" height="80"></a>
        <br>
        <h3>Off Oven, On Doorstep</h3>

<div STYLE="background-color:#000000; height:3px; width:100%;"></div>
<br>

</header>

<body>
    <h2 align="center">
        <br><b>User Report</b>
    </h2>
    <form method="post" action="">
        <br><div>
        <p style="text-align:center;color:black;font-weight:bold;"> Generate total number of user based on Region and User Type 
        &nbsp&nbsp&nbsp&nbsp&nbsp <button type="submit" value="GENERATE" name="generate"">Generate</button></p>
        <br></div>
    </form>
    <br>
    <?php
    include("../db/db.php");

    if(isset($_POST['generate'])){
        echo "<table>";
            echo "<tr>" . "<th>Region</th>" . "<th>User Type</th>" . "<th>Total</th>". "</tr>";

        $query="SELECT * FROM user WHERE region='Gambang' AND userType='General User'";
        $result1 = mysqli_query($conn, $query);
        if (mysqli_num_rows($result1) >= 0){  
            echo "<tr>".'<td rowspan="3">'."Gambang"."</td>".
                    "<td>"."General User"."</td>".
                    "<td>".mysqli_num_rows($result1)."</td>";               
        }

        $query="SELECT * FROM user WHERE region='Gambang' AND userType='Restaurant Owner'";
        $result2=mysqli_query($conn, $query);
        if (mysqli_num_rows($result2) >= 0){
            echo "<tr>".'<td rowspan="1">'."Restaurant Owner"."</td>".
                    "<td>".mysqli_num_rows($result2)."</td>";
        }

        $query="SELECT * FROM user WHERE region='Gambang' AND userType='Rider'";
        $result3=mysqli_query($conn, $query);
        if (mysqli_num_rows($result3) >= 0){
            echo "<tr>".'<td rowspan="1">'."Rider"."</td>".
                    "<td>".mysqli_num_rows($result3)."</td>";
        }

        $query="SELECT * FROM user WHERE region='Kuantan' AND userType='General User'";
        $result4 = mysqli_query($conn, $query);
        if (mysqli_num_rows($result4) >= 0){  
            echo "<tr>".'<td rowspan="3">'."Kuantan"."</td>".
                    "<td>"."General User"."</td>".
                    "<td>".mysqli_num_rows($result4)."</td>";               
        }

        $query="SELECT * FROM user WHERE region='Kuantan' AND userType='Restaurant Owner'";
        $result5 = mysqli_query($conn, $query);
        if (mysqli_num_rows($result5) >= 0){
            echo "<tr>".'<td rowspan="1">'."Restaurant Owner"."</td>".
                    "<td>".mysqli_num_rows($result5)."</td>";
        }

        $query="SELECT * FROM user WHERE region='Kuantan' AND userType='Rider'";
        $result6 = mysqli_query($conn, $query);
        if (mysqli_num_rows($result6) >= 0){
            echo "<tr>".'<td rowspan="1">'."Rider"."</td>".
                    "<td>".mysqli_num_rows($result6)."</td>";
        }

        $query="SELECT * FROM user WHERE region='Pekan' AND userType='General User'";
        $result7 = mysqli_query($conn, $query);
        if (mysqli_num_rows($result7) >= 0){  
            echo "<tr>".'<td rowspan="3">'."Pekan"."</td>".
                    "<td>"."General User"."</td>".
                    "<td>".mysqli_num_rows($result7)."</td>";               
        }

        $query="SELECT * FROM user WHERE region='Pekan' AND userType='Restaurant Owner'";
        $result8 = mysqli_query($conn, $query);
        if (mysqli_num_rows($result8) >= 0){
            echo "<tr>".'<td rowspan="1">'."Restaurant Owner"."</td>".
                    "<td>".mysqli_num_rows($result8)."</td>";
        }

        $query="SELECT * FROM user WHERE region='Pekan' AND userType='Rider'";
        $result9 = mysqli_query($conn, $query);
        if (mysqli_num_rows($result9) >= 0){
            echo "<tr>".'<td rowspan="1">'."Rider"."</td>".
                    "<td>".mysqli_num_rows($result9)."</td>";
        }
        
        echo "</table>";
    }
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div id="userReport" style="width:80%; height:350px;" class="graph">

    <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
    var data = google.visualization.arrayToDataTable([
    ['userType', 'General User','Restaurant Owner','Rider'],
    ['Gambang', <?php echo mysqli_num_rows($result1); ?>,<?php echo mysqli_num_rows($result2); ?>,<?php echo mysqli_num_rows($result3) ; ?>],
    ['Kuantan', <?php echo mysqli_num_rows($result4); ?>,<?php echo mysqli_num_rows($result5); ?>,<?php echo mysqli_num_rows($result6) ; ?>],
    ['Pekan', <?php echo mysqli_num_rows($result7); ?>,<?php echo mysqli_num_rows($result8); ?>,<?php echo mysqli_num_rows($result9) ; ?>],

    ]);

    var options = {
    title:'Total Number of User' };

    var chart = new google.visualization.BarChart(document.getElementById('userReport'));
    chart.draw(data, options);
    }
    </script>
    </div>
</body>

<br>
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