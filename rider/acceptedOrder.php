<?php
session_start();
$_SESSION['rider_username']="";
$rider_username=$_SESSION['rider_username'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Note List</title>
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
      table, th, td {
        border: 2px solid black;
        border-collapse: collapse;
        padding: 10px 10px;
    }

      table {
        border-collapse: collapse;
        border: 1px solid;
        margin-left: auto;
        margin-right: auto;
    }

      th {
        background-color: skyblue;
    }

      .back {
            float: left;
            padding: 5px;
            margin-left: 0px;
            margin-right:50px;
    }

    </style>
  </head>

  <script>
      function checklogout() {
        return confirm('Are you sure to Logout?');
      }
  </script>

  <header class="wrapper">
        <img src="../resources/ump logo.png" alt="UMP" width="100" height="100">
        <img src="../resources/foody logo.png" alt="Foody" width="100" height="100">
        <nav>
        <a class="active" href="index.php">Delivery Note</a> 
        <a href="deliveryRecord.php">Delivery Record</a> 
        <a href="riderReport.php">Rider Report</a>
        <a href="logout.php" onclick="return checklogout()">Logout</a>
        </nav>
        <a href="profile.php"><img src="../resources/profile.jpg" alt="profile" width="80" height="80"></a>
        <br>
        <h3>Off Oven, On Doorstep</h3>

<div STYLE="background-color:#000000; height:3px; width:100%;"></div>
<br>

</header>


  <body>
    <h2 align="center">Accepted Order List</h2>

    <ol>
<?php
include("../db/db.php");



$query = "SELECT o.order_ID, o.orderDate, o.orderTime, o.orderStatus, u.name FROM order_list AS o, user AS u WHERE o.username = u.username AND o.rider_username = 'RU10001';";
$result = mysqli_query($conn,$query);
echo "<table>";
        echo "<tr>" . "<th>Order ID</th>" . "<th>Customer Name</th>" .
        "<th>Order Date</th>" . "<th>Order Time</th>" ."<th>Order Status</th>" ."<th>Rider Action</th>".  "</tr>";
if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)){
      $id = $row["order_ID"];
      $name = $row["name"];
      $orderDate = $row["orderDate"];
      $orderTime = $row["orderTime"];
      $orderStatus = $row["orderStatus"];
      $length = 5;
      $string = substr(str_repeat(0, $length).$id,-$length);
	 
        echo "<tr><td>". 
                "OL". $string . "</td><td>" . 
                $row['name'] . "</td><td>" .
                $row['orderDate'] . "</td><td>" .
                $row['orderTime'] . "</td><td>" .
                $row['orderStatus'] . "</td><td>" .
                "<a href='deliveryNote.php?id=$id'>" .
                '<button style="margin-left:10%; "type="submit" name="view">View Order Details</button>' .
                '</a>' .
                "</td></tr>";
            }
        }
        else {
            echo "No result found.";
        }
        echo "</table>";
?>
<form action="index.php">
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
