<?php
//Combat
$q_com = "SELECT cs_elo_primary.steam_id, cs_elo_primary.elo, cs_elo_primary.kills, cs_elo_primary.deaths, cs_elo_secondary.elo, cs_elo_secondary.kills,cs_elo_secondary.deaths, cs_elo_primary.name FROM cs_elo_primary INNER JOIN cs_elo_secondary ON cs_elo_primary.steam_id=cs_elo_secondary.steam_id ORDER BY cs_elo_primary.elo DESC LIMIT 25";
$qret_com = mysqli_query($csdb_link, $q_com);
  
while($com_row = mysqli_fetch_array($qret_com)){ 
  $com_topname = $com_row['name']; 
  $com_topelo = number_format($com_row['1'],0); //targets the first elo column. (this is the primary elo table <latest snapshot>)
  break; 
}
mysqli_data_seek( $qret_com, 0 );
?>