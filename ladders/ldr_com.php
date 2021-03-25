<?php
function tbl_com($qret_com, $banned_users){
    $i=0;
    while($com_row = mysqli_fetch_array($qret_com)){
        $pn = $com_row['steam_id'];
        if(!in_array($pn, $banned_users)){
            $i++;
            $com_name = $com_row['name'];
            $com_elo = number_format($com_row['elo'], 0);
            $com_kills = number_format($com_row['kills'], 0);
            $com_kdr = number_format($com_row['kills']/$com_row['deaths'],2);

            echo "<tr>\n";
            echo "<td>". $i ."</td>\n";	
            echo "<td>". $com_name  ."</td>\n";
            echo "<td>". $com_elo  ."</td>\n";
            echo "<td>". $com_kills  ."</td>\n";
            echo "<td>". $com_kdr  ."</td>\n";
            echo "</tr>\n";
            //Breakout at 25 listed users
            if($i >= 25){ 
                break; 
            }
        }
    }	
}
?>