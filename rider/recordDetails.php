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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="icon" href="../resources/favicon.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Record Details</title>
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

        .icon-text{
            display: inline-flex;
            align-items: center;
            padding:0 24px;
        }
        /**/ 

        * {
            box-sizing: border-box;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th{
            text-align: center;
            font-size: larger;
        }

        th, td {
            padding: 10px;
        }

        .alignRight {
            text-align: right;
        }

        .view {
            padding: 5px;

        }

        .back {
            padding: 5px;

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
        <a href="index.php">Delivery Note</a> 
        <a class="active" href="deliveryRecord.php">Delivery Record</a> 
        <a href="riderReport.php">Rider Report</a>
        <script src="../js/logout.js"></script>
        <a href="javascript:void(0);" onclick="return logout();">Logout</a>
        </nav>
        <a href="profile.php"><img src="../resources/profile.jpg" alt="profile" width="80" height="80"></a>
        <br>
        <h3>Off Oven, On Doorstep</h3>

<div STYLE="background-color:#000000; height:3px; width:100%;"></div>
<br>

</header>

<body>
<?php
include("../db/db.php");

$idURL = $_GET['id'];

$query = "SELECT d.delivery_ID, d.timeDelivered, o.order_ID, o.totalPayment, o.orderDate, o.orderTime, o.orderStatus, o.delLocation,
u.name, u.phoneNum, r.rdName, r.rdLocation, r.rdContactNo, 
m.foodName, od.orderQuantity, od.totalPrice FROM delivery AS d, order_list AS o, user AS u, res_details AS r, menu_list AS m, order_details AS od 
WHERE d.order_ID = o.order_ID AND od.menu_ID = m.menu_ID AND r.rd_ID = m.rd_ID 
AND o.username = u.username AND o.order_ID = '$idURL'";

$result = mysqli_query($conn,$query) or die ("Could not execute query in recordDetails.php");
$row = mysqli_fetch_assoc($result);

$id = $row["order_ID"];
$name = $row["name"];
$delLocation = $row["delLocation"];
$rdName = $row["rdName"];
$rdLocation = $row["rdLocation"];
$orderDate = $row["orderDate"];
$orderTime = $row["orderTime"];
$timeDelivered = $row["timeDelivered"];
$totalPayment = $row["totalPayment"];
$orderStatus = $row["orderStatus"];
$foodName = $row["foodName"];
$quantity = $row["orderQuantity"];
$totalPrice = $row["totalPrice"];
$length = 5;

//@mysql_free_result($result);
?>

    <h2 style="text-align: center">Completed Delivery Details</h2>
    <form action="viewComplaint.php?id=<?php echo $id; ?>" method="post">
            <table style="width:100%">
                <tr>
                <td>Order ID:OL<?php echo str_pad($id,$length,"0", STR_PAD_LEFT);?></td>
                <td class="alignRight">Date:<?php echo $orderDate; ?></td>
                <td class="alignRight">Time Ordered:<?php echo $orderTime; ?>
                <br>Time Delivered:<?php echo $timeDelivered; ?></td>
                </tr>
                <tr>
                    <td>Customer Name:<?php echo $name; ?></td>
                </tr>
                <tr>
                    <td colspan="3">Delivery Location:<br><?php echo $delLocation; ?></td>
                </tr>
                <tr>
                    <td colspan="3">Restaurant Name:<br><?php echo $rdName; ?></td>
                </tr>
                <tr>
                    <td colspan="3">Restaurant Address:<br><?php echo $rdLocation; ?></td>
                </tr>
                <tr>
                    <td><br>Ordered Item:</td>
                    <td class="alignRight">Quantity:</td>
                    <td class="alignRight">Total Price:</td>
                </tr>
                <?php
                $result2 = mysqli_query($conn,$query) or die ("Could not execute query in recordDetails.php");

                while ($row2 = mysqli_fetch_assoc($result2)) {
                $foodName = $row2["foodName"];
                $quantity = $row2["orderQuantity"];
                $totalPrice = $row2["totalPrice"];
                $format_categoryPrice = number_format($totalPrice, 2);
                $format_totalPayment = number_format($totalPayment, 2);
                ?>
                <tr>
                    <td><?php echo $foodName; ?></td>
                    <td class="alignRight"><?php echo $quantity; ?></td>
                    <td class="alignRight">RM<?php echo $format_categoryPrice; ?></td>
                </tr>
                <?php
                }
                 ?>
                    <td colspan="2" style="border-top: 1px solid #ddd">Total Payment:</td>
                    <td class="alignRight" style="border-top: 1px solid #ddd">RM<?php echo $format_totalPayment; ?></td>
                </tr>
            </table>
            <br><input type="submit" class="view" style="width:200px" name="viewComplaint" value="View Complaint">
        </form>
        <form action="deliveryRecord.php?id=<?php echo $id; ?>" method="post">
        <br><br><input type="submit" class="back" style="width:100px" name="backToRecordList" value="Back">
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