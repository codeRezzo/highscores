<?php
function tbl_res($qret_res, $banned_users){
    $i=0;
    while($res_row = mysqli_fetch_array($qret_res)){
        $pn = $res_row['steam_id'];
        if(!in_array($pn, $banned_users)){
            $i++;
            $res_name = $res_row['name'];
            $res_points = number_format($res_row['respect'], 0);

            echo "<tr>\n";
            echo "<td>". $i ."</td>\n";	
            echo "<td>". $res_name ."</td>\n";
            echo "<td>". $res_points ."</td>\n";
            echo "</tr>\n";
            //Breakout at 25 listed users
            if($i >= 25){ 
                break; 
            }
        }
    }	
}
?>