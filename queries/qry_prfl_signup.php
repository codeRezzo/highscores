<?php
function qry_prfl_setup(){
include ('./vendor/steamauth/userInfo.php');
include ('connect.php');

    //When a user signs in through steam we want to check and see if they exist in the database.
    //If not we are going to set them with default values, otherwise update all relevant information.
    $prev_uname =$steamprofile['personaname'];
    $user_name = mysqli_real_escape_string($local_link, $steamprofile['personaname']);
    $id = $steamprofile['steamid'];


    if($id == null || $user_name == null){
        echo "FATAL ERROR PRFL2";
    }else{
    $qry_chk_user = "INSERT IGNORE INTO `hs_flags` SET `steam_id` = '".$id."',`steam_name` = '".$user_name."',`flag_pla_lookup` = '1';";
    mysqli_query($local_link , $qry_chk_user);
    }

    // ensure the players name is up-to-date (There is probably a more elegant solution to this, but this will work for now.)
    if($id == null || $user_name == null){
        echo "FATAL ERROR PRFL1";
    }else{
    $qry_updt_user = "UPDATE `hs_flags` SET `steam_name`='".$user_name."' WHERE `steam_id` = '".$id."'";
    mysqli_query($local_link, $qry_updt_user);
    }
}

//header('Location: https://www.rezzo.dev/highscores/profile.php');
//used in testing.
?>