<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>REZZO.DEV</title>
        <link rel="icon" type="image/x-icon" href="vendor_home/assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="vendor_home/css/styles.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script src="./vendor/uploadify/jquery.uploadifive.js" type="text/javascript"></script>
    </head>

<?php 

  ///////////////////////////
  //Start Highscores (HL2DM)
  ///////////////////////////

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
  // lack Lists
  $banned_users = array("STEAM_0:1:25306470", "x"); //Player SteamID32
  $rust_banned_users = array("888777", "666888"); //Player SteamID32
  $banned_gangs = array("default_banned_gang-22-3", "default_banned_gang-22-2"); //Gang ID64
  // White Lists
  $rust_admins = array("76561197999834909", "76561197968614936"); //Player SteamID64
  //white Queries
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

  //Extras; (Funcs)
  include('./func/func_glow.php');
  include('./func/func_profile_control.php');
  include('./func/func_rust_admin.php');

  ///////////////////////////
  // Sign in Through Steam
  ///////////////////////////

  // Handle the Steam sign in process.
  require ('./vendor/steamauth/steamauth.php');
  function sa_signin_btn(){
    if(!isset($_SESSION['steamid'])) {

      echo '<li class="nav-item"><a class="nav-link" href="?login">Sign In</a></li>';
      } else {
      echo '<li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#myprofile">My Profile</a></li>';
      echo '<li class="nav-item"><a class="nav-link" href="?logout">Sign Out</a></li>';
      }  
  }

    if(isset($_SESSION['steamid'])) {
    include ('./vendor/steamauth/userInfo.php');

    // Successful sign in.
    include ('./queries/qry_prfl_signup.php');
    // Setup our signed in user.
    qry_prfl_setup();
    }

    ///////////////////////////
    //Start Rust Highscores
    ///////////////////////////
    //Ladders
    include('./ladders/ldr_rust_xp.php');
    //Queries
    include('./queries/qry_rust_xp.php');
?>

    <body id="page-top">
	  <style>::-webkit-scrollbar { display: none;}</style>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Rezzo.dev</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#hl2dm-hs">HL2:DM Highscores</a></li>
                        <li class="nav-item"><a class="nav-link" href="#rust-hs">Rust Highscores</a></li>
						            <li class="nav-item"><a class="nav-link" href="./maps/">Maps</a></li>
                        <li class="nav-item"><a class="nav-link" href="https://github.com/codeRezzo/">Github</a></li>
                        <li class="nav-item"><a class="nav-link" href="https://www.youtube.com/c/codeRezzo">Youtube</a></li>
						            <li class="nav-item"><a class="nav-link" href="https://discord.gg/RzvjycKxQF">Discord</a></li>
                        <?php sa_signin_btn(); ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">Aim_Ancient</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">Aztec themed aim map for CS:GO</h2>
                        <a class="btn btn-primary" href="https://steamcommunity.com/sharedfiles/filedetails/?id=2408059851">Download</a>
                    </div>
                </div>
            </div>
        </header>

        
<!-- Highscores HL2DM Start-->
<section class="highscores-hl2dm projects-section text-white" id="hl2dm-hs">
  <div id="home" class="container"><!-- Wrapper for home and patchnotes etc -->
      <ul class="list-unstyled">
        <h1 class="text-center text-white">Half-life 2: Deathmatch Highscores</h1> 
        <li class="float-lg-left"><a class="btn btn-primary" href="#page-top">Go Back</a></li>
      </ul>
      <br>
        <div class="row">
          <div class="col-sm">
            <div class="card border-white bg-transparent mb-3">
              <div class="card-body" id="goladders">
                <h4 class="card-title">Ladders</h4>
                <p class="card-text">Standard highscore leaderboards.</p>
              </div>
            </div>
          </div>
          <div class="col-sm">
            <div class="card border-white bg-transparent mb-3">
              <div class="card-body" id="govisualscores">
                <h4 class="card-title">Visual Scores</h4>
                <p class="card-text">Ladders, but in graph form.</p>
              </div>
            </div>
          </div>
          <div class="col-sm">
            <div class="card border-white bg-transparent mb-3">
              <div class="card-body" id="goplayerlookup">
                <h4 class="card-title">Player Look Up</h4>
                <p class="card-text">Look up information on a specific player.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <div class="card border-white bg-transparent mb-3">
              <div class="card-body" id="goserverstats" >
                <h4 class="card-title">Server Stats</h4>
                <p class="card-text">Bits of information about the game server.</p>
              </div>
            </div>
          </div>
          <div class="col-sm">
            <div class="card border-white bg-transparent mb-3">
                <div class="card-body" id="goglobalhistory">
                  <h4 class="card-title">Global History</h4>
                  <p class="card-text">30 Day global history.</p>
                </div>
            </div>
          </div>
          <div class="col-sm">
            <div class="card border-white bg-transparent mb-3">
              <div class="card-body" id="goganglookup">
                <h4 class="card-title">Gang Look Up</h4>
                <p class="card-text">Look up information on a specific Gang.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <div class="card border-danger bg-transparent mb-3">
              <div class="card-body" id="goheatmaps" >
                <h4 class="card-title text-danger">Heat Maps - Alpha</h4>
                <p class="card-text text-danger">The most popular places.</p>
              </div>
            </div>
          </div>
          <div class="col-sm">
          </div>
          <div class="col-sm">
          </div>
        </div>
  </div>

  <div class="container" id="ladders" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center text-white">Primary Ladders</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gohome">Go Back</a></li>
      </ul>
    <br>
    <br>
    <div class="card border-white bg-transparent text-white mb-3">
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

    <h1 class="text-center">Gang Ladders</h1> 
      <div class="card border-white bg-transparent mb-3">
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
  </div>   

  <div class="container" id="playtime" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Playtime Ladder</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gobackladders-pla">Go Back</a></li>
      </ul>
    <br>
    <br>
      <table class="table text-white">
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
                
  <div class="container" id="economy" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Economy Ladder</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gobackladders-eco">Go Back</a></li>
      </ul>
    <br>
    <br>
      <table class="table text-white">
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

  <div class="container" id="combat" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Combat Ladder</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gobackladders-com">Go Back</a></li>
      </ul>
    <br>
    <br>
      <table class="table text-white">
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
          
                  
  <div class="container" id="respect" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Respect Ladder</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gobackladders-res">Go Back</a></li>
      </ul>
    <br>
    <br>
      <table class="table text-white">
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
          
  <div class="container"  id="experience" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Experience Ladder</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gobackladders-exp">Go Back</a></li>
      </ul>
    <br>
    <br>
      <table class="table text-white">
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

  <div class="container" id="dueling" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Dueling Ladder</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gobackladders-due">Go Back</a></li>
      </ul>
    <br>
    <br>
      <table class="table text-white">
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
          
  <div class="container" id="gangeconomy" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Gang Economy Ladder</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gobackladders-geco">Go Back</a></li>
      </ul>
    <br>
    <br>
      <table class="table text-white">
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


  <div class="container" id="gangrespect" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Gang Respect Ladder</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gobackladders-gres">Go Back</a></li>
      </ul>
    <br>
    <br>
      <table class="table text-white">
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
          
  <div class="container" id="gangexperience" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Gang Experience Ladder</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gobackladders-gexp">Go Back</a></li>
      </ul>
    <br>
    <br>
      <table class="table text-white">
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
          

  <div class="container" id="visualscores-bar" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Visual Scores - BAR</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gohome-vissco-bar">Go Back</a></li>
        <li class="float-lg-right"><a class="btn btn-primary " id="govisualscores-pie">Pie Graphs</a></li>
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
          
  <div class="container" id="visualscores-pie" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Visual Scores - PIE</h1>
          <li class="float-lg-left"><a class="btn btn-primary " id="gohome-vissco-pie">Go Back</a></li>
          <li class="float-lg-right"><a class="btn btn-primary " id="govisualscores-bar">Bar Graphs</a></li>
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
          
  <div class="container" id="globalhistory" style="display:none;">
    <ul class="list-unstyled">
      <h1 class="text-center">Global History</h1>
      <li class="float-lg-left"><a class="btn btn-primary " id="gohome-globalhistory">Go Back</a></li>
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
          
  <div class="container" id="playerlookup" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Player Look Up</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gohome-playerlookup">Go Back</a></li>
      </ul>
      <br>
      <br> 
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="Sel1">To Qualify for the tool:</label><br>
            <label for="Sel1">- Have a registered player name.</label><br>
            <label for="Sel1">- More than 5 hours playtime.</label><br><br>
            <label for="Sel1">You can sign in through steam to Opt-Out of Player Look up.</label><br><br>
            <input type="text" class="form-control" placeholder="Filter by Name" id="FilterListPlayers">
            <div class="input-group mb-3">
              <select class="form-control" id="Sel1" name="users" onchange="showUser(this.value)">
                  <?php qry_lku_plalist(); ?>
              </select>
              <div class="input-group-append">
                  <span class="btn btn-white" onclick='showUser(Sel1.value)'>Search</span>
              </div>
          </div>
        </div>
      </div>
        <div class="col-sm">
          <div id="pla-lookup-contents">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center border-white bg-transparent text-white">Please Select a Player</li>
            </ul>
          </div>
        </div>
      </div>
  </div>   
          

  <div class="container" id="ganglookup" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Gang Look Up</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gohome-ganglookup">Go Back</a></li>
      </ul>
    <br>
    <br>
      <div class="row">
        <div class="col-sm">
          <div class="form-group border-white bg-transparent text-white mb-3">
            <label for="Sel2">To Qualify for the tool:</label><br>
            <label for="Sel2">- No requirements at this time.</label><br><br>
            <!--<input type="text" class="form-control" placeholder="Filter by Name" id="FilterListGangs">--> <!-- Not needed at this time, may add in the future. -->
            <div class="input-group mb-3">
              <select class="form-control" id="Sel2" name="gangs" onchange="showGang(this.value)">
                  <?php qry_lku_ganglist(); ?>
              </select>
              <div class="input-group-append">
                  <span class="btn btn-white" onclick='showGang(Sel2.value)'>Search</span>
              </div>
          </div>
        </div>
      </div>

        <div class="col-sm">
          <div id="gang-lookup-contents">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center border-white bg-transparent text-white">Please Select a Gang</li>
            </ul>
          </div>
        </div>
      </div>
  </div>   
          
          

  <div class="container" id="serverstats" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Server Stats</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gohome-serverstats">Go Back</a></li>
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
          <div class="card border-white bg-transparent text-white">
            <ul class="list-group list-group-flush">
              <li class="list-group-item border-white bg-transparent text-white">Hostname:
                <?php echo $sq_infos['name']; ?>
              </li>
              <li class="list-group-item border-white bg-transparent text-white">Address:
                <?php echo $sq_infos['ip'] . ":" . $sq_infos['port']; ?> - <a href="steam://connect/104.153.105.245:27019"> Connect </a>
              </li>
              <li class="list-group-item border-white bg-transparent text-white">Users:
                <?php echo $sq_infos['players'] .'/'. $sq_infos['places']; ?>
              </li>
              <li class="list-group-item border-white bg-transparent text-white">Current Map:
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
                echo "<li class='list-group-item border-white bg-transparent text-white'><a style='color:yellow;'>Connecting...</a></li> ";
                }else if($d == 0 && $h == 0){
                echo "<li class='list-group-item border-white bg-transparent text-white'>Name: " .$user_cur['name']. "<br>Time Online: ". $m ." minute(s) </li>\n";
                }else if($d == 0){
                echo "<li class='list-group-item border-white bg-transparent text-white'>Name: " .$user_cur['name']. "<br>Time Online: ". $h . " hour(s) / ". $m ." minute(s) </li>\n";
                }else{
                echo "<li class='list-group-item border-white bg-transparent text-white'>Name: " .$user_cur['name']. "<br>Time Online: ". $d ." day(s) / ".$h. " hour(s) / ". $m ." minute(s) </li>\n";
                }
              }
              ?>
        </div>
      </div>
    </div>   
          
                  

    <div class="container" id="heatmaps" style="display:none;"> 
      <ul class="list-unstyled">
        <h1 class="text-center">Heat Maps - Alpha</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="gohome-heatmaps">Go Back</a></li>
      </ul>
      <br>
      <br>
      <div class="container">
        <div class="shadow" id="hm-primary" style="width: 1024px;height: 1024px;"></div>
      </div>
    </div> 
  </div>
</section>

<!-- Highscores Rust Start-->
<section class="highscores-rust projects-section text-white" id="rust-hs">
  <div id="rust-home" class="container"><!-- Wrapper for home and patchnotes etc -->
    <ul class="list-unstyled">
      <h1 class="text-center text-white">Rust Highscores</h1> 
      <li class="float-lg-left"><a class="btn btn-primary" href="#page-top">Go Back</a></li>
    </ul>
    <br>
      <div class="row">
        <div class="col-sm">
          <div class="card border-white bg-transparent mb-3">
            <div class="card-body" id="gorust-exp">
              <h4 class="card-title">Experience Leaders</h4>
              <p class="card-text">Top 100 players for earned experience.</p>
            </div>
          </div>
        </div>
        <div class="col-sm">
        </div>
        <div class="col-sm">
        </div>
      </div>
  </div>

  <div class="container" id="rust-exp" style="display:none;">
      <ul class="list-unstyled">
        <h1 class="text-center">Experience Leaders</h1>
        <li class="float-lg-left"><a class="btn btn-primary " id="goback-rustexp">Go Back</a></li>
      </ul>
    <br>
    <br>
      <table class="table text-white">
        <thead>
          <tr>
            <th scope="col">Rank</th>
            <th scope="col">Player</th>
            <th scope="col">Experience</th>
          </tr>
        </thead>
        <tbody>
        <?php tbl_rust_xp($qret_rust_xp, $rust_banned_users) ?>
        </tbody>
      </table>
  </div>   
</section>

<!-- PROFILE -->
    <div class="modal fade" id="myprofile" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
            <h5 class="modal-title"><?php if(isset($_SESSION['steamid'])) {echo "Welcome to your profile, " . $steamprofile['personaname']. "\n"; } else {echo "User Not Signed in...? Error: SP1";}?></h5>
          </div>
          <div class="modal-body">
            <div class="row">
            <label for="Sel1">Opt-In / Out of Features</label>
            <?php 
            if(isset($_SESSION['steamid'])){
              //load profile controls (send steamid)
            func_profile_control($steamprofile['steamid']);
            } else {
              echo "User Not signed in Error: SP5";
            }
            ?>
              <div class="col-md-6">
                <div id="profile-update-info">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-white text-white">No changes detected.</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="row">
              <?php 
                if(isset($_SESSION['steamid']) && in_array($steamprofile['steamid'], $rust_admins)){
                //Load rust admin controls
                func_rust_admin();
                } else {
                  echo "Rust Admin Status - False";
                }
                ?>
            </div>
          <div>
          <div class="modal-footer">
            <a class="btn btn-white" href="javascript:window.location.reload(true)">Refresh</a>
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
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

  //Open the Server Stats panel
  $('#goheatmaps').click(function(e){
    $('#home').fadeOut('slow', function(){
        $('#heatmaps').fadeIn('slow');
    });
  });

  // Close server stats and go back to home selection screen.
  $('#gohome-heatmaps').click(function(e){
    $('#heatmaps').fadeOut('slow', function(){
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

  <script>
    //Rust Panel controls 
  
  // Go to rust EXP Ladder, close home.
 $('#gorust-exp').click(function(e){
    $('#rust-home').fadeOut('slow', function(){
        $('#rust-exp').fadeIn('slow');
    });
  });

  //Leave Rust XP Ladder, go to rust home.
  $('#goback-rustexp').click(function(e){
    $('#rust-exp').fadeOut('slow', function(){
        $('#rust-home').fadeIn('slow');
    });
  });

  </script>

  <!-- Js. -->
  <script src="./vendor/chartjs/Chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./vendor/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="./vendor/heatjs/simpleheat.js"></script>
  <script src="./vendor/anychartjs/anychart.js"></script>

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
  </div>

  <!-- Footer-->
  <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; Rezzo.dev</div></footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="vendor_home/js/scripts.js"></script>

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

  <script>
  //T2D for the heatmap primary
  var data = [
    {x: 92.049, value: 136.68},
    {x: -45.19, value: 83.57},
    {x: -45.04, value: -77.95},
    {x: 19.77, value: -18.44},
    {x: 58.07, value: -77.91},
    {x: 42.61, value: -24.69}
  ];

  chart = anychart.scatter(data);
    chart.quarters(
      {
          rightTop: {
              fill: "#303030"
          },
          rightBottom: {
              fill: "#303030"
          },
          leftTop: {
              fill: "#303030"
          },
          leftBottom: {
              fill: "#303030"
          },
      }
    );

  chart.crossing().stroke("#303030");

  chart.yScale().minimum(-256);
  chart.yScale().maximum(256);
  chart.xScale().minimum(-256);
  chart.xScale().maximum(256);

  chart.background().fill("#303030");

  chart.xGrid().enabled(true);
  chart.yGrid().enabled(true);
  chart.xMinorGrid().enabled(true);
  chart.yMinorGrid().enabled(true);

  chart.xAxis().stroke({
    color: "#404040",
  });
  chart.yAxis().stroke({
    color: "#404040",
  });

  chart.xGrid().stroke({
    color: "#454545",
  });
  chart.yGrid().stroke({
    color: "#454545",
  });
  chart.xMinorGrid().stroke({
    color: "#404040",
  });
  chart.yMinorGrid().stroke({
    color: "#404040",
  });

  // Background...for when we need it.
  /*chart.background().fill({
    src: "./images/bendor/map1.jpg",
    mode: "fit"
  });*/

  chart.container("hm-primary");
  chart.draw();
</script>
    </body>
</html>
