<?php
require ('connect.php'); 
$query = "SELECT * FROM `bluerp_players` WHERE `minutes` >= 600;";
$sql = mysqli_query($cold_link, $query);
$i=0;
echo "{\n";
    echo    "\"Information\": {\n";
	$x = mysqli_num_rows($sql);  //Get row count
	mysqli_data_seek( $sql, 0); //Reset
	
			while($row = mysqli_fetch_assoc($sql)) {
				$i++;
				/**$uname = preg_replace('/[[:^print:]]/', '', $row['username']); // Get rid of bad stuff
				$uname = str_replace('"', "", $uname);//remove "
				$uname = str_replace("'", "", $uname);//remove '
				
				if($uname == "" || $uname == "username"){// change name if blank or username
					$uname = "Inavlid or Unregistered Username";
				}*/
				
				echo "  \"".$i ."\": {\n";
				//echo "   \"name\": \"" .$uname. "\",\n";
				echo "   \"steamid\": \"". $row['steam_id'] ."\",\n";
				echo "   \"bank\": ". $row['bank']. ",\n";
				echo "   \"income\": ". $row['income']. ",\n";
				echo "   \"playtime\": ". $row['minutes']. ",\n";
				echo "   \"experience\": ". $row['experience']. ",\n";
				echo "   \"respect\": ". $row['respect']. "\n";
				if($i == $x){
					echo "}\n";
				}else{
					echo "},\n";
				}
			}
	echo    "}\n";
echo  "}\n";
?>
