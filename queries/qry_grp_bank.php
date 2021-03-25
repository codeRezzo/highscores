<?php 
//Player Bank - Bar Version then the Pie version (Getting data)
$q_bank = "SELECT * FROM `cs_banks_primary` ORDER BY `bank` DESC LIMIT 10";
$qret_bank = mysqli_query($csdb_link, $q_bank);

$pla_bar_bank=array();
$pla_bar_name=array();
while($grp_row = mysqli_fetch_assoc($qret_bank )) {
    $pla_bar_bank[] = $grp_row['bank'];
    $pla_bar_name[] = $grp_row['name'];
}

mysqli_data_seek( $qret_bank, 0 );

$pla_pie_bank=array();
$pla_pie_name=array();
while($grp_row = mysqli_fetch_assoc($qret_bank)) {
  $pla_pie_bank[] = $grp_row['bank'];
  $pla_pie_name[] = $grp_row['name'];
}
?>