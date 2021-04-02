<?php
    include('../connect.php');
    $q = $_GET['q'];
    $q_user = "SELECT * FROM `bluerp_players` WHERE steam_id = '" .$q. "';";
    $qret_user = mysqli_query($cold_link, $q_user);

    echo '<ul class="list-group">';
    while($user_row = mysqli_fetch_array($qret_user)) {

        $pt=$user_row['minutes'];
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

        $d=number_format($d,0); 
        $h=number_format($h,0);
        $m=number_format($m,0);

        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Name: ". $user_row['username']."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Bank: $". number_format($user_row['bank']) ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Income: $". number_format($user_row['income']) ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Playtime: " . $d . " days, " . $h . " hours, " . $m . " minutes</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Experience: ". number_format($user_row['experience']) ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Respect: ". number_format($user_row['respect']) ."</li>";
    }
    echo "</ul>";
?>