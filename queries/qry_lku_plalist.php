<?php

// Community ID conversion: https://gist.github.com/rannmann/49c1321b3239e00f442c
// This is non-BCMath version... Simplifies installation on various distros.

function toCommunityID($id, $type = 1, $instance = 1) {
    if (preg_match('/^STEAM_/', $id)) {
        $parts = explode(':', str_replace('STEAM_', '', $id));
        $universe = (int)$parts[0];
        if ($universe == 0)
            $universe = 1;
        $steamID = ($universe << 56) | ($type << 52) | ($instance << 32) | ((int)$parts[2] << 1) | (int)$parts[1];
        return $steamID;
    } elseif (is_numeric($id) && strlen($id) < 16) {
        return (1 << 56) | ($type << 52) | ($instance << 32) | $id;
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
}

function qry_lku_plalist(){

    include('././connect.php');

     // Get the list of user settings. If they are Opt Value 0 , then they chose to NOT be listed.
    $q_opt_list = "SELECT * FROM `hs_flags` WHERE `flag_pla_lookup` = 0";
    $qret_opt_list = mysqli_query($local_link, $q_opt_list);

    //Create our array to store the users we will test against.
    $opt_list = array();

    //Populate  our array.
    while($opt_row =  mysqli_fetch_array($qret_opt_list)){
        $opt_list[] = $opt_row['steam_id'];
    }

    //PlayerList (We only want players with > 5 hours playtime)
    $q_pop =  "SELECT * FROM `bluerp_players` WHERE `minutes` > 300 ORDER BY  `username` ASC";
    $qret_pop = mysqli_query($cold_link, $q_pop);


    $i=0;
    echo '<option value="">Select a Player</option>';
    while($pop_row = mysqli_fetch_array($qret_pop)){ 

    //Convert the steamid32 to 64.
    $pop_id64 = toCommunityID($pop_row['steam_id']);
    if($pop_row['username'] == "username" || in_array($pop_id64, $opt_list)){ //(Forget anyone who doesn't have a registered username.) OR Is in the list of opt-out users.

    }else{
    $i++;
    $u=strval($pop_row['username']);
    echo "<option value='".$pop_row['steam_id']."'>" . $i . " - " . $u . " - " . $pop_row['steam_id'] . "</option>\n"; 
    }

    }
}
?>


