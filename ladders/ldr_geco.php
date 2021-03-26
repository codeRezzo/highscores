<?php
function tbl_geco($qret_geco, $banned_gangs){
    $i=0;
    while($geco_row = mysqli_fetch_array($qret_geco)){
        $gn = $geco_row['gang_name'];
        if(!in_array($gn, $banned_gangs)){
            $i++;
            $geco_name = $geco_row['gang_name'];
            $geco_money = number_format($geco_row['gang_money'], 0);
            $geco_bank = number_format($geco_row['gang_bank'], 0);

            echo "<tr>\n";
            echo "<td>". $i ."</td>\n";	
            echo "<td>". $geco_name  ."</td>\n";
            echo "<td>$". $geco_money  ."</td>\n";
            echo "<td>$". $geco_bank  ."</td>\n";
            echo "</tr>\n";
            //Breakout at 25 listed gangs
            if($i >= 25){ 
                break; 
            }
        }
    }	
}
?>