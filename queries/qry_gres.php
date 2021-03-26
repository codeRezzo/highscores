<?php
//Gang Respect
$q_gres = "SELECT * FROM `cs_gangs` ORDER BY `gang_respect` DESC LIMIT 25";
$qret_gres = mysqli_query($csdb_link, $q_gres);

while($gres_row = mysqli_fetch_array($qret_gres)){ 
  $gres_topgang = $gres_row['gang_name'];
  $gres_toprespect =number_format( $gres_row['gang_respect']); 
  break; 
}
//reset locaion in array.
mysqli_data_seek($qret_gres, 0);
?>