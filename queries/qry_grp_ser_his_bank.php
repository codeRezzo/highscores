<?php 
//Player Bank - Bar Version then the Pie version (Getting data)
$q_ser_bank = "SELECT * FROM `hs_globalhistory` ORDER BY `SnapshotDate` DESC LIMIT 30";
$qret_ser_bank = mysqli_query($local_link, $q_ser_bank);

$ser_his_date=array();
$ser_his_bank=array();
while($grp_row = mysqli_fetch_assoc($qret_ser_bank)) {
  $ser_his_date[] = $grp_row['SnapshotDate'];
  $ser_his_bank[] = $grp_row['Totalmoneybanked'];
}
mysqli_data_seek($qret_ser_bank, 0);
?>
