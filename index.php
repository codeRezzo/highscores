<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="./vendor/bootstrap/css/custom.min.css">
     <link rel="stylesheet" href="./vendor/wavewrapper.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

</head>
<html>
  <body style="min-height: 100vh; background: rgb(255,255,255);
  background: linear-gradient(210deg, rgba(255,255,255,1) 0%, rgba(190,190,190,1) 51%, rgba(255,255,255,1) 100%);">


<?php 
//Connect
include('connect.php');

//Primary Ladders
include('./ladders/ldr_pla.php');
include('./ladders/ldr_eco.php');
include('./ladders/ldr_com.php');
include('./ladders/ldr_res.php');
include('./ladders/ldr_exp.php');
include('./ladders/ldr_due.php');

// blacklist
$banned_users = array("STEAM_0:1:25306470", "x");

//Primary Queries
include('./queries/qry_pla.php');
include('./queries/qry_eco.php');
include('./queries/qry_com.php');
include('./queries/qry_res.php');
include('./queries/qry_exp.php');
include('./queries/qry_due.php');

//Graph queries (actual graph creation includes are at the bottom of the page ctrl+f tag: GRAPHINC)
include('./queries/qry_grp_gbank.php');
include('./queries/qry_grp_bank.php');
include('./queries/qry_grp_pla.php');
include('./queries/qry_grp_com.php');

?>

  <div class="container">
    <h1 class="display-2 text-center">Rezzo.Dev</h1>
    <div class="jumbotron shadow p-3 mb-5 bg-white rounded" id="home">
      <div class="container">
        <h3 class="text-center">Select a Section</h3> 
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
              <div class="card border-danger mb-3">
                <div class="card-body" id="goplayerlookup">
                  <h4 class="card-title">Player Look Up</h4>
                  <p class="card-text">Look up information on a specific player.</p>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>

        <div class="jumbotron shadow p-3 mb-5 bg-white rounded" id="ladders" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Primary Ladders</h3>
                <li class="float-lg-left" id="gohome">Go Back</li>
              </ul>
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
              <div class="card border-danger mb-3">
                <div class="row">
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title">Economy Ladder</h4>
                        <p class="card-text">$GID is rank #1 with a combined total of $cash banked.</p>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title">Respect Ladder</h4>
                        <p class="card-text">$GID is rank #1 with a combined total of $respect rebel respect points.</p>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title">Experience Ladder</h4>
                        <p class="card-text">$GID is rank #1 with a combined total of $experience cop experience points.</p>
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
                          <p class="card-text">$PID is rank #1 by beating opening $pcount Pinatas.</p>
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

        <div class="jumbotron shadow p-3 mb-5 bg-white rounded" id="playtime" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Playtime Ladder</h3>
                <li class="float-lg-left" id="gobackladders-pla">Go Back</li>
                <li class="float-lg-right">Displaying Rows 0-25</li>
              </ul>

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
      
        <div class="jumbotron shadow p-3 mb-5 bg-white rounded" id="economy" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Economy Ladder</h3>
                <li class="float-lg-left" id="gobackladders-eco">Go Back</li>
                <li class="float-lg-right">Displaying Rows 0-25</li>
              </ul>

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

        <div class="jumbotron shadow p-3 mb-5 bg-white rounded" id="combat" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Combat Ladder</h3>
                <li class="float-lg-left" id="gobackladders-com">Go Back</li>
                <li class="float-lg-right">Displaying Rows 0-25</li>
              </ul>

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

        <div class="jumbotron shadow p-3 mb-5 bg-white rounded" id="respect" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Respect Ladder</h3>
                <li class="float-lg-left" id="gobackladders-res">Go Back</li>
                <li class="float-lg-right">Displaying Rows 0-25</li>
              </ul>

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

        <div class="jumbotron shadow p-3 mb-5 bg-white rounded" id="experience" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Experience Ladder</h3>
                <li class="float-lg-left" id="gobackladders-exp">Go Back</li>
                <li class="float-lg-right">Displaying Rows 0-25</li>
              </ul>

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

        <div class="jumbotron shadow p-3 mb-5 bg-white rounded" id="dueling" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Dueling Ladder</h3>
                <li class="float-lg-left" id="gobackladders-due">Go Back</li>
                <li class="float-lg-right">Displaying Rows 0-25</li>
              </ul>

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

        <div class="jumbotron shadow p-3 mb-5 bg-white rounded" id="visualscores-bar" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Visual Scores - BAR</h3>
                <li class="float-lg-left" id="gohome-vissco-bar">Go Back</li>
                <li class="float-lg-right"id="govisualscores-pie" >View as Pie Graphs</li>
              </ul><br>
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

        <div class="jumbotron shadow p-3 mb-5 bg-white rounded" id="visualscores-pie" style="display:none;">
          <div class="container">
              <ul class="list-unstyled">
                <h3 class="text-center">Visual Scores - PIE</h3>
                <li class="float-lg-left" id="gohome-vissco-pie">Go Back</li>
                <li class="float-lg-right" id="govisualscores-bar">View as Bar Graphs</li>
              </ul><br>
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


        <div class="row">
          <div class="col-lg-12">
            <ul class="list-unstyled">
              <li class="float-lg-right"><a class="text-primary" href="#top">Back to top</a></li>
              <li><p>Made by <a class="text-primary" href="https://youtube.com/c/coderezzo">codeRezzo</a>.</p></li>
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
// Open Ladder combat
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
</script>

 <!-- Js. -->
<script src="./vendor/chartjs/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<?php 
//GRAPHINC
// Handling of the inserting / js creation of the various graphs. Pie + Bar in one file.
include('./graphs/chr_gbank.php');
include('./graphs/chr_bank.php'); 
include('./graphs/chr_pla.php'); 
include('./graphs/chr_com.php'); 
?>

  </body>
</html>