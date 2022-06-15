<!-- searchUser.php -->
<!-- Interface of display searched user. -->
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List Page</title>
    <script src="user.js"></script>
    <link rel="icon" href="../resources/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        table, th, td {
            border: 2px solid black;
            border-collapse: collapse;
            padding: 10px 10px;
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
    <a class="active" href="userList.php">User List</a>
    <a href="createNewUser.php">Create User</a>
    <a href="userReport.php">User Report</a>
    <a href="../complaint/IndexAdminViewComplaint.php">Complaint List</a>
    <a href="../complaint/complaintReport.php">Complaint Report</a>
    <script src="../js/logout.js"></script>
    <a href="javascript:void(0);" onclick="return logout();">Logout</a>
    </nav>
    <a><img src="../resources/../resources/profile.jpg" alt="profile" width="80" height="80"></a>
    <br>
    <h3>Off Oven, On Doorstep</h3>

<div STYLE="background-color:#000000; height:3px; width:100%;"></div>
<br>

</header>

<body>
    <h2 align="center">
        <br><b>User List</b>
    </h2>

    <?php
    include("../db/db.php");

    if(isset($_POST['search'])){
        extract($_POST);
        $query="SELECT * FROM user WHERE region='$Reg' AND userType='$Utype'";
        $result = mysqli_query($conn, $query);
        echo "<table>";
        echo "<tr>" . "<th>Username</th>" . "<th>Password</th>" . "<th>Name</th>" . "<th>Address</th>" . "<th>Region</th>" . "<th>Phone Number</th>" . "<th>Email Address</th>" . "<th>User Type</th>" . "<th>Action</th>" . "</tr>";
        if (mysqli_num_rows($result) > 0){  
            // output data of each row
            while($row = mysqli_fetch_assoc($result)){
            $id = $row["user_id"];
            $Uname = $row["username"];
            $Pass = $row["password"];
            $Name = $row["name"];
            $Add = $row["address"];
            $Reg = $row["region"];
            $PhoneNum = $row["phoneNum"];
            $EmailAdd = $row["emailAdd"];
            $Utype = $row["userType"];
            
            echo "<tr><td>" . 
            htmlspecialchars($row['username']) . "</td><td>" . 
            htmlspecialchars($row['password']) . "</td><td>" . 
            htmlspecialchars($row['name']) . "</td><td>" .
            htmlspecialchars($row['address']) . "</td><td>" .
            htmlspecialchars($row['region']) . "</td><td>" .
            htmlspecialchars($row['phoneNum']) . "</td><td>" .
            htmlspecialchars($row['emailAdd']) . "</td><td>" .
            htmlspecialchars($row['userType']) . "</td><td>" .
            "<a href='updateProfile.php?id=$id'><button>Update</button></a> <br><br> <a href='delete.php?id=$id'><button>Delete</button></a>" . "</td></tr>";
            }              
        }else {
            echo "0 results";
        }
        echo "</table>";
        mysqli_close($conn);
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