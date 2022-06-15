<!-- indexLogin.php -->
<!-- Interface for user to login. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <br><br><br>
    <img src="../resources/../resources/ump logo.png" width="200" height="200" id="UMPlogo">
    <img src="../resources/foody logo.png" width="200" height="200" id="Foodylogo">
    <form action="login.php" method="post">

    <?php if (isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <div class="login">
        <input type="text" placeholder="Enter Username" name="uname">
        <input type="password" placeholder="Enter Password" name="pass">
        <select id="genU" name="genUser">
            <option value="General User">General User (UMP Staff or Student)</option>
            <option value="Admin">Administrator</option>
            <option value="Restaurant Owner">Restaurant Owner</option>
            <option value="Rider">Rider</option>
        </select>
        <button type="submit">Login</button>
        <a href="userRegistration.php">Sign Up!</a>
    </div>
    </form>
</body>
</html>