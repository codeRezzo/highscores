<?php
//Economy
$q_eco =   "SELECT cs_banks_primary.steam_id, cs_banks_primary.cash, cs_banks_primary.bank, cs_banks_primary.income, cs_banks_secondary.cash, cs_banks_secondary.bank,cs_banks_secondary.income, cs_banks_primary.name FROM cs_banks_primary INNER JOIN cs_banks_secondary ON cs_banks_primary.steam_id=cs_banks_secondary.steam_id ORDER BY cs_banks_primary.bank DESC LIMIT 25";
$qret_eco = mysqli_query($csdb_link, $q_eco);

while($eco_row = mysqli_fetch_array($qret_eco)){ 
  $eco_topname = $eco_row['name'];
  $eco_topbank =number_format( $eco_row['bank']); 
  break; 
}
//reset locaion in array.
mysqli_data_seek($qret_eco, 0 );
?>