<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Foody System-Order Details</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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

      </style>
  </head>

<script>
  function checklogout(){
    return confirm('Are you sure to Logout?');
  }
</script>

  <header class="wrapper">
  <img src="../resources/../resources/ump logo.png" alt="UMP" width="100" height="100">
        <img src="../resources/foody logo.png" alt="Foody" width="100" height="100">
        <nav>
        <a class="active" href="../general_user/resList.php">Restaurant List</a> 
        <a href="../general_user/checkout.php">Order List</a> 
        <a href="../general_user/expensesReport.php">Expenses Report</a>
        <a href="../complaint/UserViewComplaint.php">My Complaint</a>
        <script src="../js/logout.js"></script>
        <a href="javascript:void(0);" onclick="return logout();">Logout</a>
        </nav>
        <a href="#profile"><img src="../resources/../resources/profile.jpg" alt="profile" width="80" height="80"></a>
        <br>
        <h3>Off Oven, On Doorstep</h3>

  <div STYLE="background-color:#000000; height:3px; width:100%;"></div>
  <br>

  </header>

  <body>
  <h2 style="font-family:arial;">Order Details</h2>
<ol>
<?php
include("../db/db.php");
$order_ID = $_GET['order_ID'];
?>

<?php
$query = "SELECT m.menu_ID, m.foodName, od.orderQuantity, od.totalPrice FROM menu_list AS m, order_details AS od WHERE m.menu_ID = od.menu_ID AND od.order_ID = '$order_ID' ";
$result = mysqli_query($conn,$query);

$totalPayment = 0;

while ($row=mysqli_fetch_assoc($result)) {
    $menu_ID = $row["menu_ID"];
    $foodName = $row["foodName"];
    $orderQuantity = $row["orderQuantity"];
    $totalPrice = $row["totalPrice"];

    $totalPayment = $totalPayment + $totalPrice;
	?>
  
	<li>
	<?php echo $foodName; ?><br>
	<?php printf ("RM %.2f", $totalPrice); ?><br>
    </li>
	<?php
}
?>
</ol>
  <hr>
  <h3>Total Payment: <?php printf ("RM %.2f", $totalPayment); ?></h3>
  <hr>
  <form action="updateOrderList.php?order_ID=<?php echo $order_ID; ?>" method="post">
    <input type="hidden" name="totalPayment" value="<?php echo $totalPayment; ?>">
    <p>Delivery Location: <input type="text" name="delLocation"></p>
    <p>Payment Method: <input type="radio" name="pay" >Cash On Delivery (COD)</p>
    <input type="submit" value="Confirm">
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




