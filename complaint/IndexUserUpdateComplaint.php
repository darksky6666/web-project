<?php
session_start();
if (empty($_SESSION['logged_in'])) {
    header("Location: ../manage_user/indexLogin.php");
    exit();
}
$username=$_SESSION['username'];
?>
<!DOCTYPE html>
<head>
    <title>Update Complaint</title>
    <link rel="icon" href="../resources/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<style>
    table.table{
        width:80%;
        margin-left:7%;
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
</head>

<header class="wrapper">
        <img src="../resources/../resources/ump logo.png" alt="UMP" width="100" height="100">
        <img src="../resources/foody logo.png" alt="Foody" width="100" height="100">
        <nav>
        <a href="../general_user/resList.php">Restaurant List</a> 
        <a href="../general_user/checkout.php">Order List</a> 
        <a href="../general_user/expensesReport.php">Expenses Report</a>
        <a class="active" href="../complaint/UserViewComplaint.php">My Complaint</a>
        <script src="../js/logout.js"></script>
        <a href="javascript:void(0);" onclick="return logout();">Logout</a>
        </nav>
        <a href="#profile"><img src="../resources/../resources/profile.jpg" alt="profile" width="80" height="80"></a>
        <br>
        <h3>Off Oven, On Doorstep</h3>

<div STYLE="background-color:#000000; height:3px; width:100%;"></div>
<br>
</header>

<?php
include '../db/db.php';

$complaintID = $_GET['complaintID'];

$query = "SELECT o.order_ID, o.orderDate, o.orderTime, c.complaintType, c.complaintDesc FROM order_list AS o,complaint_list AS c WHERE o.order_ID = c.order_ID AND c.complaint_ID = '$complaintID' AND o.username='$username'";
$result = mysqli_query($conn, $query) or die (mysqli_error());
$row = mysqli_fetch_array($result);

$order_ID = $row['order_ID'];
$orderDate = $row["orderDate"];
$orderTime = $row["orderTime"];
$complaintType = $row['complaintType'];
$complaintDesc = $row['complaintDesc'];
?>

<body>

<form action="UpdateComplaint.php?complaintID=<?php echo $complaintID; ?>" method="post">
<br><br><div class="complaint" style="background-color:skyblue;width:56%;margin-left:20%">
<br><p style="text-align: center;font-family:Courier New;font-size:130%;"><b>UPDATE COMPLAINT</b></p>

<table class="table">
    <tr>
        <td><p style="color:#bc0000;font-family:Arial;margin-left:6%;" ><b>COMPLAINT ID </b></p></td>
        <td><p style="margin-left:6%;"><?php echo $complaintID; ?></p></td>
    </tr>
    <tr>
        <td><p style="color:#bc0000;font-family:Arial;margin-left:6%;" ><b>ORDER ID </b></p></td>
        <td><p style="margin-left:6%;"><?php echo $order_ID; ?></p></td>
    </tr>
    <tr>
        <td><p style="color:#bc0000;font-family:Arial;margin-left:6%;" ><b>ORDER DATE </b></p></td>
        <td><p style="margin-left:6%;"><?php echo $orderDate; ?></p></td>
    </tr>
    <tr>
        <td><p style="color:#bc0000;font-family:Arial;margin-left:6%;" ><b>ORDER TIME </b></p></td>
        <td><p style="margin-left:6%;"><?php echo $orderTime; ?></p></td>
    </tr>
    <tr>
        <td><p style="color:#bc0000;font-family:Arial;margin-left:6%;"><b>COMPLAINT TYPE *</b><br></p></td>
        <td>
            <p style="color:black;font-family:Courier New;margin-left:6%;" >
            <b><input type="radio" name="complaintType" <?=strpos($complaintType, "LATE DELIVERY") !== false?'checked="checked"':'';?> value="LATE DELIVERY">Late Delivery<br>
            <input type="radio" name="complaintType" <?=strpos($complaintType, "DAMAGED FOOD") !== false?'checked="checked"':'';?> value="DAMAGED FOOD">Damaged Food<br>
            <input type="radio" name="complaintType" <?=strpos($complaintType, "BAD ATTITUDE") !== false?'checked="checked"':'';?> value="BAD ATTITUDE">Bad Attitude<br></b></p>
        </td>
    </tr>
    <tr>
        <td><p style="color:#bc0000;font-family:Arial;margin-left:6%;" ><b>DESCRIPTION *</b></p></td>
        <td><p style="margin-left:6%;"><textarea name = "complaintDesc" rows = "7" cols = "35" margin-left="6%" placeholder="DESCRIPTION" required><?php echo $complaintDesc;?></textarea></p></td>
    </tr>
    <tr>
        <td></td>
        <td><button style="font-family:Courier New;margin-left:100%;font-weight: bold; "type="submit" name="updateComplaint">UPDATE</button>
    </td>
</table>
<br><br>
</div>
</form>
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