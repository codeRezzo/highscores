<?php 
//Previously I would do one query per graph, but now this one file will;
//process the information for all global history graphs at once.
$q_ser_global = "SELECT * FROM `hs_globalhistory` ORDER BY `SnapshotDate` DESC LIMIT 30";
$qret_ser_global  = mysqli_query($local_link, $q_ser_global);

//set all arrays
$ser_his_date=array();
$ser_his_bank=array();
$ser_his_playtime=array();
$ser_his_playercount=array();

//process
while($grp_row = mysqli_fetch_assoc($qret_ser_global)) {
  $ser_his_date[] = $grp_row['SnapshotDate'];
  $ser_his_bank[] = $grp_row['Totalmoneybanked'];
  $ser_his_playtime[] = $grp_row['Totalhours'];
  $ser_his_playercount[] = $grp_row['PlayerCount'];
}

//encode for future printing.
json_encode($ser_his_date);
json_encode($ser_his_bank);
json_encode($ser_his_playtime);
json_encode($ser_his_playercount);

mysqli_data_seek($qret_ser_global, 0);
?>
