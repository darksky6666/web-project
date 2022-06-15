<?php 
include 'db.php';
$RO_username=$_SESSION['RO_username'];
$resultrdID = mysqli_query($conn, "SELECT `rd_ID` FROM `res_details` WHERE `RO_username`='$RO_username'") or die(mysqli_error());
$rowrdID=mysqli_fetch_assoc($resultrdID);
$rd_ID = $rowrdID['rd_ID'];

$year=substr($monthSelector,0,4);
$month=substr($monthSelector,5,2);
include 'day.php';
$dayNum=days_in_month((int)$month,(int)$year);

// Total Amount
$sqlAmount="SELECT COUNT(`order_ID`), WEEK(`orderDate`), SUM(`totalPayment`) FROM `order_list` WHERE `rd_ID`='$rd_ID' AND MONTH(`orderDate`)='$month' AND YEAR(`orderDate`)='$year' GROUP BY WEEK(`orderDate`) ORDER BY `orderDate` ASC;";
$resultAmount=mysqli_query($conn,$sqlAmount) or die(mysqli_error($conn));

$totalAmount=array();
$week=array();
$w=4;
while ($rowAmount=mysqli_fetch_array($resultAmount)) {
    array_push($totalAmount,$rowAmount['SUM(`totalPayment`)']);
    array_push($week,$rowAmount['WEEK(`orderDate`)']);
}

// Total order
$sqlOrder="SELECT COUNT(`order_ID`), `orderDate`, SUM(`totalPayment`) FROM `order_list` WHERE `rd_ID`='$rd_ID' AND MONTH(`orderDate`)='$month' AND YEAR(`orderDate`)='$year' GROUP BY `orderDate` ORDER BY `orderDate` ASC;";
$resultOrder=mysqli_query($conn,$sqlOrder) or die(mysqli_error($conn));

$totalOrder=array();
$orderDate=array();

while ($dayNum-- > 0 && $rowOrder=mysqli_fetch_array($resultOrder)) {
    array_push($orderDate, $rowOrder[1]);
    array_push($totalOrder, $rowOrder['COUNT(`order_ID`)']);
}

// Total accumulated payment
$sqlAccumulated="SELECT MONTH(`orderDate`), SUM(`totalPayment`) FROM `order_list` WHERE `rd_ID`='$rd_ID' GROUP BY MONTH(`orderDate`) ORDER BY `orderDate` ASC";
$resultAccumulated=mysqli_query($conn,$sqlAccumulated) or die(mysqli_error($conn));

$monthAccumulated=array();
$accumulatedPayment=array();

while ($rowAccumulated=mysqli_fetch_array($resultAccumulated)) {
    array_push($monthAccumulated,$rowAccumulated['MONTH(`orderDate`)']);
    array_push($accumulatedPayment,$rowAccumulated['SUM(`totalPayment`)']);
}
?>