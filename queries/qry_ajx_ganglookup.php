<?php
    include('../connect.php');
    $q = $_GET['q'];
    $q_gang = "SELECT * FROM `bluerp_players` WHERE `gangid` = '" .$q. "';";
    $qret_gang = mysqli_query($cold_link, $q_gang);
    while($gang_row = mysqli_fetch_array($qret_gang)) {

        //Formate respect.
        $g_res = number_format($gang_row['respect']);

        //Check for specialty as it doesn't seem everyone has one.
        if($gang_row['specialty'] == null){
            $g_spec="No Specialty Found.";
        }else{
            $g_spec= $gang_row['specialty'];
        }


        echo '<ul class="list-group">';
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'><b>Member: ". $gang_row['username']."</b></li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Steam ID: ". $gang_row['steam_id']."</b></li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Status: ". $gang_row['employment']."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Specialty: ".$g_spec ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Respect: ". $g_res ."</li>";
        echo "</ul>";
        echo "<br>";
    }
?>