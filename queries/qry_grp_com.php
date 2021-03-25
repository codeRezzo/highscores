<?php
//combat- Bar Version then the Pie version (Getting data)
$q_grp_com = "SELECT * FROM `cs_elo_primary` ORDER BY `elo` DESC LIMIT 10";
$qret_grp_com = mysqli_query($csdb_link, $q_grp_com);

$com_bar_elo=array();
$com_bar_name=array();
while($grp_row = mysqli_fetch_assoc($qret_grp_com)) {
    $com_bar_elo[] = $grp_row['elo'];
    $com_bar_name[] = $grp_row['name'];
}

mysqli_data_seek( $qret_grp_com, 0 );

$com_pie_elo=array();
$com_pie_name=array();
while($grp_row = mysqli_fetch_assoc($qret_grp_com)) {
  $com_pie_elo[] = $grp_row['elo'];
  $com_pie_name[] = $grp_row['name'];
}
?>