<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Profile - Highscores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/x-icon" href="vendor_home/assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="vendor_home/css/styles.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
</head>
<html>
  <style>::-webkit-scrollbar { display: none;}</style>
  <body style="min-height: 100vh; background: rgb(23, 23, 23);
  background: linear-gradient(210deg, rgba(23, 23, 23,1) 0%, rgba(50, , 23,1) 51%, rgba(23, 23, 23,1) 100%);">

<?php
//The Sign in/out handlers and steamauth.
require ('./vendor/steamauth/steamauth.php');
include ('connect.php');
function sa_signin_btn(){
  if(!isset($_SESSION['steamid'])) {

    echo '<li class="float-lg-right"><a class="btn btn-outline-success" href="?login">Sign In</a></li>'; 
    } else {
    echo '<li class="float-lg-right"><a class="btn btn-outline-success" href="">My Profile</a>';
    echo '<a class="btn btn-outline-success" href="?logout">Sign Out</a></li>';
    }  
}
?>

<div class="container">
    <h1 class="display-2 text-center">Rezzo.Dev</h1>
    <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="home">
        <div class="container">
            <h3 class="text-center">My Profile</h3> 
            <ul class="list-unstyled">
                <?php if(isset($_SESSION['steamid'])) {
                    include ('./vendor/steamauth/userInfo.php');
                    echo "<li class='text-center'>Welcome to your profile, " . $steamprofile['personaname']. "\n</li>"; 
                    }
                ?>
                    <li class="float-lg-left"><a class="btn btn-outline-success" href="https://rezzo.dev/highscores/">Go Back</a></li>
                    <?php sa_signin_btn() ?>
             </ul>
            <br>
			<br> 
              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="Sel1">Opt-In / Out of Features</label>
                    <br>

                    <?php 
                    //First thing we must do is figure out what flags are set, and just the form accordingly.
                    $qry_chk_flags = "SELECT * FROM `hs_flags` WHERE `steam_id` = '".$steamprofile['steamid'] ."'";
                    $qret_chk_flags = mysqli_query($local_link , $qry_chk_flags);
                    while ( $chk_row = mysqli_fetch_array($qret_chk_flags)){
                        if($chk_row['flag_pla_lookup']=='1'){
                            $flag_lookup_state = 'true';
                            $flag_lookup_val = '1';
                            echo "<div class='col-sm'>";
                                echo "<div class='card border-success mb-3'>";
                                    echo "<div class='card-body' id='opt_in_playerlookup'>";
                                    echo "<h4 class='card-title'>Player Look Up Tool</h4>";
                                    echo "<p class='card-text'>You are currently Opting in to have your player information displayed in the Player Look Up tool. 
                                Disabling this will restrict your ability to see certain information on other players.</p>";
                                ?>
                                <div class="input-group-append">
                                <span class="btn btn-info" onclick="update('0')">Opt-Out</span>
                             </div>
                             <?php
                                echo "</div>";
                            echo "</div>";
                        } else if($chk_row['flag_pla_lookup']=='0') {
                            $flag_lookup_state = 'false';
                            $flag_lookup_val = '0';
                            echo "<div class='col-sm'>";
                            echo "<div class='card border-danger mb-3'>";
                                echo "<div class='card-body' id='opt_out_playerlookup'>";
                                echo "<h4 class='card-title'>Player Look Up Tool</h4>";
                                echo "<p class='card-text'>You are currently Opting out of having your player information displayed in the Player Look Up tool. 
                                Enabling this will provide you complete access to all approved information on other players.</p>";
                            ?>
                            <div class="input-group-append">
                                <span class="btn btn-info" onclick="update('1')">Opt-In</span>
                            </div>
                             <?php
                            echo "</div>";
                        echo "</div>";
                        } else {
                        echo "Error retreiving Opt-In status. Please report error ID: pfrl_lku-1 to rezzo.";
                        }
                    }
                    ?>
                  </div>
                </div>
              </div>

                <div class="col-sm">
                  <div id="profile-update-info">
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">No changes detected.</li>
                    </ul>
                  </div>
                </div>

              </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
        <ul class="list-unstyled">
            <li class="float-lg-right"><a class="text-white" href="#top" style="text-decoration: none;">Back to top</a></li>
            <li><p>Made by <a class="text-white" href="https://youtube.com/c/coderezzo" style="text-decoration: none;">codeRezzo</a>.</p></li>
        </ul>
        </div>
    </div>

</div>
    <!-- Js. -->
    <script src="./vendor/chartjs/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./vendor/chosen/chosen.jquery.js" type="text/javascript"></script>

<script>
//Handling of updating the players opt-in/out status.
function update(str_prfl) {
  if (str_prfl == "") {
    document.getElementById("profile-update-info").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("profile-update-info").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","./queries/qry_ajx_prfl_flagset.php?q="+str_prfl,true);
    xmlhttp.send();
  }
}
</script>

  </body>
</html>