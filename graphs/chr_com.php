<script>
//create combat graph  bar
var ctx = document.getElementById('chr-com-bar').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php print json_encode($com_bar_name); ?>,
        datasets: [{
            label: 'Combat',
            data: <?php print json_encode($com_bar_elo); ?>,
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

//create combat graph pie
var ctx = document.getElementById('chr-com-pie').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php print json_encode($com_pie_name); ?>,
        datasets: [{
            label: 'Combat',
            data: <?php print json_encode($com_pie_elo); ?>,
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