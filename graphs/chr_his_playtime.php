
<script>
//create server playtime history
var GlobalHistory_Bank = new Chart(document.getElementById("chr-his-playtime"), {
    type: 'line',
    data: {
        labels: <?php print json_encode($ser_his_date); ?>,
        datasets: [{
            label: 'Global Playtime',
            data: <?php print json_encode($ser_his_playtime); ?>,
            fill: true,
            backgroundColor: 'rgba(100, 122, 255, 0.4)',
            borderColor: 'rgb(100, 122, 255)',
            tension: 0.1
        }]
    },
    options: { 
            legend: {
                labels: {
                    fontColor: "white"
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontColor: "white"
                    }
                }],
                xAxes: [{
                    ticks: {
                        fontColor: "white"
                    }
                }]
            }
        }
});
</script>