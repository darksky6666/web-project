<?php
include '../db/db.php';
session_start();
if (empty($_SESSION['logged_in'])) {
    header("Location: ../manage_user/indexLogin.php");
    exit();
}
$RO_username=$_SESSION['RO_username'];

$testLoc="../resources/restaurant/$RO_username";

// Create dir for restaurant owner if not exist
if (!is_dir($testLoc)) {
    mkdir($testLoc, '0777', true);
    copy("../resources/restaurant/no-image.png", "../resources/restaurant/$RO_username/no-image.png");
}

$sql="SELECT * FROM `res_details` WHERE RO_username='$RO_username';";
$result = mysqli_query($conn, $sql) or die (mysqli_error());
$row = mysqli_fetch_array($result);
$numRow = mysqli_num_rows($result);


$id = $row['rd_ID'] ?? NULL;
$rdName = $row['rdName']  ?? NULL;
$rdLocation = $row['rdLocation'] ?? NULL;
$rdOpTime = $row['rdOpTime'] ?? NULL;
$rdContactNo = $row['rdContactNo'] ?? NULL;
$cuisinesType = $row['cuisinesType'] ?? NULL;
$varietyType = $row['varietyType'] ?? NULL;
$rdPhoto = $row['rdPhoto'] ?? "no-image.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody</title>
    <link rel="icon" href="../resources/favicon.png">
    <script src="../js/menu.js"></script>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/header_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <header class="wrapper">
        <img src="../resources/ump logo.png" alt="UMP" width="5%">
        <img src="../resources/foody logo.png" alt="Foody" width="5%">
        <nav>
            <a href="ro_dashboard.php">Dashboard</a>
            <a href="ro_menuList.php">Menu List</a>
            <a class="active" href="ro_restaurantDetails.php">Restaurant Details</a>
            <a href="ro_orderList.php">Order List</a>
            <a href="ro_report.php">Restaurant Report</a>
            <script src="../js/logout.js"></script>
            <a href="javascript:void(0);" onclick="return logout();">Logout</a>
        </nav>
        <img src="../resources/profile.jpg" alt="profile" width="5%">
        <br>
        <h3 class="center-text">Off Oven, On Doorstep</h3>
    </header>

    <div class="wrapper">
        <br>
        <h3 style="text-align: center;">Manage Restaurant Details</h3>
        <?php
            if ($numRow == 0) {
                echo('<h4 class="error" style="text-align: center;">No Restaurant Details Found</h4>');
                echo('<h4 class="error" style="text-align: center;">Please add your restaurant detaiils.</h4>');
            }
        ?>
        <br>
        <br>
        <?php
            if ($numRow > 0) {
                echo("<form action='../db/updatedb.php?id=$id&action=rDetails' name='resForm' method='post' enctype='multipart/form-data'>");
            }
            else {
                echo("<form action='../db/updatedb.php?action=rDetailsAdd' name='resForm' method='post' enctype='multipart/form-data'>");
            }
        ?>
        
            <div class="con-table">
            <table class="table-border">
                <tr>
                    <td class="t-border th">Name</td>
                    <td class="t-border col-20"><input type="text" required name="rdName" size="23px" value="<?php echo $rdName ?>">
                    <span class="error">*</span>
                </td>
                </tr>
                <tr>
                    <td class="t-border th">Address</td>
                    <td class="t-border col-20"><textarea name="rdLocation"  required cols="25" rows="5"><?php echo $rdLocation ?></textarea>
                    <span class="error">*</span>
                </td>
                </tr>
                <tr>
                    <td class="t-border th">Operating Time</td>
                    <td class="t-border col-20"><input type="text"  required placeholder="10:00 AM - 08:00 PM" pattern="(1[012]|[1-9]):[0-5][0-9](\\s)?(?i)(AM|PM) - (1[012]|[1-9]):[0-5][0-9](\\s)?(?i)(AM|PM)" name="rdOpTime" size="23px" value="<?php echo $rdOpTime ?>">
                    <span class="error">*</span>
                </td>
                </tr>
                <tr>
                    <td class="t-border th">Contact No</td>
                    <td class="t-border col-20"><input type="tel"  required placeholder="0123456789" pattern="[0-9]{2,3}-*[0-9]{7,8}" name="rdContactNo" size="23px" value="<?php echo $rdContactNo ?>">
                    <span class="error">*</span>
                </td>
                </tr>
                <tr>
                    <td class="t-border th">Cuisine Type</td>
                    <td class="t-border col-20"><select name="cuisinesType" required style="width: 200px;">
                        <option <?=strpos($cuisinesType, "Rice Noodles") !== false?'selected="selected"':'';?> value="Rice Noodles">Rice Noodles</option>
                        <option <?=strpos($cuisinesType, "Malaysian Food") !== false?'selected="selected"':'';?> value="Malaysian Food">Malaysian Food</option>
                        <option <?=strpos($cuisinesType, "Western") !== false?'selected="selected"':'';?> value="Western">Western</option>
                        <option <?=strpos($cuisinesType, "Thai") !== false?'selected="selected"':'';?> value="Thai">Thai</option>
                        <option <?=strpos($cuisinesType, "Beverages") !== false?'selected="selected"':'';?> value="Beverages">Beverages</option>
                        <option <?=strpos($cuisinesType, "Fast Food") !== false?'selected="selected"':'';?> value="Fast Food">Fast Food</option>
                    </select>
                    <span class="error">*</span>
                </td>
                </tr>
                <tr>
                    <td class="t-border th">Variety Type</td>
                    <td class="t-border col-20"><select name="varietyType" required style="width: 200px;">
                        <option <?=strpos($varietyType, "Halal") !== false?'selected="selected"':'';?> value="Halal">Halal</option>
                        <option <?=strpos($varietyType, "Non-Halal") !== false?'selected="selected"':'';?> value="Non-Halal">Non-Halal</option>
                    </select>
                    <span class="error">*</span>
                </td>
                </tr>
                <tr>
                    <td class="t-border th">Photo</td>
                    <td class="t-border col-20">
                        <img id="image" style="padding-right: 10px; object-fit: fill; width: 70%" src="../resources/restaurant/<?php echo $RO_username ?>/<?php echo $rdPhoto; ?>" alt="<?php echo $rdPhoto; ?>">
                        <br>
                        <br>
                        <br>
                        <br>
                        <input style="float: left;" type="file" name="rdPhoto" id="rdPhoto" accept="image/png, image/jpeg" onchange="previewImg(this)">
                        <br>
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <br>
            <input type="hidden" name="RO_username" value="<?php echo $RO_username ?>">
            <?php
                if ($numRow > 0) {
            ?>
                    <input type="hidden" name="oldPhoto" value="<?php echo $rdPhoto ?>">
            <?php
                    echo("<input type='submit' class='btn' style='left: 50%;' value='Update'>");
                }
                else {
                    echo("<input type='submit' class='btn' style='left: 50%;' value='Add'>");
                }
            ?>
        </form>
    </div>

    <footer class="wrapper">
        <div>
            <p style="font-size: 20px;"> <b>About Foody</b> </p>
            <div>
                <a href="#" class="fa fa-facebook fa-lg"></a>
                <a href="#" class="fa fa-instagram fa-lg"></a>
            </div>
        </div>
        <br><i class="material-icons">location_on</i>
        <span class="icon-text"> Universiti Malaysia Pahang 26600 Pekan Pahang, Malaysia. </span>
        <br><i class="material-icons">local_phone</i>
        <span class="icon-text"> +609 431 5000 </span>
        <br><i class="material-icons">email</i>
        <span class="icon-text"> pro@ump.edu.my </span>
    </footer>
</body>
</html>