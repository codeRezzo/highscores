<?php
function qry_lku_plalist(){
    include('././connect.php');
    //PlayerList (We only want players with > 5 hours playtime)
    $q_pop =  "SELECT * FROM `bluerp_players` WHERE `minutes` > 300 ORDER BY  `username` ASC";
    $qret_pop = mysqli_query($cold_link, $q_pop);
    $i=0;
    echo '<option value="">Select a Player</option>';
    while($pop_row = mysqli_fetch_array($qret_pop)){ 
    if($pop_row['username'] == "username"){ //(Forget anyone who doesn't have a registered username.)

    }else{
    $i++;
    $u=strval($pop_row['username']);
    echo "<option value='".$pop_row['steam_id']."'>" . $i . " - " . $u . " - " . $pop_row['steam_id'] . "</option>\n"; 
    }
    }
}
?>

