<?php

function func_glow($i){
$i = $i;
    if($i >= 0 && $i <= 9){
        $glow = '<td style = "color:#919191; text-shadow: 2px 2px 4px #919191;">';//gray
    }elseif($i >= 10 && $i <= 19){
        $glow = '<td style = "color:#ff2b2b;text-shadow: 2px 2px 4px #ff2b2b;">';//red
    }elseif($i >= 20 && $i <= 29){
        $glow = '<td style = "color:#ff9100;text-shadow: 2px 2px 4px #ff9100;">';//orange
    }elseif($i >= 30 && $i <= 39){
        $glow = '<td style = "color:#ffea00;text-shadow: 2px 2px 4px #ffea00;">';//yellow
    }elseif($i >= 40 && $i <= 49){
        $glow = '<td style = "color:#07de00;text-shadow: 2px 2px 4px #07de00;">';//green
    }elseif($i >= 50 && $i <= 59){
        $glow = '<td style = "color:#00ccff;text-shadow: 2px 2px 4px #00ccff;">';//light blue
    }elseif($i >= 60 && $i <= 69){
        $glow = '<td style = "color:#ac40ff;text-shadow: 2px 2px 4px #ac40ff;">';//purple
    }elseif($i >= 70 && $i <= 79){
        $glow = '<td style = "color:#f540ff;text-shadow: 2px 2px 4px #f540ff;">';//pink
    }elseif($i >= 80 && $i <= 89){
        $glow = '<td style = "color:#800020;text-shadow: 2px 2px 4px #800020;">';//dark-red
    }elseif($i >= 90 && $i <= 99){
        $glow = '<td style = "color:#c39b77;text-shadow: 2px 2px 4px #c39b77;">';//light brown
    }else{
        $glow = '<td style = "color:#ffcc40;text-shadow: 2px 2px 4px g#ffcc40;">';//Gold - anyone above 100 income.
    }
return $glow;
}

?>

