<?php
function qry_lku_ganglist(){
    include('././connect.php');
    //GangList
    $q_pop =  "SELECT DISTINCT gang_name, gang_id FROM bluerp_gangs ORDER BY gang_name ASC";
    $qret_pop = mysqli_query($cold_link, $q_pop);
    $i=0;
    echo '<option value="">Select a Gang</option>';
    while($pop_row = mysqli_fetch_array($qret_pop)){ 
    $i++;
    echo "<option value='".$pop_row['gang_id']."'>" . $i . " - ". $pop_row['gang_name'] . "</option>\n"; 
    }
}
?>


