<?php
//Dueling
$q_due = "SELECT bluerp_players.steam_id, bluerp_players.username, bluerp_dmstats.wins, bluerp_dmstats.losses, bluerp_dmstats.total_dms, bluerp_dmstats.kills, bluerp_dmstats.deaths FROM bluerp_players INNER JOIN bluerp_dmstats ON bluerp_players.steam_id=bluerp_dmstats.steam_id ORDER BY bluerp_dmstats.wins DESC LIMIT 25";
$qret_due = mysqli_query($cold_link, $q_due);

while($due_row = mysqli_fetch_array($qret_due)){ 
  $due_topname = $due_row['username']; 
  $due_topwins = number_format($due_row['wins'],0); 
  break; 
}
mysqli_data_seek( $qret_due, 0 );
?>