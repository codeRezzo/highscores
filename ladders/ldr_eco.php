<?php
function tbl_eco($qret_eco, $banned_users){
    $i=0;
    while($eco_row = mysqli_fetch_array($qret_eco)){
        $pn = $eco_row['steam_id'];
        if(!in_array($pn, $banned_users)){
            $i++;
            $eco_name = $eco_row['name'];
            $eco_income = number_format($eco_row['income'], 0);
            $eco_bank = number_format($eco_row['bank'], 0);

            $eco_style = func_glow($eco_row['income']);

            echo "<tr>\n";
            echo "<td>". $i ."</td>\n";	
            echo  $eco_style ."". $eco_name  ."</td>\n";
            echo "<td>$". $eco_income  ."/min</td>\n";
            echo "<td>$". $eco_bank  ."</td>\n";
            echo "</tr>\n";
            //Breakout at 25 listed users
            if($i >= 25){ 
                break; 
            }
        }
    }	
}
?>