<?php
//Gang Economy
$q_geco =   "SELECT * FROM `cs_gangs` ORDER BY `gang_bank` DESC LIMIT 25";
$qret_geco = mysqli_query($csdb_link, $q_geco);

while($geco_row = mysqli_fetch_array($qret_geco)){ 
  $geco_topgang = $geco_row['gang_name'];
  $geco_topbank =number_format( $geco_row['gang_bank']); 
  break; 
}
//reset locaion in array.
mysqli_data_seek($qret_geco, 0 );
?>