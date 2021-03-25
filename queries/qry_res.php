<?php
//Respect
$q_res = "SELECT * FROM `cs_expresp_ladder` WHERE `respect` < '500000' ORDER BY `respect` DESC LIMIT 25";
$qret_res = mysqli_query($csdb_link, $q_res);

while($res_row = mysqli_fetch_array($qret_res)){ 
  $res_topname = $res_row['name']; 
  $res_toppoints = number_format($res_row['respect'],0); 
  break; 
}
mysqli_data_seek( $qret_res, 0 );
?>
