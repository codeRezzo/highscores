<?php
require ('../vendor/steamauth/steamauth.php');
include ('../vendor/steamauth/userInfo.php');
include ('../connect.php');
$q = $_GET['q'];
    //When a user signs in through steam we want to check and see if they exist in the database.
    //If not we are going to set them with default values, otherwise update all relevant information.
    $id = $steamprofile['steamid'];

    $qry_updt_flag = "UPDATE `hs_flags` SET `flag_pla_lookup`='".$q."' WHERE `steam_id` = '".$id."'";
    mysqli_query($local_link, $qry_updt_flag);
    echo "Updated Opt-In Status to ". $q ." ON " . $id .". Please refresh the page to confirm the changes.";
?>