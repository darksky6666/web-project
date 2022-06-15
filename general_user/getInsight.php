<?php 

$year=substr($monthSelector,0,4);
$month=substr($monthSelector,5,2);
$dayNum=cal_days_in_month(CAL_GREGORIAN,(int)$month,(int)$year);

// Total Price
$query="SELECT SUM(`totalPayment`), WEEK(`orderDate`) FROM `order_list` WHERE MONTH(`orderDate`)='$month' AND YEAR(`orderDate`)='$year' GROUP BY WEEK(`orderDate`) ORDER BY `orderDate` ASC;";
$result=mysqli_query($conn,$query) or die(mysqli_error($conn));

$totalPayment=array();
$week=array();
$w=4;

while ($w-- > 0 && $rowSum=mysqli_fetch_array($result)) {
    array_push($totalPayment,$rowSum['SUM(`totalPayment`)']);
    array_push($week,$rowSum['WEEK(`orderDate`)']);
}

$query2="SELECT `totalPayment` FROM `order_list` WHERE MONTH(`orderDate`)='$month' AND YEAR(`orderDate`)='$year' ";
$result2=mysqli_query($conn,$query2) or die(mysqli_error($conn));
$expenses=array();
while ($row=mysqli_fetch_array($result2)) {
    array_push($expenses, $row['totalPayment']);
}
?>