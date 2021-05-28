<?php
function tbl_pla($qret_pla, $banned_users){
    $i=0;
    while($pla_row = mysqli_fetch_array($qret_pla)){
        $pn = $pla_row['steam_id'];
        if(!in_array($pn, $banned_users)){
            $i++;
            $pt=$pla_row['minutes'];
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
            
            $pla_style = func_glow($pla_row['income']);
            $pla_name = $pla_row['name'];

            echo "<tr>\n";
            echo "<td>". $i ."</td>\n";	
            echo  $pla_style . "". $pla_name  ."</td>\n";
            echo "<td>" . $d . " days, " . $h . " hours, " . $m . " minutes </td>\n";
            echo "</tr>\n";
            //Breakout at 25 listed users
            if($i >= 25){ 
                break; 
            }
        }
    }	
}
?>