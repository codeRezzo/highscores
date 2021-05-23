
<script>
//create server playtime history
var GlobalHistory_Bank = new Chart(document.getElementById("chr-his-playercount"), {
    type: 'line',
    data: {
        labels: <?php print json_encode($ser_his_date); ?>,
        datasets: [{
            label: 'Global Player Count',
            data: <?php print json_encode($ser_his_playercount); ?>,
            fill: true,
            backgroundColor: 'rgba(255, 100, 122, 0.4)',
            borderColor: 'rgb(255, 100, 122)',
            tension: 0.1
        }]
    }
});
</script>