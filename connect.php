<?php
$csdb_link = mysqli_connect("104.153.105.245", "", "", "cs_db");
if($csdb_link === false){
    echo "There was an error connecting to CS* CC-DB. <br>Error: ";
    die(mysqli_connect_error());
}

$cold_link = mysqli_connect("104.153.105.245", "", "", "CoLD_RP");
if($cold_link === false){
    echo "There was an error connecting to CS* CC-DB. <br>Error: ";
    die(mysqli_connect_error());
}

$local_link = mysqli_connect("localhost", "", "", "mfdvca_highscores");
if($local_link === false){
    echo "There was an error connecting to Local Server. <br>Error: ";
    die(mysqli_connect_error());
}
?>