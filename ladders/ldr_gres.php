<?php
function tbl_gres($qret_gres, $banned_gangs){
    $i=0;
    while($gres_row = mysqli_fetch_array($qret_gres)){
        $gn = $gres_row['gang_name'];
        if(!in_array($gn, $banned_gangs)){
            $i++;
            $gres_name = $gres_row['gang_name'];
            $gres_respect = number_format($gres_row['gang_respect'], 0);

            echo "<tr>\n";
            echo "<td>". $i ."</td>\n";	
            echo "<td>". $gres_name  ."</td>\n";
            echo "<td>". $gres_respect  ."</td>\n";
            echo "</tr>\n";
            //Breakout at 25 listed gangs
            if($i >= 25){ 
                break; 
            }
        }
    }	
}
?>