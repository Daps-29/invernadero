<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Humedad', 0],
          ['Temperatura', 0]
        ]);

        var options = {
          width: 400, height: 400,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('Medidores'));

        chart.draw(data, options);

        setInterval(function() {
          var JSON=$.ajax({
              url:"https://invernadero.ga/sistema/datoSensores.php?q=1",
            dataType: 'json',
            async: false}).responseText;
          var Respuesta=jQuery.parseJSON(JSON);

            data.setValue(0, 1,Respuesta[0].humedad/10);
            data.setValue(1, 1,Respuesta[0].temperatura);
          chart.draw(data, options);
        }, 1300);
      }
    </script>
