<?php
     include("../db/db.php");
     extract ($_POST);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Foody System-Search Restaurant</title>
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

        #search {
          padding: 8px;
          font-size: 15px;
          border: 1px solid black;
        }

        .search-container button {
            background: #ddd;
            font-size: 10px;
            border: none;
            cursor: pointer;
        }

        .search-container button:hover {
            background: #ccc;
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
        <a class="active" href="resList.php">Restaurant List</a> 
        <a href="orderList.php">Order List</a> 
        <a href="expensesReport.php">Expenses Report</a>
        <a href="UserViewComplaint.php">My Complaint</a>
        <a href="logout.php" onclick="return checklogout()">Logout</a>
        </nav>
        <a><img src="../resources/profile.jpg" alt="profile" width="80" height="80"></a>
        <br>
        <h3>Off Oven, On Doorstep</h3>

<div STYLE="background-color:#000000; height:3px; width:100%;"></div>
<br>

</header>

  <body>
  <h2 style="font-family:arial;">Restaurant List</h2>
  <div class="search-container">
    <form action="search.php" method="post">
      <input type="text" placeholder="Search Restaurant Name..." name="rName" id="search">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
    <?php
    $query = "SELECT * FROM `res_details` WHERE `rdName` LIKE '$rName%'";
    $result = mysqli_query($conn,$query);

      if(mysqli_num_rows($result)>0){
          while ($row=mysqli_fetch_assoc($result)) {
          $rdPhoto = $row["rdPhoto"];
          $rdName = $row["rdName"];
          $cuisinesType = $row["cuisinesType"];
          $varietyType = $row["varietyType"];
    ?>
        <table style="width:50%">
          <tr>
            <td>
              <h3><b><?php echo $rdName; ?></b></h3>
              <img class="image" src="../resources/<?php echo $rdPhoto; ?>" alt="<?php echo $rdName; ?>"><br>
              <?php echo $cuisinesType; ?><br><br>
              <?php echo $varietyType; ?><br><br>
              <button onclick="document.location='orderPage.php?rName=<?php echo $rdName; ?>'">Order</button>
              <button onclick="document.location='resList.php?rName=<?php echo $rdName; ?>'">Back</button>
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
