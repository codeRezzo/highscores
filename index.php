<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Highscores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="./vendor/bootstrap/css/custom.min.css">
     <link rel="stylesheet" href="./vendor/wavewrapper.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

</head>
<html>
  <style>::-webkit-scrollbar { display: none;}</style>
  <body style="min-height: 100vh; background: rgb(23, 23, 23);
  background: linear-gradient(210deg, rgba(23, 23, 23,1) 0%, rgba(50, , 23,1) 51%, rgba(23, 23, 23,1) 100%);">




<?php 
//Connect to the DB.
include('connect.php');

//white Ladders
include('./ladders/ldr_pla.php');
include('./ladders/ldr_eco.php');
include('./ladders/ldr_com.php');
include('./ladders/ldr_res.php');
include('./ladders/ldr_exp.php');
include('./ladders/ldr_due.php');

//Gang Ladders
include('./ladders/ldr_geco.php');
include('./ladders/ldr_gres.php');
include('./ladders/ldr_gexp.php');


// blacklists
$banned_users = array("STEAM_0:1:25306470", "x"); //Player SteamID32
$banned_gangs = array("default_banned_gang-22-3", "default_banned_gang-22-2"); //Gang ID64

//whiite Queries
include('./queries/qry_pla.php');
include('./queries/qry_eco.php');
include('./queries/qry_com.php');
include('./queries/qry_res.php');
include('./queries/qry_exp.php');
include('./queries/qry_due.php');

//Gang Queries
include('./queries/qry_geco.php');
include('./queries/qry_gres.php');
include('./queries/qry_gexp.php');

//Graph queries (actual graph creation includes are at the bottom of the page ctrl+f tag: GRAPHINC)
include('./queries/qry_grp_gbank.php');
include('./queries/qry_grp_bank.php');
include('./queries/qry_grp_pla.php');
include('./queries/qry_grp_com.php');
include('./queries/qry_grp_ser_his_global.php');

//AJAX Lookup.
include('./queries/qry_lku_plalist.php');
include('./queries/qry_lku_ganglist.php');


// Handle the sign in process.
require ('./vendor/steamauth/steamauth.php');
function sa_signin_btn(){
  if(!isset($_SESSION['steamid'])) {

    echo '<li class="float-lg-right"><a class="btn btn-outline-success" href="?login">Sign In</a></li>'; 
    } else {
    echo '<li class="float-lg-right"><a class="btn btn-outline-success" href="profile.php">My Profile</a>';
    echo '<a class="btn btn-outline-success" href="?logout">Sign Out</a></li>';
    }  
}
?>

<div class="container">
    <h1 class="display-2 text-center">Rezzo.Dev</h1>
    <div id="home"><!-- Wrapper for home and patchnotes etc -->
    <div class="jumbotron shadow p-3 mb-5 bg-dark rounded">
      <div class="container">
       <ul class="list-unstyled">
        <h3 class="text-center">Highscores - Select a Section</h3> 
        <?php if(isset($_SESSION['steamid'])) {
              include ('./vendor/steamauth/userInfo.php');

              // Successful sign in.
              include ('./queries/qry_prfl_signup.php');
              // Setup our signed in user.
              qry_prfl_setup();

              echo "<li class='text-center'>Welcome back, " . $steamprofile['personaname']. "\n</li>"; 
              }
        ?>
		    <li class="float-lg-left"><a class="btn btn-outline-success" href="https://rezzo.dev/">Go Back</a></li>
		    <?php sa_signin_btn() ?>
      </ul>
	  <br>
      <br>
          <div class="row">
            <div class="col-sm">
              <div class="card border-success mb-3">
                <div class="card-body" id="goladders">
                  <h4 class="card-title">Ladders</h4>
                  <p class="card-text">Standard highscore leaderboards.</p>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <div class="card border-success mb-3">
                <div class="card-body" id="govisualscores">
                  <h4 class="card-title">Visual Scores</h4>
                  <p class="card-text">Ladders, but in graph form.</p>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <div class="card border-success mb-3">
                <div class="card-body" id="goplayerlookup">
                  <h4 class="card-title">Player Look Up</h4>
                  <p class="card-text">Look up information on a specific player.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm">
              <div class="card border-success mb-3">
                <div class="card-body" id="goserverstats" >
                  <h4 class="card-title">Server Stats</h4>
                  <p class="card-text">Bits of information about the game server.</p>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <div class="card border-danger mb-3">
                  <div class="card-body" id="goglobalhistory">
                    <h4 class="card-title">Global History - BETA</h4>
                    <p class="card-text">30 Day global history.</p>
                  </div>
              </div>
            </div>
            <div class="col-sm">
              <div class="card border-success mb-3">
                <div class="card-body" id="goganglookup">
                  <h4 class="card-title">Gang Look Up</h4>
                  <p class="card-text">Look up information on a specific Gang.</p>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="jumbotron shadow p-3 mb-5 bg-dark rounded">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">- Privacy Update Part 2 -</h3>
				        <li class="float-lg-left">Patch: 24/04/2021 - Highscores</li>
              </ul>
            <br>
		      	<br>

            <p><strong>- Steam Auth & Privacy -</strong></p>
            <p>Added Steamauth, users can now sign in through Steam.</p>
            <p>User profile framework created for new feature functionality.</p>
            <p>Enabled all website sign in buttons.</p>
            <p>Added user profile button.</p>
            <p>User Sign Up Checks, inserts & updates information accordingly upon sign-in.</p>
            <p>Ability to opt out of player lookup added to the players profile.</p>
            <p>Player Look Up tool will now NOT list a individual who has opted out.</p>
            <p>Opting out of Player Look Up tool will restrict information you can view on another player.</p>
            <br>
            <p>As more features are added, more Opt-In / Out options will be added. As well as more feature that are sign-in required.</p>
            <p>Not many patch notes for this update but the changes are a big deal.</p>
            <p class="text-muted" >Note: Signing in through steam immediately opts players into historical stat tracking leaderboards.</p>

            <p><strong> - UI Changes - </strong></p>
            <p>Player data updating set-up to work via AJAX script to avoid unnecessary page loads.</p>
            <br>
            <p>https://github.com/codeRezzo/highscores</p>
          </div>   
        </div>

    <div class="jumbotron shadow p-3 mb-5 bg-dark rounded">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">- Privacy Update Part 1 -</h3>
				        <li class="float-lg-left">Patch: 21/04/2021 - Highscores</li>
              </ul>
            <br>
		      	<br>

            <p><strong>- Privacy -</strong></p>
            <p>Item Filters - Player look up tool has been updated to filter out a number of items.</p>
            <p>The following items will no longer be accounted for towards player inventory value:</p>
            <ul>
            <li>250 - Super door Hack</li>
            <li>254 - Dogs Cuff Saw</li>
            <li>67 - (1) Cuff Saw</li>
            <li>68 - (2) Cuff Saw</li>
            <li>69 - (3) Cuff Saw</li>
            <li>46 - (1) Door Hack</li>
            <li>61 - (2) Door Hack</li>
            <li>62 - (3) Door Hack</li>
            <li>43 - (1) Lockpick</li>
            <li>44 - (2) Lockpick</li>
            <li>45 - (3) Lockpick</li>
            <li>100 - Lockbreaker</li>
            <li>101 - Lock</li>
            </ul>
            <br>
            <p><strong> - Steamauth - </strong></p>
            <p>With the advancing nature of highscores and several coming features, sign-in-through steam is being added.</p>
            <p>Using Steamauth players will be able to sign into highscores and choose to opt-in or opt-out of any other ladders or additional highscores features.</p>
            <p class="text-muted" >Note: You cannot opt-out of primary ladders.</p>

            <p><strong> - UI Changes - </strong></p>
            <p>Sign-In button added to all pages, however not yet functional.</p>
            <br>
            <p>https://github.com/codeRezzo/highscores</p>
          </div>   
        </div>


  </div><!-- end of wrapper for home and patchnotes etc -->

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="ladders" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Primary Ladders</h3>
                <li class="float-lg-left"><a class="btn btn-outline-success" id="gohome">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>
            <div class="card border-success mb-3">
              <div class="row">
                <div class="col-sm">
                    <div class="card-body" id="goplaytime">
                      <h4 class="card-title">Playtime Ladder</h4>
                      <p class="card-text"><?php echo $pla_topname . " is rank #1 with " . $d . " days, " . $h . " hours, " . $m . " minutes played."; ?></p>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-body" id="goeconomy">
                      <h4 class="card-title">Economy Ladder</h4>
                      <p class="card-text"><?php echo $eco_topname . " is rank #1 with $" . $eco_topbank . " banked."; ?></p>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-body" id="gocombat">
                      <h4 class="card-title">Combat Ladder</h4>
                      <p class="card-text"><?php echo $com_topname . " is rank #1 with ". $com_topelo . " elo rating." ?></p>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm">
                    <div class="card-body"  id="gorespect">
                      <h4 class="card-title">Respect Ladder</h4>
                      <p class="card-text"><?php echo $res_topname . " is rank #1 with ". $res_toppoints . " respect points." ?></p>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-body"  id="goexperience">
                      <h4 class="card-title">Experience Ladder</h4>
                      <p class="card-text"><?php echo $exp_topname . " is rank #1 with ". $exp_toppoints . " experience points." ?></p>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-body" id="godueling">
                      <h4 class="card-title">Dueling Ladder</h4>
                      <p class="card-text"><?php echo $due_topname . " is rank #1 with ". $due_topwins . " One Versus One dueling wins." ?></p>
                    </div>
                </div>
              </div>
            </div>

            <h3 class="text-center">Gang Ladders</h3> 
              <div class="card border-success mb-3">
                <div class="row">
                  <div class="col-sm">
                      <div class="card-body" id="gogangeconomy">
                        <h4 class="card-title">Economy Ladder</h4>
                        <p class="card-text"><?php echo $geco_topgang . " is rank #1 with a combined total of $". $geco_topbank . " banked." ?></p>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card-body" id="gogangrespect">
                        <h4 class="card-title">Respect Ladder</h4>
                        <p class="card-text"><?php echo $gres_topgang . " is rank #1 with a combined total of ". $gres_toprespect . " respect points." ?></p>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card-body" id="gogangexperience">
                        <h4 class="card-title">Experience Ladder</h4>
                        <p class="card-text"><?php echo $gexp_topgang . " is rank #1 with a combined total of ". $gexp_topexperience . " experience points." ?></p>
                      </div>
                  </div>
                </div>
              </div>

              <h3 class="text-center">Other Ladders</h3> 
                <div class="card border-danger mb-3">
                  <div class="row">
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title">Pinata Poppers</h4>
                          <p class="card-text">$PID is rank #1 by beating open $pcount Pinatas.</p>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title">The Environmentalist</h4>
                          <p class="card-text">$PID is rank #1 by collecting $tcount pieces of trash.</p>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title">Home Wrecker</h4>
                          <p class="card-text">$PID is rank #1 breaking $blcount locks.</p>
                        </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title">Lootbox Detective</h4>
                          <p class="card-text">$PID is rank #1 by finding and opening $ccount crates.</p>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title">Bank Robber</h4>
                          <p class="card-text">$PID is rank #1 by robbing $rcount bankers & vendors to completion.</p>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title">Growth Industry</h4>
                          <p class="card-text">$PID is rank #1 selling $dcount drugs to vendors.</p>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title">The Numbers Mason</h4>
                          <p class="card-text">$PID is rank #1 by hacking $hcount terminals.</p>
                        </div>
                    </div>
                  </div>
                </div>

          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="playtime" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Playtime Ladder</h3>
				<li class="float-lg-left"><a class="btn btn-outline-success" id="gobackladders-pla">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>
			
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Player</th>
                    <th scope="col">Time Played</th>
                  </tr>
                </thead>
                <tbody> 
                <?php tbl_pla($qret_pla, $banned_users); ?> 
                </tbody>
              </table>
          </div>   
        </div>
      
        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="economy" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Economy Ladder</h3>
				<li class="float-lg-left"><a class="btn btn-outline-success" id="gobackladders-eco">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>


              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Player</th>
                    <th scope="col">Income</th>
                    <th scope="col">Bank</th>
                  </tr>
                </thead>
                <tbody>
                <?php tbl_eco($qret_eco, $banned_users); ?>
                </tbody>
              </table>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="combat" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Combat Ladder</h3>
				<li class="float-lg-left"><a class="btn btn-outline-success" id="gobackladders-com">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Player</th>
                    <th scope="col">Elo</th>
                    <th scope="col">Kills</th>
                    <th scope="col">KD/R</th>
                  </tr>
                </thead>
                <tbody>
                <?php tbl_com($qret_com, $banned_users); ?>
                </tbody>
              </table>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="respect" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Respect Ladder</h3>
				<li class="float-lg-left"><a class="btn btn-outline-success" id="gobackladders-res">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Player</th>
                    <th scope="col">Respect</th>
                  </tr>
                </thead>
                <tbody>
                <?php tbl_res($qret_res, $banned_users); ?>
                </tbody>
              </table>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="experience" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Experience Ladder</h3>
				<li class="float-lg-left"><a class="btn btn-outline-success" id="gobackladders-exp">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>

              <table class="table table-hover">
                <thead>
                    <tr>
                      <th scope="col">Rank</th>
                      <th scope="col">Player</th>
                      <th scope="col">Experience</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php tbl_exp($qret_exp, $banned_users); ?>
                  </tbody>
                </table>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="dueling" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Dueling Ladder</h3>
				<li class="float-lg-left"><a class="btn btn-outline-success" id="gobackladders-due">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>


              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Player</th>
                    <th scope="col">Wins</th>
                    <th scope="col">WL/R</th>
                    <th scope="col">Kills</th>
                    <th scope="col">KD/R</th>
                  </tr>
                </thead>
                <tbody>
                <?php tbl_due($qret_due, $banned_users); ?>
                </tbody>
              </table>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="gangeconomy" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Gang Economy Ladder</h3>
				<li class="float-lg-left"><a class="btn btn-outline-success" id="gobackladders-geco">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Gang</th>
                    <th scope="col">Money</th>
                    <th scope="col">Bank</th>
                  </tr>
                </thead>
                <tbody>
                <?php tbl_geco($qret_geco, $banned_gangs); ?>
                </tbody>
              </table>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="gangrespect" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Gang Respect Ladder</h3>
				<li class="float-lg-left"><a class="btn btn-outline-success" id="gobackladders-gres">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Gang</th>
                    <th scope="col">Respect</th>
                  </tr>
                </thead>
                <tbody>
                <?php tbl_gres($qret_gres, $banned_gangs); ?>
                </tbody>
              </table>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="gangexperience" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Gang Experience Ladder</h3>
				<li class="float-lg-left"><a class="btn btn-outline-success" id="gobackladders-gexp">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Gang</th>
                    <th scope="col">Experience</th>
                  </tr>
                </thead>
                <tbody>
                <?php tbl_gexp($qret_gexp, $banned_gangs); ?>
                </tbody>
              </table>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="visualscores-bar" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Visual Scores - BAR</h3>
				<li class="float-lg-left"><a class="btn btn-outline-success" id="gohome-vissco-bar">Go Back</a></li>
				<li class="float-lg-right"><a class="btn btn-outline-success" id="govisualscores-pie">Pie Graphs</a></li>
              </ul>
            <br>
			<br>
			  
                <div class="row">

                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title text-center">Top Gang Wealth</h4>
                          <canvas id="chr-gbank-bar" width="180" height="180"></canvas>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title text-center">Top Bank Wealth</h4>
                          <canvas id="chr-bank-bar" width="180" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title text-center">Top Playtime</h4>
                        <canvas id="chr-pla-bar" width="180" height="180"></canvas>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title text-center">Top Combat</h4>
                        <canvas id="chr-com-bar" width="180" height="180"></canvas>
                      </div>
                  </div>
                </div>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="visualscores-pie" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Visual Scores - PIE</h3>
				          <li class="float-lg-left"><a class="btn btn-outline-success" id="gohome-vissco-pie">Go Back</a></li>
				          <li class="float-lg-right"><a class="btn btn-outline-success" id="govisualscores-bar">Bar Graphs</a></li>
              </ul>
            <br>
			      <br>
                <div class="row">

                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title text-center">Top Gang Wealth</h4>
                          <canvas id="chr-gbank-pie" width="180" height="180"></canvas>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title text-center">Top Bank Wealth</h4>
                          <canvas id="chr-bank-pie" width="180" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title text-center">Top Playtime</h4>
                        <canvas id="chr-pla-pie" width="180" height="180"></canvas>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title text-center">Top Combat</h4>
                        <canvas id="chr-com-pie" width="180" height="180"></canvas>
                      </div>
                  </div>
                </div>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="globalhistory" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Global History</h3>
				          <li class="float-lg-left"><a class="btn btn-outline-success" id="gohome-globalhistory">Go Back</a></li>
                  <?php sa_signin_btn() ?>
              </ul>
              <br>
			        <br>
                <div class="row">
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title text-center">Global History Bank</h4>
                          <canvas id="chr-his-bank" max-height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title text-center">Global History Playtime</h4>
                          <canvas id="chr-his-playtime" max-height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title text-center">Global History Player Count</h4>
                          <canvas id="chr-his-playercount" max-height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>   

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="playerlookup" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Player Look Up</h3>
			  	<li class="float-lg-left"><a class="btn btn-outline-success" id="gohome-playerlookup">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			      <br> 
              <div class="row">
                <div class="col-sm">

                  <div class="form-group">
                    <label for="Sel1">To Qualify for the tool:</label><br>
                    <label for="Sel1">- Have a registered player name.</label><br>
                    <label for="Sel1">- More than 5 hours playtime.</label><br>
                    <input type="text" class="form-control" placeholder="Filter by Name" id="FilterListPlayers">
                    <div class="input-group mb-3">
                      <select class="form-control" id="Sel1" name="users" onchange="showUser(this.value)">
                          <?php qry_lku_plalist(); ?>
                      </select>
                      <div class="input-group-append">
                         <span class="btn btn-info" onclick='showUser(Sel1.value)'>Search</span>
                      </div>
                  </div>
                </div>
              </div>

                <div class="col-sm">
                  <div id="pla-lookup-contents">
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">Please Select a Player</li>
                    </ul>
                  </div>
                </div>

              </div>
          </div>   
        </div>

        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="ganglookup" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Gang Look Up</h3>
			  	<li class="float-lg-left"><a class="btn btn-outline-success" id="gohome-ganglookup">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>

              <div class="row">
                <div class="col-sm">

                  <div class="form-group">
                    <label for="Sel2">To Qualify for the tool:</label><br>
                    <label for="Sel2">- No requirements at this time.</label><br>
                    <!--<input type="text" class="form-control" placeholder="Filter by Name" id="FilterListGangs">--> <!-- Not needed at this time, may add in the future. -->
                    <div class="input-group mb-3">
                      <select class="form-control" id="Sel2" name="gangs" onchange="showGang(this.value)">
                          <?php qry_lku_ganglist(); ?>
                      </select>
                      <div class="input-group-append">
                         <span class="btn btn-info" onclick='showGang(Sel2.value)'>Search</span>
                      </div>
                  </div>
                </div>
              </div>

                <div class="col-sm">
                  <div id="gang-lookup-contents">
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">Please Select a Gang</li>
                    </ul>
                  </div>
                </div>

              </div>
          </div>   
        </div>


        <div class="jumbotron shadow p-3 mb-5 bg-dark rounded" id="serverstats" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Server Stats</h3>
			  	<li class="float-lg-left"><a class="btn btn-outline-success" id="gohome-serverstats">Go Back</a></li>
				<?php sa_signin_btn() ?>
              </ul>
            <br>
			<br>

              <?php 

              require 'SourceQuery.php';
							$sq_server = new SourceQuery('104.153.105.245', 27019);
							$sq_infos  = $sq_server->getInfos(); 
							$sq_users  = $sq_server->getPlayers();
							
							?>

              <div class="row">
                <div class="col">
                  <div class="progress">
                    <?php 
                    if($sq_infos['players'] == 0){
                    $sq_perc=0;
                    }else{
                    $sq_x = $sq_infos['players'] / $sq_infos['places'] * 100;
                    $sq_perc=number_format($sq_x,0);
                    }
                    ?>
                    <div class="progress-bar bg-success" style="width: <?php echo $sq_perc; ?>%;" role="progressbar" aria-valuenow="<?php echo $sq_infos['players'] ?>" aria-valuemin="0" aria-valuemax="<?php echo $sq_infos['places'] ?>" data-toggle="tooltip" data-placement="bottom" title="Visual representation of occupied server slots."></div>
                  </div>
                </div>  
              </div>
              <br>
              <br>
              <div class="row">

                <div class="col-sm">
                  <div class="card border-secondary">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Hostname:
                        <?php echo $sq_infos['name']; ?>
                      </li>
                      <li class="list-group-item">Address:
                        <?php echo $sq_infos['ip'] . ":" . $sq_infos['port']; ?> - <a href="steam://connect/104.153.105.245:27019"> Connect </a>
                      </li>
                      <li class="list-group-item">Users:
                        <?php echo $sq_infos['players'] .'/'. $sq_infos['places']; ?>
                      </li>
                      <li class="list-group-item">Current Map:
                        <?php echo $sq_infos['map']; ?>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-sm">
                <?php
                      
                      foreach ($sq_users as $user_cur){
                        $d=0;$h=0;$m=0;
                        $pt_a=$user_cur['time']/60;
                        $pt = floor($pt_a);
                        if($pt < 60){
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


                        $d=number_format(floor($d),0); 
                        $h=number_format(floor($h),0);
                        $m=number_format(floor($m),0);

                        if($user_cur['name'] == null) {
                        echo "<li class='list-group-item'><a style='color:yellow;'>Connecting...</a></li> ";
                        }else if($d == 0 && $h == 0){
                        echo "<li class='list-group-item'>Name: " .$user_cur['name']. "<br>Time Online: ". $m ." minute(s) </li>\n";
                        }else if($d == 0){
                        echo "<li class='list-group-item'>Name: " .$user_cur['name']. "<br>Time Online: ". $h . " hour(s) / ". $m ." minute(s) </li>\n";
                        }else{
                        echo "<li class='list-group-item'>Name: " .$user_cur['name']. "<br>Time Online: ". $d ." day(s) / ".$h. " hour(s) / ". $m ." minute(s) </li>\n";
                        }
                      }
                      ?>
                </div>
              </div>
          </div>   
        </div>


        <div class="row">
          <div class="col-lg-12">
            <ul class="list-unstyled">
              <li class="float-lg-right"><a class="text-white" href="#top">Back to top</a></li>
              <li><p>Made by <a class="text-white" href="https://youtube.com/c/coderezzo">codeRezzo</a>.</p></li>
            </ul>
          </div>
        </div>

  </div>

  <script>
// This nasty from a performance perspective but it works so screw  it.
// I'll get it all moved to its own file in the end.

// Close Home screen and visit Ladders selection screen.
$('#goladders').click(function(e){
    $('#home').fadeOut('slow', function(){
        $('#ladders').fadeIn('slow');
    });
});

// Close Ladders and go back to home selection screen.
$('#gohome').click(function(e){
    $('#ladders').fadeOut('slow', function(){
        $('#home').fadeIn('slow');
    });
});

// opens bar graphs by default
$('#govisualscores').click(function(e){
    $('#home').fadeOut('slow', function(){
        $('#visualscores-bar').fadeIn('slow');
    });
});

//Close visual scores bar graphs and view pie graphs
$('#govisualscores-pie').click(function(e){
    $('#visualscores-bar').fadeOut('slow', function(){
        $('#visualscores-pie').fadeIn('slow');
    });
});

//Close visualscores pie graphs go to bar graphs.
$('#govisualscores-bar').click(function(e){
    $('#visualscores-pie').fadeOut('slow', function(){
        $('#visualscores-bar').fadeIn('slow');
    });
});


//Close visualscores bar graphs and go back to home.
$('#gohome-vissco-bar').click(function(e){
    $('#visualscores-bar').fadeOut('slow', function(){
        $('#home').fadeIn('slow');
    });
});

//Close visualscores pie graphs go back to home.
$('#gohome-vissco-pie').click(function(e){
    $('#visualscores-pie').fadeOut('slow', function(){
        $('#home').fadeIn('slow');
    });
});

//Open globalhistory and close home.
$('#goglobalhistory').click(function(e){
    $('#home').fadeOut('slow', function(){
        $('#globalhistory').fadeIn('slow');
    });
});

//Close globalhistory go back to home.
$('#gohome-globalhistory').click(function(e){
    $('#globalhistory').fadeOut('slow', function(){
        $('#home').fadeIn('slow');
    });
});

//Open the player lookup panel
$('#goplayerlookup').click(function(e){
    $('#home').fadeOut('slow', function(){
        $('#playerlookup').fadeIn('slow');
    });
});

// Close Player lookup and go back to home selection screen.
$('#gohome-playerlookup').click(function(e){
    $('#playerlookup').fadeOut('slow', function(){
        $('#home').fadeIn('slow');
    });
});

//Open the Gang lookup panel
$('#goganglookup').click(function(e){
    $('#home').fadeOut('slow', function(){
        $('#ganglookup').fadeIn('slow');
    });
});

// Close Gang lookup and go back to home selection screen.
$('#gohome-ganglookup').click(function(e){
    $('#ganglookup').fadeOut('slow', function(){
        $('#home').fadeIn('slow');
    });
});

//Open the Server Stats panel
$('#goserverstats').click(function(e){
    $('#home').fadeOut('slow', function(){
        $('#serverstats').fadeIn('slow');
    });
});

// Close server stats and go back to home selection screen.
$('#gohome-serverstats').click(function(e){
    $('#serverstats').fadeOut('slow', function(){
        $('#home').fadeIn('slow');
    });
});

// Handle going back.. for some reason each ladder needed its own function.
// Close the ladder and return to ladder selection.
// Each return-element required a unique ID.. otherwise it would've been so much simpler. :-|
// The order of these function is from left to right.
//Row 1
$('#gobackladders-pla').click(function(e){    
    $("#playtime").fadeOut('slow', function(){
        $('#ladders').fadeIn('slow');
    });
});
$('#gobackladders-eco').click(function(e){    
    $("#economy").fadeOut('slow', function(){
        $('#ladders').fadeIn('slow');
    });
});
$('#gobackladders-com').click(function(e){    
    $("#combat").fadeOut('slow', function(){
        $('#ladders').fadeIn('slow');
    });
});
//Row 2
$('#gobackladders-res').click(function(e){    
    $("#respect").fadeOut('slow', function(){
        $('#ladders').fadeIn('slow');
    });
});
$('#gobackladders-exp').click(function(e){    
    $("#experience").fadeOut('slow', function(){
        $('#ladders').fadeIn('slow');
    });
});
$('#gobackladders-due').click(function(e){    
    $("#dueling").fadeOut('slow', function(){
        $('#ladders').fadeIn('slow');
    });
});
//Row 3
$('#gobackladders-geco').click(function(e){    
    $("#gangeconomy").fadeOut('slow', function(){
        $('#ladders').fadeIn('slow');
    });
});
$('#gobackladders-gexp').click(function(e){    
    $("#gangexperience").fadeOut('slow', function(){
        $('#ladders').fadeIn('slow');
    });
});
$('#gobackladders-gres').click(function(e){    
    $("#gangrespect").fadeOut('slow', function(){
        $('#ladders').fadeIn('slow');
    });
});

// Handle opening of the ladders.
//Row 1
$('#goplaytime').click(function(e){    
    $('#ladders').fadeOut('slow', function(){
        $('#playtime').fadeIn('slow');
    });
});
$('#goeconomy').click(function(e){    
    $('#ladders').fadeOut('slow', function(){
        $('#economy').fadeIn('slow');
    });
});
$('#gocombat').click(function(e){    
    $('#ladders').fadeOut('slow', function(){
        $('#combat').fadeIn('slow');
    });
});
//Row 2
$('#gorespect').click(function(e){    
    $('#ladders').fadeOut('slow', function(){
        $('#respect').fadeIn('slow');
    });
});
$('#goexperience').click(function(e){    
    $('#ladders').fadeOut('slow', function(){
        $('#experience').fadeIn('slow');
    });
});
$('#godueling').click(function(e){    
    $('#ladders').fadeOut('slow', function(){
        $('#dueling').fadeIn('slow');
    });
});
//Row 3
$('#gogangeconomy').click(function(e){    
    $('#ladders').fadeOut('slow', function(){
        $('#gangeconomy').fadeIn('slow');
    });
});
$('#gogangexperience').click(function(e){    
    $('#ladders').fadeOut('slow', function(){
        $('#gangexperience').fadeIn('slow');
    });
});
$('#gogangrespect').click(function(e){    
    $('#ladders').fadeOut('slow', function(){
        $('#gangrespect').fadeIn('slow');
    });
});


</script>

 <!-- Js. -->
<script src="./vendor/chartjs/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="./vendor/chosen/chosen.jquery.js" type="text/javascript"></script>

<?php 
//GRAPHINC
//Handling of the inserting / js creation of the various graphs. Pie + Bar in one file.
include('./graphs/chr_gbank.php');
include('./graphs/chr_bank.php'); 
include('./graphs/chr_pla.php'); 
include('./graphs/chr_com.php'); 
include('./graphs/chr_his_bank.php'); 
include('./graphs/chr_his_playtime.php'); 
include('./graphs/chr_his_playercount.php'); 
?>


<script>

//Handling Player lookup AJAX request
function showUser(str) {
  if (str == "") {
    document.getElementById("pla-lookup-contents").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pla-lookup-contents").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","./queries/qry_ajx_plalookup.php?q="+str,true);
    xmlhttp.send();
  }
}

// Filtering the player list because there are just soo many users to look through.
$(document).ready(function(){
var $this, i, filter,
    $input = $('#FilterListPlayers'),
    $options = $('#Sel1').find('option');

$input.keyup(function(){
    filter = $(this).val();
    i = 1;
    $options.each(function(){
        $this = $(this);
        $this.removeAttr('selected');
        if ($this.text().indexOf(filter) != -1) {
            $this.show();
            if(i == 1){
                $this.attr('selected', 'selected');
            }
            i++;
        } else {
            $this.hide();
          }
    });
});

});

//Handling Gang lookup AJAX request
function showGang(str) {
  if (str == "") {
    document.getElementById("gang-lookup-contents").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("gang-lookup-contents").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","./queries/qry_ajx_ganglookup.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>

  </body>
</html>