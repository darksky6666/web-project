<?php 
include '../db/db.php';

$year=substr($monthSelector,0,4);
$month=substr($monthSelector,5,2);
include '../db/day.php';
$dayNum=days_in_month((int)$month,(int)$year);

// Total Amount
$sqlAmount="SELECT COUNT(`order_ID`), WEEK(`orderDate`), SUM(`totalPayment`) FROM `order_list` WHERE MONTH(`orderDate`)='$month' AND YEAR(`orderDate`)='$year' GROUP BY WEEK(`orderDate`) ORDER BY `orderDate` ASC;";
$resultAmount=mysqli_query($conn,$sqlAmount) or die(mysqli_error($conn));

$totalPayment=array();
$week=array();
$w=4;
while ($w-- > 0 && $rowAmount=mysqli_fetch_array($resultAmount)) {
    array_push($totalPayment,$rowAmount['SUM(`totalPayment`)']);
    array_push($week,$rowAmount['WEEK(`orderDate`)']);
}


// Total accumulated payment
$sqlAccumulated="SELECT MONTH(`orderDate`), SUM(`totalPayment`) FROM `order_list` GROUP BY MONTH(`orderDate`) ORDER BY `orderDate` ASC";
$resultAccumulated=mysqli_query($conn,$sqlAccumulated) or die(mysqli_error($conn));

$monthAccumulated=array();
$accumulatedPayment=array();

while ($rowAccumulated=mysqli_fetch_array($resultAccumulated)) {
    array_push($monthAccumulated,$rowAccumulated['MONTH(`orderDate`)']);
    array_push($accumulatedPayment,$rowAccumulated['SUM(`totalPayment`)']);
}
?>