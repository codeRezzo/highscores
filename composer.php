
<?php

//Composer isn't meant to be on live. It's meant to be a data processing unit for the rust highscores.
//It will take roughly 15-20 seconds to process 5,000 entries when querying
//If you want to have it on live be sure to have the queries at the bottom disabled.

// Be sure that the Rust-RSRPGData.Json & xptable.json are in the rust-data folder and are spelled the same as here. CASE SENSETIVE.
// the top of each file must start as follows:
// {
// "XPTABLE": {

//Be sure to remove all furnace / world data so we start with players.
// {
// "PLAYERS": {

include('connect.php');
echo "////////////////////////////////////<br>";
echo "COMPOSER - JSON DATA PROCESSING<br>";
echo "https://rezzo.dev/<br>";
echo "////////////////////////////////////<br>";

$file = file_get_contents('./rust-data/Rust-RSRPGData.json', true);
$pdata = json_decode($file, true);

$xptable = file_get_contents('./rust-data/xptable.json', true);
$xpdata = json_decode($xptable, true);


foreach($pdata["PLAYERS"] as $playerid => $file_row) {
    $id = $playerid;
    $xp =0;
    $sn = mysqli_real_escape_string($local_link, $file_row['sn']);
    $n_xp = $file_row['xp'];
    $ul = $l = $file_row['l'];
    $ul++; // Add one to get xp requirement for next level.

    $statp = $file_row['statp'];
    $skillp = $file_row['skillp'];
    $i=0;

    //Set Key
    foreach($xpdata["XPTABLE"] as $xpid => $xp_row){
        $i++;

        if($xpid < $ul){
            $xp=$xp+$xp_row;
        }
        if ($xpid == $ul){ //test
           $xp = $xp-$n_xp; //xp = Next Level XP - Needed XP
            echo "<br>-- XPID --  ". $xpid . "<br> - Name:" . $sn . "<br> - Current LVL: " . $l . "<br> - Next LVL: " . $ul . "<br> - XP Needed: " . $n_xp . "<br> - XP Next Level: " . $xp_row . "<br> - Overall XP: "  . $xp . "<br>";
            break;
        }
    }

    // Run this to add new users
    $query = "INSERT IGNORE INTO `hs_rust_main`(`hs_steamid`, `sn`, `l`, `xp`, `statp`, `skillp`) VALUES ('".$id."','".$sn."','".$l."','".$xp."','".$statp."','".$skillp."')";
    mysqli_query($local_link , $query);
    
    
    //Run this to update xp.
    $qry_updt_user = "UPDATE `hs_rust_main` SET `xp`='".$xp."' WHERE `hs_steamid` = '".$id."'";
    mysqli_query($local_link, $qry_updt_user);

}
?>