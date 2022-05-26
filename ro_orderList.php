<?php
include './db/db.php';
$sql="SELECT * FROM `order_list`;";
$result=mysqli_query($con,$sql) or die (mysqli_error());
$rowcount=mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody</title>
    <link rel="icon" href="./resources/favicon.png">
    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <header class="wrapper">
        <img src="resources/umplogo.png" alt="UMP" width="5%">
        <img src="resources/foodylogo.png" alt="Foody" width="5%">
        <nav>
            <a href="ro_menuList.php">Menu List</a>
            <a href="ro_restaurantDetails.php">Restaurant Details</a>
            <a href="ro_orderList.php">Order List</a>
            <a href="#">Restaurant Report</a>
            <a href="#">Logout</a>
        </nav>
        <img src="resources/profile.jpg" alt="profile" width="5%">
        <br>
        <h3 class="center-text">Off Oven, On Doorstep</h3>
    </header>

    
    <form action="" method="post">
    <div class="wrapper">

        <div>
            <span>Filter: </span>
            <input type="button" value="Canceled">
            <input type="button" value="Prepared">
            <input type="button" value="Ordered">
        </div>
    <div class="cards">
        <?php
        if($rowcount>0){
            while ($row=mysqli_fetch_assoc($result)) {
            // echo $row['order_id'];
            }
        } else {
            //echo "No data found";
        }
        ?>

        <!-- First data -->
        <div class="card">
            <div class="cardHighlight border-radius-top">
                <p>Name: <span class="text-bold">Wong Yi Bo</span></p>
                <br>
                <p>Address: <span class="text-bold">Residen Pelajar 5, Blok A, Universiti Malaysia Pahang, Kampus Pekan.</span></p>
            </div>
            <div class="cardContent bg-gy">
                <ul>
                    <li>Nasi Goreng Cina, 3</li>
                    <li>Guava Juice, 1</li>
                    <li>Ice Latte, 2</li>
                </ul>
            </div>
            <div class="cardStatus">
                <p>Status: <span class="text-bold">Ordered</span> </p>
            </div>
            <div class="cardInfo border-radius-bottom">
                <input type="submit" value="Prepared">
                <input type="submit" value="Cancel">
            </div>
        </div>

        <!-- Second data -->
        <div class="card">
            <div class="cardHighlight border-radius-top">
                <p>Name: <span class="text-bold">Zulkifli bin Salleh</span></p>
                <br>
                <p>Address: <span class="text-bold">No 2A, Jalan Megah,Taman Sri Impian, Pekan Pahang</span></p>
            </div>
            <div class="cardContent bg-gy">
                <ul>
                    <li>Nasi Goreng Pataya, 2</li>
                    <li>Chicken Chop, 1</li>
                    <li>Mocha Ice Blended, 1</li>
                    <li>Milo Dinosaur, 2</li>
                </ul>
            </div>
            <div class="cardStatus">
                <p>Status: <span class="text-bold">Ordered</span> </p>
            </div>
            <div class="cardInfo border-radius-bottom">
                <input type="submit" value="Prepared">
                <input type="submit" value="Cancel">
            </div>
        </div>

        <!-- Third data -->
        <div class="card">
            <div class="cardHighlight border-radius-top">
                <p>Name: <span class="text-bold">Ajay A/L Darsh</span></p>
                <br>
                <p>Address: <span class="text-bold">Residen Pelajar 2, Blok C, Universiti Malaysia Pahang, Kampus Gambang.</span></p>
            </div>
            <div class="cardContent bg-gy">
                <ul>
                    <li>Bihun Goreng, 3</li>
                    <li>Teh Beng, 2</li>
                </ul>
            </div>
            <div class="cardStatus">
                <p>Status: <span class="text-bold">Ordered</span> </p>
            </div>
            <div class="cardInfo border-radius-bottom">
                <input type="submit" value="Prepared">
                <input type="submit" value="Cancel">
            </div>
        </div>
        
    </div>
    <br>
    <br>
    </div>
</form>

    <footer class="wrapper">
        <div>
            <p style="font-size: 20px;"> <b>About Foody</b> </p>
            <div>
                <a href="#" class="fa fa-facebook fa-lg"></a>
                <a href="#" class="fa fa-instagram fa-lg"></a>
            </div>
        </div>
        <br><i class="material-icons">location_on</i>
        <p> Universiti Malaysia Pahang 26600 Pekan Pahang, Malaysia. </p>
        <br><i class="material-icons">local_phone</i>
        <p> +609 431 5000 </p>
        <br><i class="material-icons">email</i>
        <p>pro@ump.edu.my </p>
    </footer>
</body>
</html>