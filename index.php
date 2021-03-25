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
//Queries
include('csb_c.php');

// Primary Ladders
include('ldr_pla.php');
include('ldr_eco.php');
include('ldr_com.php');
include('ldr_res.php');
include('ldr_exp.php');
include('ldr_due.php');

// blacklist
$banned_users = array("STEAM_0:1:25306470", "x");

//Playtime
$q_pla = "SELECT * FROM `cs_banks_primary` ORDER BY `cs_banks_primary`.`minutes` DESC;";
$qret_pla = mysqli_query($csdb_link, $q_pla);

while($pla_row = mysqli_fetch_array($qret_pla)){
  $pn = $pla_row['steam_id'];
  if(!in_array($pn, $banned_users)){
  $pt=$pla_row['minutes'];
  $d=0;$h=0;$m=0;
    if($pt <= 60){
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
  }
  $d=number_format($d,0); 
  $h=number_format($h,0);
  $m=number_format($m,0);

  $pla_topname = $pla_row['name'];
  break;
}
//reset locaion in array.
mysqli_data_seek( $qret_pla, 0 );

//Economy
$q_eco =   "SELECT cs_banks_primary.steam_id, cs_banks_primary.cash, cs_banks_primary.bank, cs_banks_primary.income, cs_banks_secondary.cash, cs_banks_secondary.bank,cs_banks_secondary.income, cs_banks_primary.name FROM cs_banks_primary INNER JOIN cs_banks_secondary ON cs_banks_primary.steam_id=cs_banks_secondary.steam_id ORDER BY cs_banks_primary.bank DESC LIMIT 25";
$qret_eco = mysqli_query($csdb_link, $q_eco);

while($eco_row = mysqli_fetch_array($qret_eco)){ 
  $eco_topname = $eco_row['name'];
  $eco_topbank =number_format( $eco_row['bank']); 
  break; 
}
//reset locaion in array.
mysqli_data_seek($qret_eco, 0 );

//Combat
$q_com = "SELECT cs_elo_primary.steam_id, cs_elo_primary.elo, cs_elo_primary.kills, cs_elo_primary.deaths, cs_elo_secondary.elo, cs_elo_secondary.kills,cs_elo_secondary.deaths, cs_elo_primary.name FROM cs_elo_primary INNER JOIN cs_elo_secondary ON cs_elo_primary.steam_id=cs_elo_secondary.steam_id ORDER BY cs_elo_primary.elo DESC LIMIT 25";
$qret_com = mysqli_query($csdb_link, $q_com);
  
while($com_row = mysqli_fetch_array($qret_com)){ 
  $com_topname = $com_row['name']; 
  $com_topelo = number_format($com_row['1'],0); //targets the first elo column. (this is the primary elo table <latest snapshot>)
  break; 
}
mysqli_data_seek( $qret_com, 0 );

//Respect
$q_res = "SELECT * FROM `cs_expresp_ladder` WHERE `respect` < '500000' ORDER BY `respect` DESC LIMIT 25";
$qret_res = mysqli_query($csdb_link, $q_res);

while($res_row = mysqli_fetch_array($qret_res)){ 
  $res_topname = $res_row['name']; 
  $res_toppoints = number_format($res_row['respect'],0); 
  break; 
}
mysqli_data_seek( $qret_res, 0 );


//Experience
$q_exp = "SELECT * FROM `cs_expresp_ladder` WHERE `experience` < '500000' ORDER BY `experience` DESC LIMIT 25";
$qret_exp = mysqli_query($csdb_link, $q_exp);

while($exp_row = mysqli_fetch_array($qret_exp)){ 
  $exp_topname = $exp_row['name']; 
  $exp_toppoints = number_format($exp_row['experience'],0); 
  break; 
}
mysqli_data_seek( $qret_exp, 0 );

//Dueling
$q_due = "SELECT bluerp_players.steam_id, bluerp_players.username, bluerp_dmstats.wins, bluerp_dmstats.losses, bluerp_dmstats.total_dms, bluerp_dmstats.kills, bluerp_dmstats.deaths FROM bluerp_players INNER JOIN bluerp_dmstats ON bluerp_players.steam_id=bluerp_dmstats.steam_id ORDER BY bluerp_dmstats.wins DESC LIMIT 25";
$qret_due = mysqli_query($cold_link, $q_due);

while($due_row = mysqli_fetch_array($qret_due)){ 
  $due_topname = $due_row['username']; 
  $due_topwins = number_format($due_row['wins'],0); 
  break; 
}
mysqli_data_seek( $qret_due, 0 );
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
                          <canvas id="Chart1-bar" width="180" height="180"></canvas>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title text-center">Top Bank Wealth</h4>
                          <canvas id="Chart2-bar" width="180" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title text-center">Top Playtime</h4>
                        <canvas id="Chart3-bar" width="180" height="180"></canvas>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title text-center">Top Combat</h4>
                        <canvas id="Chart4-bar" width="180" height="180"></canvas>
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
                          <canvas id="Chart1-pie" width="180" height="180"></canvas>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                          <h4 class="card-title text-center">Top Bank Wealth</h4>
                          <canvas id="Chart2-pie" width="180" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title text-center">Top Playtime</h4>
                        <canvas id="Chart3-pie" width="180" height="180"></canvas>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card-body">
                        <h4 class="card-title text-center">Top Combat</h4>
                        <canvas id="Chart4-pie" width="180" height="180"></canvas>
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
  <script src="./vendor/chartjs/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script>
// Set One - BAR
<?php 
$query = "SELECT * FROM `cs_gangs` ORDER BY `gang_bank` DESC LIMIT 10";
$sql = mysqli_query($csdb_link, $query);
$gang_bank= array();
$names= array();
while($r = mysqli_fetch_assoc($sql)) {
    $gang_bank[] = $r['gang_bank'];
    $names[] = $r['gang_name'];
}
?>
var ctx = document.getElementById('Chart1-bar').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php print json_encode($names); ?>,
        datasets: [{
            label: 'Gang Bank',
            data: <?php print json_encode($gang_bank); ?>,
            backgroundColor: [
                'rgba(255, 102, 102, 0.5)',
                'rgba(255, 140, 102, 0.5)',
                'rgba(255, 179, 102, 0.5)',
                'rgba(255, 217, 102, 0.5)',
                'rgba(255, 255, 102, 0.5)',
                'rgba(217, 255, 102, 0.5)',
                'rgba(179, 255, 102, 0.5)',
                'rgba(140, 255, 102, 0.5)',
                'rgba(102, 255, 102, 0.5)',
                'rgba(102, 255, 140, 0.5)'
            ],
            borderColor: [
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)'
            ],
            borderWidth: 1
        }]
    }
});

// Set One - PIE
var ctx = document.getElementById('Chart1-pie').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php print json_encode($names); ?>,
        datasets: [{
            label: 'Gang Bank',
            data: <?php print json_encode($gang_bank); ?>,
            backgroundColor: [
                'rgba(255, 102, 102, 0.5)',
                'rgba(255, 140, 102, 0.5)',
                'rgba(255, 179, 102, 0.5)',
                'rgba(255, 217, 102, 0.5)',
                'rgba(255, 255, 102, 0.5)',
                'rgba(217, 255, 102, 0.5)',
                'rgba(179, 255, 102, 0.5)',
                'rgba(140, 255, 102, 0.5)',
                'rgba(102, 255, 102, 0.5)',
                'rgba(102, 255, 140, 0.5)'
            ],
            borderColor: [
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)'
            ],
            borderWidth: 1
        }]
    }
});

// Set Two - BAR
<?php 
$query = "SELECT * FROM `cs_banks_primary` ORDER BY `bank` DESC LIMIT 10";
$sql = mysqli_query($csdb_link, $query);
$banks= array();
$names= array();
while($r = mysqli_fetch_assoc($sql)) {
    $banks[] = $r['bank'];
    $names[] = $r['name'];
}
?>
var ctx = document.getElementById('Chart2-bar').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php print json_encode($names); ?>,
        datasets: [{
            label: 'Bank',
            data: <?php print json_encode($banks); ?>,
            backgroundColor: [
                'rgba(255, 102, 102, 0.5)',
                'rgba(255, 140, 102, 0.5)',
                'rgba(255, 179, 102, 0.5)',
                'rgba(255, 217, 102, 0.5)',
                'rgba(255, 255, 102, 0.5)',
                'rgba(217, 255, 102, 0.5)',
                'rgba(179, 255, 102, 0.5)',
                'rgba(140, 255, 102, 0.5)',
                'rgba(102, 255, 102, 0.5)',
                'rgba(102, 255, 140, 0.5)'
            ],
            borderColor: [
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)'
            ],
            borderWidth: 1
        }]
    }
});

// Set Two - PIE
var ctx = document.getElementById('Chart2-pie').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php print json_encode($names); ?>,
        datasets: [{
            label: 'Bank',
            data: <?php print json_encode($banks); ?>,
            backgroundColor: [
                'rgba(255, 102, 102, 0.5)',
                'rgba(255, 140, 102, 0.5)',
                'rgba(255, 179, 102, 0.5)',
                'rgba(255, 217, 102, 0.5)',
                'rgba(255, 255, 102, 0.5)',
                'rgba(217, 255, 102, 0.5)',
                'rgba(179, 255, 102, 0.5)',
                'rgba(140, 255, 102, 0.5)',
                'rgba(102, 255, 102, 0.5)',
                'rgba(102, 255, 140, 0.5)'
            ],
            borderColor: [
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)'
            ],
            borderWidth: 1
        }]
    }
});

// Set Three - BAR
<?php 
$query = "SELECT * FROM `cs_banks_primary` WHERE `steam_id` != 'STEAM_0:1:25306470' ORDER BY `minutes` DESC LIMIT 10";
$sql = mysqli_query($csdb_link, $query);
$minutes= array();
$names= array();
while($r = mysqli_fetch_assoc($sql)) {
    $minutes[] = $r['minutes'];
    $names[] = $r['name'];
}
?>
var ctx = document.getElementById('Chart3-bar').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php print json_encode($names); ?>,
        datasets: [{
            label: 'Playtime',
            data: <?php print json_encode($minutes); ?>,
            backgroundColor: [
                'rgba(255, 102, 102, 0.5)',
                'rgba(255, 140, 102, 0.5)',
                'rgba(255, 179, 102, 0.5)',
                'rgba(255, 217, 102, 0.5)',
                'rgba(255, 255, 102, 0.5)',
                'rgba(217, 255, 102, 0.5)',
                'rgba(179, 255, 102, 0.5)',
                'rgba(140, 255, 102, 0.5)',
                'rgba(102, 255, 102, 0.5)',
                'rgba(102, 255, 140, 0.5)'
            ],
            borderColor: [
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)'
            ],
            borderWidth: 1
        }]
    }
});

// Set Three - PIE
var ctx = document.getElementById('Chart3-pie').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php print json_encode($names); ?>,
        datasets: [{
            label: 'Playtime',
            data: <?php print json_encode($minutes); ?>,
            backgroundColor: [
                'rgba(255, 102, 102, 0.5)',
                'rgba(255, 140, 102, 0.5)',
                'rgba(255, 179, 102, 0.5)',
                'rgba(255, 217, 102, 0.5)',
                'rgba(255, 255, 102, 0.5)',
                'rgba(217, 255, 102, 0.5)',
                'rgba(179, 255, 102, 0.5)',
                'rgba(140, 255, 102, 0.5)',
                'rgba(102, 255, 102, 0.5)',
                'rgba(102, 255, 140, 0.5)'
            ],
            borderColor: [
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)'
            ],
            borderWidth: 1
        }]
    }
});

// Set Four - BAR
<?php 
$query = "SELECT * FROM `cs_elo_primary` ORDER BY `elo` DESC LIMIT 10";
$sql = mysqli_query($csdb_link, $query);
$elo= array();
$names= array();
while($r = mysqli_fetch_assoc($sql)) {
    $elo[] = $r['elo'];
    $names[] = $r['name'];
}
?>
var ctx = document.getElementById('Chart4-bar').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php print json_encode($names); ?>,
        datasets: [{
            label: 'Combat',
            data: <?php print json_encode($elo); ?>,
            backgroundColor: [
                'rgba(255, 102, 102, 0.5)',
                'rgba(255, 140, 102, 0.5)',
                'rgba(255, 179, 102, 0.5)',
                'rgba(255, 217, 102, 0.5)',
                'rgba(255, 255, 102, 0.5)',
                'rgba(217, 255, 102, 0.5)',
                'rgba(179, 255, 102, 0.5)',
                'rgba(140, 255, 102, 0.5)',
                'rgba(102, 255, 102, 0.5)',
                'rgba(102, 255, 140, 0.5)'
            ],
            borderColor: [
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)'
            ],
            borderWidth: 1
        }]
    }
});

//Set Four - PIE
var ctx = document.getElementById('Chart4-pie').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php print json_encode($names); ?>,
        datasets: [{
            label: 'Combat',
            data: <?php print json_encode($elo); ?>,
            backgroundColor: [
                'rgba(255, 102, 102, 0.5)',
                'rgba(255, 140, 102, 0.5)',
                'rgba(255, 179, 102, 0.5)',
                'rgba(255, 217, 102, 0.5)',
                'rgba(255, 255, 102, 0.5)',
                'rgba(217, 255, 102, 0.5)',
                'rgba(179, 255, 102, 0.5)',
                'rgba(140, 255, 102, 0.5)',
                'rgba(102, 255, 102, 0.5)',
                'rgba(102, 255, 140, 0.5)'
            ],
            borderColor: [
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)',
                'rgba(50, 50, 50, 0.2)'
            ],
            borderWidth: 1
        }]
    }
});
</script>

  </body>
</html>