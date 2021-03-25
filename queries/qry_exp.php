<?php
//Experience
$q_exp = "SELECT * FROM `cs_expresp_ladder` WHERE `experience` < '500000' ORDER BY `experience` DESC LIMIT 25";
$qret_exp = mysqli_query($csdb_link, $q_exp);

while($exp_row = mysqli_fetch_array($qret_exp)){ 
  $exp_topname = $exp_row['name']; 
  $exp_toppoints = number_format($exp_row['experience'],0); 
  break; 
}
mysqli_data_seek( $qret_exp, 0 );
?>
