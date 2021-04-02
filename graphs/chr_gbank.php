<script>
//create gang bank bar graph
var ctx = document.getElementById('chr-gbank-bar').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php print json_encode($gbank_bar_name); ?>,
        datasets: [{
            label: 'Gang Bank',
            data: <?php print json_encode($gbank_bar_bank); ?>,
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

//create gang bank pie graph
var ctx = document.getElementById('chr-gbank-pie').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php print json_encode($gbank_pie_name); ?>,
        datasets: [{
            label: 'Gang Bank',
            data: <?php print json_encode($gbank_pie_bank); ?>,
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