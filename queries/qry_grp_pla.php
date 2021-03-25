<?php
//Playtime - Bar Version then the Pie version (Getting data)
$q_grp_pla = "SELECT * FROM `cs_banks_primary` WHERE `steam_id` != 'STEAM_0:1:25306470' ORDER BY `minutes` DESC LIMIT 10";
$qret_grp_pla = mysqli_query($csdb_link, $q_grp_pla);

$pla_bar_min=array();
$pla_bar_name=array();
while($grp_row = mysqli_fetch_assoc($qret_grp_pla)) {
    $pla_bar_min[] = $grp_row['minutes'];
    $pla_bar_name[] = $grp_row['name'];
}

mysqli_data_seek( $qret_grp_pla, 0 );

$pla_pie_min=array();
$pla_pie_name=array();
while($grp_row = mysqli_fetch_assoc($qret_grp_pla)) {
  $pla_pie_min[] = $grp_row['minutes'];
  $pla_pie_name[] = $grp_row['name'];
}
?>