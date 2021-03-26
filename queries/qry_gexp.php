<?php
//Gang Respect
$q_gexp = "SELECT * FROM `cs_gangs` ORDER BY `gang_experience` DESC LIMIT 25";
$qret_gexp = mysqli_query($csdb_link, $q_gexp);

while($gexp_row = mysqli_fetch_array($qret_gexp)){ 
  $gexp_topgang = $gexp_row['gang_name'];
  $gexp_topexperience =number_format( $gexp_row['gang_experience']); 
  break; 
}
//reset locaion in array.
mysqli_data_seek($qret_gexp, 0);
?>