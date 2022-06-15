<?php
session_start();
if (empty($_SESSION['logged_in'])) {
    header("Location: ../manage_user/indexLogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Complaint Report</title>
    <link rel="icon" href="../resources/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

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
        <a href="../manage_user/userList.php">User List</a> 
        <a href="../manage_user/userReport.php">User Report</a> 
        <a href="../complaint/IndexAdminViewComplaint.php">Complaint List</a>
        <a class="active" href="../complaint/complaintReport.php">Complaint Report</a>
        <script src="../js/logout.js"></script>
        <a href="javascript:void(0);" onclick="return logout();">Logout</a>
        </nav>
        <a href="#profile"><img src="../resources/profile.jpg" alt="profile" width="80" height="80"></a>
        <br>
        <h3>Off Oven, On Doorstep</h3>

<div STYLE="background-color:#000000; height:3px; width:100%;"></div>
<br>
</header>


<body bgcolor="#FFFFFF" text="#000000">

<form action="" method="post">
    <br><div class="searchComplaint" style="background-color:pink;width:100%;">
    <br><p style="font-family:Arial;color:black;text-align:center;font-size:110%;"><b>COMPLAINT REPORT</b></p><br>
    <p style="text-align:center;font-family:Arial;color:darkslateblue;font-weight:bold;">SEARCH FROM : <input type="date" name="start">
    &nbsp&nbsp&nbsp&nbsp&nbsp  TO : <input type="date" name="end"> &nbsp <input style="font-family:Arial;width:auto;font-weight: bold; "type="submit" value="SEARCH" name="search"></p>
    <br>
</div>
</form>

<?php
include("../db/db.php");

if(isset($_POST['search']))
{

	$printStart=$_POST['start'];
	$printEnd=$_POST['end'];

    echo "<br>".'<p style="text-align:center;font-family:Courier New;font-size:150%;">'."<b>"."~~ REPORT RESULT~~"."</b>"."</p>";

    echo "<caption>"."<b>".'<p style="text-align:center;font-size:100%;">'."FROM DATE:"."$printStart"."&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp"."TO DATE:"."$printEnd"."</p>"."</caption>";

    echo "<table>";
        echo "<tr>" . "<th>No.</th>" . "<th>ComplaintType</th>" . "<th>ComplaintStatus</th>" . "<th>Subtotal</th>" . "<th>Total</th>". "</tr>";

    $query="SELECT * FROM Complaint_List WHERE (complaintDate BETWEEN '$printStart' AND '$printEnd') AND complaintType='LATE DELIVERY' AND complaintStatus='IN INVESTIGATION' ";
	$result1 = mysqli_query($conn, $query);
	
    if (mysqli_num_rows($result1) >= 0)
	{  
		echo "<tr>".'<td rowspan="2">'."1."."</td>".
                '<td rowspan="2">'."LATE DELIVERY"."</td>".
			    "<td>"."IN INVESTIGATION"."</td>".
                "<td>".mysqli_num_rows($result1)."</td>";               

    }

    $query="SELECT * FROM Complaint_List WHERE (ComplaintDate BETWEEN '$printStart' AND '$printEnd') AND complaintType='LATE DELIVERY'";
	$result2=mysqli_query($conn, $query);
	if (mysqli_num_rows($result2) >= 0)
	{
		echo '<td rowspan="2">'.mysqli_num_rows($result2)."</td>"."</tr>";

    }

    $query="SELECT * FROM Complaint_List WHERE  (ComplaintDate BETWEEN '$printStart' AND '$printEnd') AND complaintType='LATE DELIVERY' AND complaintStatus='RESOLVED' ";
	$result3=mysqli_query($conn, $query);
	if (mysqli_num_rows($result3) >= 0)
	{
		echo "<tr>"."<td>"."RESOLVED"."</td>"."<td>".mysqli_num_rows($result3)."</td>"."</tr>";
    }


    $query="SELECT * FROM Complaint_List WHERE (complaintDate BETWEEN '$printStart' AND '$printEnd') AND complaintType='DAMAGED FOOD' AND complaintStatus='IN INVESTIGATION' ";
	$result4 = mysqli_query($conn, $query);
	
    if (mysqli_num_rows($result4) >= 0)
	{  
		echo "<tr>".'<td rowspan="2">'."2."."</td>".
                '<td rowspan="2">'."DAMAGED FOOD"."</td>".
			    "<td>"."IN INVESTIGATION"."</td>".
                "<td>".mysqli_num_rows($result4)."</td>";               

    }

    $query="SELECT * FROM Complaint_List WHERE (ComplaintDate BETWEEN '$printStart' AND '$printEnd') AND complaintType='DAMAGED FOOD'";
	$result5=mysqli_query($conn, $query);
	if (mysqli_num_rows($result5) >= 0)
	{
		echo '<td rowspan="2">'.mysqli_num_rows($result5)."</td>"."</tr>";

    }

    $query="SELECT * FROM Complaint_List WHERE  (ComplaintDate BETWEEN '$printStart' AND '$printEnd') AND complaintType='DAMAGED FOOD' AND complaintStatus='RESOLVED' ";
	$result6=mysqli_query($conn, $query);
	if (mysqli_num_rows($result6) >= 0)
	{
		echo "<tr>"."<td>"."RESOLVED"."</td>"."<td>".mysqli_num_rows($result6)."</td>"."</tr>";
    }

    
    $query="SELECT * FROM Complaint_List WHERE (complaintDate BETWEEN '$printStart' AND '$printEnd') AND complaintType='BAD ATTITUDE' AND complaintStatus='IN INVESTIGATION' ";
	$result7 = mysqli_query($conn, $query);
	
    if (mysqli_num_rows($result7) >= 0)
	{  
		echo "<tr>".'<td rowspan="2">'."2."."</td>".
                '<td rowspan="2">'."BAD ATTITUDE"."</td>".
			    "<td>"."IN INVESTIGATION"."</td>".
                "<td>".mysqli_num_rows($result7)."</td>";               

    }

    $query="SELECT * FROM Complaint_List WHERE (ComplaintDate BETWEEN '$printStart' AND '$printEnd') AND complaintType='BAD ATTITUDE'";
	$result8=mysqli_query($conn, $query);
	if (mysqli_num_rows($result8) >= 0)
	{
		echo '<td rowspan="2">'.mysqli_num_rows($result8)."</td>"."</tr>";

    }

    $query="SELECT * FROM Complaint_List WHERE  (ComplaintDate BETWEEN '$printStart' AND '$printEnd') AND complaintType='BAD ATTITUDE' AND complaintStatus='RESOLVED' ";
	$result9=mysqli_query($conn, $query);
	if (mysqli_num_rows($result9) >= 0)
	{
		echo "<tr>"."<td>"."RESOLVED"."</td>"."<td>".mysqli_num_rows($result9)."</td>"."</tr>";
    }
    
    echo "</table>";

}

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="myChart" style="width:80%; height:350px; margin-left:auto; margin-right:auto;">

<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
  ['complaintType', 'IN INVESTIGATION','RESOLVED'],
  ['LATE DELIVERY', <?php echo mysqli_num_rows($result1); ?>,<?php echo mysqli_num_rows($result3) ; ?>],
  ['DAMAGED FOOD',<?php echo mysqli_num_rows($result4) ; ?>, <?php echo mysqli_num_rows($result6) ; ?>],
  ['BAD ATTITUDE',<?php echo mysqli_num_rows($result7) ; ?>, <?php echo mysqli_num_rows($result9) ; ?>],

]);

var options = {
  title:'Total Number of Complaint by Complaint Type and Complaint Status'};

var chart = new google.visualization.BarChart(document.getElementById('myChart'));
  chart.draw(data, options);
}
</script>
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