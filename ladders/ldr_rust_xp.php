<?php
//Holy f**k boys! We're doing rust now! :O
function tbl_rust_xp($qret_rust_xp, $rust_banned_users){
    $i=0;
    while($rust_xp_row = mysqli_fetch_array($qret_rust_xp)){ 
        $pn = $rust_xp_row['hs_steamid'];
        if(!in_array($pn, $rust_banned_users)){
            $i++;
            $rust_name = $rust_xp_row['sn'];
            $rust_xp = number_format($rust_xp_row['xp'], 0);

            echo "<tr>\n";
            echo "<td>". $i ."</td>\n";	
            echo "<td>". $rust_name ."</td>\n";
            echo "<td>". $rust_xp ."</td>\n";
            echo "</tr>\n";
            //Breakout at 100 listed users
            if($i >= 100){ 
                break; 
            }
        }
    }	
}
?>