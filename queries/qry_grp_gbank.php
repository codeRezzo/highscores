<?php
//Gang Bank - Bar Version then the Pie version (Getting data)
$q_gbank = "SELECT * FROM `cs_gangs` ORDER BY `gang_bank` DESC LIMIT 10";
$qret_gbank = mysqli_query($csdb_link, $q_gbank);

$gbank_bar_bank=array();
$gbank_bar_name=array();
while($grp_row = mysqli_fetch_assoc($qret_gbank )) {
    $gbank_bar_bank[] = $grp_row['gang_bank'];
    $gbank_bar_name[] = $grp_row['gang_name'];
}

mysqli_data_seek( $qret_gbank, 0 );

$gbank_pie_bank=array();
$gbank_pie_name=array();
while($grp_row = mysqli_fetch_assoc($qret_gbank)) {
  $gbank_pie_bank[] = $grp_row['gang_bank'];
  $gbank_pie_name[] = $grp_row['gang_name'];
}
?>