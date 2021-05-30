<?php
function func_profile_control($steamprofile){
 include('./connect.php');
//First thing we must do is figure out what flags are set, and just the form accordingly.
$qry_chk_flags = "SELECT * FROM `hs_flags` WHERE `steam_id` = '".$steamprofile ."'";
$qret_chk_flags = mysqli_query($local_link , $qry_chk_flags);
    while ( $chk_row = mysqli_fetch_array($qret_chk_flags)){
        if($chk_row['flag_pla_lookup']=='1'){
            $flag_lookup_state = 'true';
            $flag_lookup_val = '1';
            echo "<div class='col-md-6'>";
                echo '<div class="form-group">';
                    echo "<div class='card bg-transparent border-success mb-3'>";
                        echo "<div class='card-body' id='opt_in_playerlookup'>";
                            echo "<h4 class='card-title'>Player Look Up Tool</h4>";
                            echo "<p class='card-text'>You are currently Opting in to have your player information displayed in the Player Look Up tool. 
                            Disabling this will restrict your ability to see certain information on other players.</p>";
                            echo '<div class="input-group-append">';
                                echo "<span class=\"btn btn-white\" onclick=\"update('0')\">Opt-In</span>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
                ?>
            <?php
        } else if($chk_row['flag_pla_lookup']=='0') {
            $flag_lookup_state = 'false';
            $flag_lookup_val = '0';
                echo "<div class='col-md-6'>";
                    echo '<div class="form-group">';
                        echo "<div class='card bg-transparent border-danger mb-3'>";
                            echo "<div class='card-body' id='opt_out_playerlookup'>";
                                echo "<h4 class='card-title'>Player Look Up Tool</h4>";
                                echo "<p class='card-text'>You are currently Opting out of having your player information displayed in the Player Look Up tool. 
                                Enabling this will provide you complete access to all approved information on other players.</p>";
                                echo '<div class="input-group-append">';
                                    echo "<span class=\"btn btn-white\" onclick=\"update('1')\">Opt-Out</span>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                ?>
            <?php
        } else {
        echo "Error retrieving Opt-In status. Please report error ID: pfrl_lku-1 to rezzo.";
        }
    }
}
?>