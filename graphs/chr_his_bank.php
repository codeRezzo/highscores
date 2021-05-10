
<script>
//create server bank history
var GlobalHistory_Bank = new Chart(document.getElementById("chr-his-bank"), {
    type: 'line',
    data: {
        labels: <?php print json_encode($ser_his_date); ?>,
        datasets: [{
            label: 'Global Bank',
            data: <?php print json_encode($ser_his_bank); ?>,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    }
});
</script>