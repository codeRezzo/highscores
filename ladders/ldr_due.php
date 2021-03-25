<?php
function tbl_due($qret_due, $banned_users){
    $i=0;
    while($due_row = mysqli_fetch_array($qret_due)){
        $pn = $due_row['steam_id'];
        if(!in_array($pn, $banned_users)){
            $i++;
            $due_name = $due_row['username'];
            $due_wins = number_format($due_row['wins'], 0);
            $due_losses = number_format($due_row['losses'], 0);
            $due_kills = number_format($due_row['kills'], 0);
            $due_deaths = number_format($due_row['deaths'], 0);

            if($due_deaths == 0){
                $due_kdr = number_format($due_row['kills'],2);
            } else {
                $due_kdr = number_format($due_row['kills']/$due_row['deaths'],2); 
            }

            if($due_losses == 0){
                $due_wlr = number_format($due_row['wins'],2);
            } else {
                $due_wlr = number_format($due_row['wins']/$due_row['losses'],2); 
            }


            echo "<tr>\n";
            echo "<td>". $i ."</td>\n";	
            echo "<td>". $due_name ."</td>\n";
            echo "<td>". $due_wins ."</td>\n";
            echo "<td>". $due_wlr ."</td>\n";
            echo "<td>". $due_kills ."</td>\n";
            echo "<td>". $due_kdr ."</td>\n";
            echo "</tr>\n";
            //Breakout at 25 listed users
            if($i >= 25){ 
                break; 
            }
        }
    }	
}
?>