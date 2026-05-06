<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>

<body>

<div id="hourChart" style="width: 500px; height: 350px;"></div>
<div id="cityChart" style="width: 500px; height: 350px;"></div>
</body>
<script>
    let hoursData = {!! $hourly !!};
    let cityData = {!! json_encode($city) !!};
    const optionsLine = {
        chart: {
            type: 'line'
        },
        series: [{
            name: 'Визиты',
            data: hoursData
        }],
        xaxis: {
            type: 'datetime',
            labels: {
                format: 'HH:00',
            },
        }
    }
    const optionsPie = {
        chart: { type: 'donut'},
        series: cityData.x, //Количество по городам
        labels: cityData.y, //Названия городов
    }
    var chart1 = new ApexCharts(document.querySelector("#hourChart"), optionsLine);
    var chart2 = new ApexCharts(document.querySelector("#cityChart"), optionsPie);

    chart1.render();
    chart2.render();
</script>
</html>
