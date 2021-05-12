<?php 
include('../connect.php');

//Snapshot the and calculate database information for snapshot.
$q_ser_his_setup= "SELECT 
COUNT(`cash`) as PlayerCount,
sum(`cash`) as TotalCash,
sum(`bank`) as TotalBank, 
sum(`income`) as TotalIncome,
sum(`minutes`) as TotalMinutes
FROM `bluerp_players`
WHERE `minutes` > 0 
AND `bank` > 0 
AND `income` < 5000;";
$qret_ser_his_setup = mysqli_query($cold_link, $q_ser_his_setup);

//Get date Y-M-D
$SnapshotDate = date("Y-m-d");

//Not all stats will be tracks off the bat, for now we're focusing on players.

while($elm = mysqli_fetch_array($qret_ser_his_setup)){
//Active Values
$PlayerCount = $elm['PlayerCount'];
$TotalCash = $elm['TotalCash'];
$TotalBank = $elm['TotalBank'];
$TotalIncome = $elm['TotalIncome'];
$TotalMinutes = $elm['TotalMinutes'];
$TotalHours_prev = $TotalMinutes / 60;
$TotalHours = floor($TotalHours_prev);

//Inactive Values (Set to 0 by default)
$TotalLock = 0;
$Totallockvalue = 0;
$TotalItemValue = 0;
}

$update = 'INSERT INTO `hs_globalhistory`(`PlayerCount`, `Totalmoneybanked`, `Totalmoneyheld`, `TotalIncome`, `TotalLock`, `Totallockvalue`, `Totalhours`, `TotalItemValue`) 
                            VALUES ('.$PlayerCount.','.$TotalBank.','.$TotalCash.','.$TotalIncome.','.$TotalLock.','.$Totallockvalue.','.$TotalHours.','.$TotalItemValue .')';
mysqli_query($local_link, $update);
?>
