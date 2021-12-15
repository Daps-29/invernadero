<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Temperatura', 'Humedad'],
          ['50',  10,      6],
          ['100',  8,     10],
          ['150',  8,      9],
          ['200',  9,      8]
        ]);

        var options = {
          title: 'PRECIPITACIONES DE LLUVIA',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>