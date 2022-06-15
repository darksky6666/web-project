<!DOCTYPE html>
<html>
<head>
    <title>Admin View Complaint List</title>  

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
        <a href="userList.php">User List</a> 
        <a href="../manage_user/userReport.php">User Report</a> 
        <a class="active" href="../complaint/IndexAdminViewComplaint.php">Complaint List</a>
        <a href="../complaint/complaintReport.php">Complaint Report</a>
        <a href="logout.php" onclick="return checklogout()">Logout</a>
        </nav>
        <a href="profile.php"><img src="../resources/profile.jpg" alt="profile" width="80" height="80"></a>
        <br>
        <h3>Off Oven, On Doorstep</h3>

<div STYLE="background-color:#000000; height:3px; width:100%;"></div>
<br>
</header>



<body bgcolor="#FFFFFF" text="#000000">

<!--Display result after searching-->
<div class="after">
<br><p style="text-align: center;font-family:Courier New;font-size:150%;"><b>~~ SEARCH RESULT ~~</b></p>

<?php
include("../db/db.php");

if(isset($_POST['searchComplaint']))
{
    $printStart=$_POST['start'];
	$printEnd=$_POST['end'];

    extract($_POST);

    $sql = "SELECT * FROM Complaint_List WHERE (complaintDate BETWEEN '$printStart' AND '$printEnd') AND complaintType='$complaintType'AND complaintStatus='$complaintStatus' ";

    $result = mysqli_query($conn,$sql) or die(mysqli_error());

    echo "<table>";
        echo "<tr>" . "<th>ComplaintID</th>" . "<th>order_ID</th>" . "<th>ComplaintType</th>" . "<th>Description</th>" . "<th>Date</th>". "<th>Time</th>". "<th>Status</th>"."<th></th>". "</tr>";
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){

                $id = $row["complaint_ID"];
                $length = 5;
                $string = substr(str_repeat(0, $length).$id,-$length);
                
                echo "<tr><td>". 
                "CP". $string . "</td><td>" .  
                $row['order_ID'] . "</td><td>" . 
                $row['complaintType'] . "</td><td>" .
                $row['complaintDesc'] . "</td><td>" .
                $row['complaintDate'] . "</td><td>" .
                $row['complaintTime'] . "</td><td>" .
                $row['complaintStatus'] . "</td><td>" .
                "<a href='DeleteComplaint.php?id=$id'>" .
                '<button style="font-family:Courier New;margin-left:10%;font-weight: bold; "type="submit" name="deleteComplaint">DELETE</button>' .
                '</a>' .
                "</td></tr>";
            }
        }
        else {
            echo "No result found.";
        }
        echo "</table>";
}
?> 
<br><br>
</div>

<div class="backButton" style="display:flex;align-items:center;justify-content:center;">
    
    <a href="IndexAdminViewComplaint.php">
    <button style="font-family:Courier New;font-weight: bold; "type="submit" name="backToSearch">BACK</button>
    </a>
</div>

<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<div id="QRCode"></div>
<script type="text/javascript">
    var qrcode = new QRCode(document.getElementById("QRCode"), {
        text: "http://localhost/M5/complaintReport.php",
        width: 128,
        height: 128,
        colorDark: "#6C5A8A",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
</script>
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