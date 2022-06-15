<?php
session_start();
if (empty($_SESSION['logged_in'])) {
    header("Location: ../manage_user/indexLogin.php");
    exit();
}
?>

<?php
$rName = $_GET['rName'];
$_SESSION["order"]=""
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foody System-Order Page</title>
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

        h2 {
          font-family:arial;
        }

        .image {
          width: 350px;
          height: 200px; 
          display: block;
          margin-left: auto;
          margin-right: auto;
         }

        table, td {
          border-collapse: collapse;
          border:1px solid black;
          padding: 10px;
          margin-left: auto;
          margin-right: auto;
        }

        td {
          text-align: center;
          vertical-align: middle;
        }

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
    <?php
    include("../db/db.php");
    $query1 = "SELECT * FROM `res_details` WHERE `rdName`='$rName'";
    $result1 = mysqli_query($conn,$query1);
     $row=mysqli_fetch_assoc($result1);
      $rdName = $row["rdName"];
      $rdContactNo = $row["rdContactNo"];
      $rdOpTime = $row["rdOpTime"];
      $rdLocation = $row["rdLocation"];
      $RO_username = $row["RO_username"];
      
      $rd_ID = $row["rd_ID"];
      $_SESSION['rd_ID']=$rd_ID;
    ?>
      <h2><?php echo $rdName; ?></h2>
      <p><?php printf ("Restaurant Contact No : %s", $rdContactNo); ?></p>
      <p><?php printf ("Operating Time        : %s", $rdOpTime); ?></p>
      <p><?php printf ("Restaurant Location   : %s", $rdLocation); ?></p>
      <hr>
      <h2>Menu List</h2>
    <?php
    $query2 = "SELECT m.menu_ID, m.foodPhoto, m.foodName, m.foodDesc, fc.categoryPrice FROM menu_list AS m, food_categories AS fc WHERE m.fc_ID = fc.fc_ID AND m.rd_ID='$rd_ID'";
    $result2 = mysqli_query($conn,$query2);
      if(mysqli_num_rows($result2)>0){
          while ($row=mysqli_fetch_assoc($result2)) {
          $menu_ID = $row["menu_ID"];
          $foodPhoto = $row["foodPhoto"];
          $foodName = $row["foodName"];
          $foodDesc = $row["foodDesc"];
          $categoryPrice = $row["categoryPrice"];
    ?>
        <table style="width:50%">
          <tr>
            <td>
              <img class="image" src="<?php echo $foodPhoto; ?>" alt="<?php echo $foodName; ?>"><br>
	      <h3><b><?php echo $foodName; ?></b></h3>
              <p><?php echo $foodDesc; ?></p>
              <p><?php printf ("RM %.2f", $categoryPrice); ?></p>
              <form action="insertFood.php" method="post">
              <input type="hidden" name="menu_ID" value="<?php echo $menu_ID; ?>">
              <input type="hidden" name="foodName" value="<?php echo $foodName; ?>">
              <input type="hidden" name="categoryPrice" value="<?php echo $categoryPrice; ?>">
              <input type="hidden" name="rdName" value="<?php echo $rdName; ?>">
              <input type="number" name="orderQuantity" min="1" max="10" value="1">
              <input type="submit" value="Add">
            </form>
           </td>
          </tr>
        </table>
      <?php
          }
      }
      else {
          echo "No data found";
      }
      ?>
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