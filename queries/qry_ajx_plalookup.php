<?php
    include('../connect.php');
    $q = $_GET['q'];
    $q_user = "SELECT * FROM `bluerp_players` WHERE steam_id = '" .$q. "';";
    $qret_user = mysqli_query($cold_link, $q_user);

    $user_inv_val = 0;
    $q_useritems = "SELECT `bluerp_items`.`steam_id`, `bluerp_items`.`itemid`, `bluerp_items`.`quantity`, `bluerp_itemlist`.`price` 
    FROM bluerp_items 
    INNER JOIN bluerp_itemlist ON `bluerp_items`.`itemid` = `bluerp_itemlist`.`itemID` 
    WHERE `bluerp_items`.`steam_id` = '" .$q. "'
	AND `bluerp_items`.`itemid` != 250  
	AND `bluerp_items`.`itemid` != 254
	AND `bluerp_items`.`itemid` != 67
	AND `bluerp_items`.`itemid` != 46
	AND `bluerp_items`.`itemid` != 43
	AND `bluerp_items`.`itemid` != 68
	AND `bluerp_items`.`itemid` != 61
	AND `bluerp_items`.`itemid` != 44
	AND `bluerp_items`.`itemid` != 69
	AND `bluerp_items`.`itemid` != 62
	AND `bluerp_items`.`itemid` != 45
	AND `bluerp_items`.`itemid` != 100
	AND `bluerp_items`.`itemid` != 101
	AND `bluerp_items`.`itemid` != 21
    ORDER BY `bluerp_items`.`itemid` ASC;";
    $qret_useritems = mysqli_query($cold_link, $q_useritems);


    while($useritems_row = mysqli_fetch_array($qret_useritems)) {
        $user_inv_val += $useritems_row['quantity']*$useritems_row['price'];
    }


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

        echo "<li class='list-group-item d-flex justify-content-between align-items-center border-white bg-transparent text-white'>Name: ". $user_row['username']."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center border-white bg-transparent text-white'>Bank: $". number_format($user_row['bank'], 2) ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center border-white bg-transparent text-white'>Income: $". number_format($user_row['income']) ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center border-white bg-transparent text-white'>Inventory: $". number_format($user_inv_val, 0) ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center border-white bg-transparent text-white'>Playtime: " . $d . " days, " . $h . " hours, " . $m . " minutes</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center border-white bg-transparent text-white'>Experience: ". number_format($user_row['experience']) ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center border-white bg-transparent text-white'>Respect: ". number_format($user_row['respect']) ."</li>";
    }
    echo "</ul>";
?>
