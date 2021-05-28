
<script>
//create server bank history
var GlobalHistory_Bank = new Chart(document.getElementById("chr-his-bank"), {
    type: 'line',
    data: {
        labels: <?php print json_encode($ser_his_date); ?>,
        datasets: [{
            label: 'Global Bank',
            data: <?php print json_encode($ser_his_bank); ?>,
            fill: true,
            backgroundColor: 'rgba(75, 192, 192, 0.4)',
            borderColor: 'rgb(75, 192, 192)',
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