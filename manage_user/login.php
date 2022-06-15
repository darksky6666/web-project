<!--login.php-->
<!-- To validate username, password and userType using session. -->

<?php 
session_start(); 
include "../db/db.php";
if (isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['genUser'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['pass']);
    $genUser = validate($_POST['genUser']);

    if (empty($uname)) {
        header("Location: indexLogin.php?error=Username is required!");
        exit();

    }else if(empty($pass)){
        header("Location: indexLogin.php?error=Password is required!");
        exit();

    }else{
        $sql = "SELECT * FROM `user` WHERE username='".$uname."' AND password='".$pass."' AND userType='".$genUser."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass && $row['userType'] === $genUser ) {
                echo "Logged in!";
                $_SESSION['logged_in'] = true;
                if($genUser=="Admin"){ 
                    header("Location: userList.php");
                    exit();
                }
                elseif($genUser=="General User"){
                    $_SESSION['username']=$uname;
                    header("Location: ../general_user/resList.php");
                    exit();
                }
                elseif($genUser=="Restaurant Owner"){
                    $_SESSION['RO_username']=$uname;
                    header("Location: ../restaurant_owner/ro_dashboard.php");
                    exit();
                }
                else{
                    $_SESSION['rider_username']=$uname;
                    header("Location: ../rider/index.php");
                    exit();
                }
            }else{
                header("Location: indexLogin.php?error=Incorect Username/Password/UserType!");
                exit();
            }

        }else{
            header("Location: indexLogin.php?error=Incorect Username/Password/UserType!");
            exit();
        }
    }

}else{
    header("Location: indexLogin.php");
    exit();
}