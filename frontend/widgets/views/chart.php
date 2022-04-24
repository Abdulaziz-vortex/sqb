<?php
?>

<div>
    <canvas id="myChart"></canvas>
</div>


<script>

    let chart = document.getElementById('myChart').getContext('2d');
    var gradientStroke = chart.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, "#80b6f4");
    gradientStroke.addColorStop(1, "#17b8a9");

    const labels = [
        <?php foreach ($month as $date): echo '\''.date('Y-m-d',strtotime($date)).'\','; endforeach; ?>
    ];

    let val = [ <?php foreach ($value as $item): echo $item.','; endforeach; ?>];

    let max = Math.max.apply(Math, val) + 2;
    let min = Math.min.apply(Math, val) - 2;

    const data = {
        labels: labels,
        datasets: [{
            label: 'Value',
            backgroundColor: gradientStroke,
            borderColor: gradientStroke,
            data: [ <?php foreach ($value as $item): echo $item.','; endforeach; ?>],
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    display: true,
                    stacked: true,
                    max: max,
                    min: min

                }
            }
        }
    };


    const myChart = new Chart(
        chart,
        config
    );
</script>
