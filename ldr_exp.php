<?php
function tbl_exp($qret_exp, $banned_users){
    $i=0;
    while($exp_row = mysqli_fetch_array($qret_exp)){
        $pn = $exp_row['steam_id'];
        if(!in_array($pn, $banned_users)){
            $i++;
            $exp_name = $exp_row['name'];
            $exp_points = number_format($exp_row['experience'], 0);

            echo "<tr>\n";
            echo "<td>". $i ."</td>\n";	
            echo "<td>". $exp_name ."</td>\n";
            echo "<td>". $exp_points ."</td>\n";
            echo "</tr>\n";
            //Breakout at 25 listed users
            if($i >= 25){ 
                break; 
            }
        }
    }	
}
?>