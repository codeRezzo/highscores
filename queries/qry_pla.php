<?php
//Playtime
$q_pla = "SELECT * FROM `cs_banks_primary` ORDER BY `cs_banks_primary`.`minutes` DESC;";
$qret_pla = mysqli_query($csdb_link, $q_pla);

while($pla_row = mysqli_fetch_array($qret_pla)){
  $pn = $pla_row['steam_id'];
  if(!in_array($pn, $banned_users)){
  $pt=$pla_row['minutes'];
  $d=0;$h=0;$m=0;
    if($pt <= 60){
      $m = $pt;
    }elseif($pt < 1440){
      $h=$pt/60;
      $m=$pt%60; 
    }elseif($pt >= 1440){
      $d=$pt/1440;
      $d_r=$pt%1440;
      $h=$d_r/60;
      $m=$d_r%60;
    }
  }
  $d=number_format($d,0); 
  $h=number_format($h,0);
  $m=number_format($m,0);

  $pla_topname = $pla_row['name'];
  break;
}
//reset locaion in array.
mysqli_data_seek( $qret_pla, 0 );
?>