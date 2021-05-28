<?php
//Rust EXP Leaderboard
$q_rust_xp = "SELECT * FROM `hs_rust_main`ORDER BY `xp` DESC LIMIT 100";
$qret_rust_xp = mysqli_query($local_link, $q_rust_xp);

//Not being used yet, but when it is we'll be able to advertise the top xp player on the ladders panel.
/*
while($rust_xp_row = mysqli_fetch_array($qret_rust_xp)){ 
  $xp_topname = $rust_xp_row['sn']; 
  $res_topxp = number_format($rust_xp_row['xp'],0); 
  break; 
}
mysqli_data_seek($qret_rust_xp, 0 );
*/
?>
