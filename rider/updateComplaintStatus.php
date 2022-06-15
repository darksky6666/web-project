<?php
session_start();
if (empty($_SESSION['logged_in'])) {
    header("Location: ../manage_user/indexLogin.php");
    exit();
}

include("../db/db.php");

$idURL = $_GET['id'];
$query = "SELECT o.order_ID, c.complaint_ID, c.complaintDate, c.complaintTime, c.complaintStatus, c.complaintType, c.complaintDesc, f.fDesc, f.fDate, f.fTime, u.name 
FROM complaint_list AS c, user AS u, order_list AS o, feedback AS f 
WHERE o.order_ID = f.order_ID AND c.order_ID = o.order_ID AND o.username = u.username 
AND o.order_ID = '$idURL'";

$result = mysqli_query($conn,$query) or die ("Could not execute query in updateComplaintStatus.php");
$row = mysqli_fetch_assoc($result);

$id = $row["order_ID"];
$complaint_ID = $row["complaint_ID"];
$name = $row["name"];
$fDesc = $row["fDesc"];
$fDate = $row["fDate"];
$fTime = $row["fTime"];
$complaintDate = $row["complaintDate"];
$complaintTime = $row["complaintTime"];
$complaintStatus = $row["complaintStatus"];
$complaintType = $row["complaintType"];
$complaintDesc = $row["complaintDesc"];
$length = 5;

//@mysql_free_result($result);
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
    <title>Update Complaint Status</title>
    <script>
        // Delete Confirmation 
        function checkDelete(){
            let deleteConfirm = confirm('Are you sure you want to remove this entry?\nThis process is not reversible.');
            if (deleteConfirm != true) {
                return false;
            }
            return true;
        }
    </script>
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
        
        .column {
            float: left;
            width: 70%;
            padding: 50px;
            padding-top: 5px;
            padding-bottom: 10px;
        }

        .column2 {
            float: left;
            width: 30%;
            padding: 50px;
            padding-left: 0px;
            padding-top: 5px;
            padding-bottom: 10px;
            
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        th{
            text-align: center;
            font-size: larger;
        }

        th, td {
            padding: 10px;
        }

        .complaintDesc {
            margin-left: 50px;
        }

        .border {
            border: 1px solid #ddd;
        }
        
        .margin {
            margin-left: 50px;
            margin-right:50px;
        }
        
        .button {
            float: left;
            padding: 5px;
            margin-left: 50px;
            margin-right:50px;
        }

        .delete {
            float: left;
            padding: 5px;
            margin-left: 50px;
        }

    </style>


</head>


<header class="wrapper">
        <img src="../resources/ump logo.png" alt="UMP" width="100" height="100">
        <img src="../resources/foody logo.png" alt="Foody" width="100" height="100">
        <nav>
        <a href="index.php">Pending Order</a> 
        <a href="acceptedOrder.php">Accepted Order</a> 
        <a class="active" href="deliveryRecord.php">Delivery Record</a> 
        <a href="riderReport.php">Rider Report</a>
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

    <h2 style="text-align: center">Complaint Details</h2>
    <div class="row">
        <div class="column">
            <table>
                <tr>
                    <td>Complaint ID: <b>CP<?php echo str_pad($complaint_ID,$length,"0", STR_PAD_LEFT);?></b></td>
                    <td>Complaint Date: <br><?php echo $complaintDate; ?></td>
                    <td>Complaint Time: <br><?php echo $complaintTime; ?></td>
                </tr>
                <tr>
                    <td>Ordered ID: OL<?php echo str_pad($id,$length,"0", STR_PAD_LEFT);?></td>
                </tr>
                <tr>
                    <td>Customer Name: <?php echo $name; ?></td>
                </tr>
                <tr>
                    <td>Complaint Type: <?php echo $complaintType; ?></td>
                </tr>
            </table>
        </div>
        <div class="column2">
            <table style="width:100%">
                <tr>
                <td style="border:1px solid grey">Complaint Status:<br><b style="font-size: xx-large"><?php echo $complaintStatus; ?></b></td>
                </tr>
            </table>
            <br>
            <form action="updateCS-DB.php?id=<?php echo $id; ?>" method="post">
                    <input type="submit" style="width:300px"  name="resolved" value="Update Complaint Status to RESOLVED">
            </form>
        </div>

    </div>
    <div>
        <div class="margin">
            <table style="width:100%">
                <tr>
                    <td colspan="3" style="border-bottom: 1px solid #ddd">Complaint Description:</td>
                </tr>
                <tr>
                    <td colspan="3" class="border"><?php echo $complaintDesc; ?><br><br></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td colspan="3">Feedback:</td>
                </tr>
                <tr>
                    <td colspan="3" style="border: 1px solid black"><?php echo $fDesc; ?><br><br></td>
                </tr>
            </table>

            <form action="editFeedback.php?id=<?php echo $id; ?>" method="post">
         </div>
    </div>
        <br><input type ="submit" class="button" style="width:150px" name="edit" value="Edit Feedback">
            </form>

            <form action="deleteDB.php" method="post" onsubmit="return checkDelete();">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type ="submit" class="delete" style="width:150px" name="delete" value="Delete Feedback">
            </form>

        <form action="deliveryRecord.php?id=<?php echo $id; ?>" method="post">
            <br><br><br><br><input type="submit" class="button" style="width:200px" name="backToViewComplaint" value="Back to Delivery Record List">
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