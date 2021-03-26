<?php
function tbl_gexp($qret_gexp, $banned_gangs){
    $i=0;
    while($gexp_row = mysqli_fetch_array($qret_gexp)){
        $gn = $gexp_row['gang_name'];
        if(!in_array($gn, $banned_gangs)){
            $i++;
            $gexp_name = $gexp_row['gang_name'];
            $gexp_experience = number_format($gexp_row['gang_experience'], 0);

            echo "<tr>\n";
            echo "<td>". $i ."</td>\n";	
            echo "<td>". $gexp_name  ."</td>\n";
            echo "<td>". $gexp_experience  ."</td>\n";
            echo "</tr>\n";
            //Breakout at 25 listed gangs
            if($i >= 25){ 
                break; 
            }
        }
    }	
}
?>