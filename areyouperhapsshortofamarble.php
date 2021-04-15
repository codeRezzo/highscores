<?php
    include('connect.php');

    $user_inv_val = 0;
    $doorlocks_val = 0;
    $usercash_val = 0;
    $q_useritems = "SELECT `bluerp_items`.`steam_id`, `bluerp_items`.`itemid`, `bluerp_items`.`quantity`, `bluerp_itemlist`.`name`, `bluerp_itemlist`.`price`, `bluerp_itemlist`.`type`
    FROM bluerp_items
    INNER JOIN bluerp_itemlist ON `bluerp_items`.`itemid` = `bluerp_itemlist`.`itemID`
    ORDER BY `bluerp_items`.`itemid`  ASC";
    $qret_useritems = mysqli_query($cold_link, $q_useritems);

    while($useritems_row = mysqli_fetch_array($qret_useritems)) {
        $user_inv_val += $useritems_row['quantity']*$useritems_row['price'];
    }


    $q_doorlocks = "SELECT * FROM `bluerp_doors`";
    $qret_doorlocks = mysqli_query($cold_link, $q_doorlocks);

    while($doorlocks_row = mysqli_fetch_array($qret_doorlocks)) {
        $doorlocks_val += $doorlocks_row['locks']*1200;
    }

    
    $q_usercash = "SELECT * FROM `bluerp_players`";
    $qret_usercash = mysqli_query($cold_link, $q_usercash);

    while($usercash_row = mysqli_fetch_array($qret_usercash)) {
        $usercash_val += $usercash_row['money']+$usercash_row['bank'];
    }
    $total = $usercash_val+$doorlocks_val+$user_inv_val;

        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Cash/Bank: $". number_format($usercash_val, 2) ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Inventory: $". number_format($user_inv_val, 2) ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Locks: $". number_format($doorlocks_val, 2) ."</li>";
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Total: $". number_format($total, 2) ."</li>";
    echo "</ul>";
?>