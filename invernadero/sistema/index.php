<?php
session_start();
if (empty($_SESSION['active'])) {
  header('location: ../index.php');

}

 ?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript" src="reporte/js/jquery.js"></script>
<script type="text/javascript" src="reporte/js/chartJS/Chart.min.js"></script>

<?php
require "plantilla/header.php";
 ?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
<?php
require "plantilla/nav.php";
 ?>
<?php
require "plantilla/nave.php";
 ?>
        <!-- page content -->

        <?php
        include "../conexion.php";
          $qury = mysqli_query($conexion,"SELECT COUNT(idusuario) as total FROM usuario  WHERE estado = '1'");
           mysqli_close($conexion);
           $result = mysqli_fetch_assoc($qury);

           ?>
           <?php
           include "../conexion.php";
             $query = mysqli_query($conexion,"SELECT COUNT(idfrutilla) as frutilla FROM registro_produccion  ");
              mysqli_close($conexion);
              $frutillas = mysqli_fetch_assoc($query);

              ?>
              <?php
              include "../conexion.php";
                $query = mysqli_query($conexion,"SELECT COUNT(ides) as espacios FROM espacios WHERE disponible = '1'  ");
                 mysqli_close($conexion);
                 $espacios = mysqli_fetch_assoc($query);

                 ?>
                 <?php
                 include "../conexion.php";
                   $query = mysqli_query($conexion,"SELECT COUNT(idfrutilla) as cosecha FROM registro_produccion WHERE estado = '1' ");
                    $cosecha = mysqli_fetch_assoc($query);

                   
                    ?>

        <div class="right_col" role="main">
          <div class="">

                      <div class="row top_tiles">
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-users"></i></div>
                          <div class="count"><?php echo $result['total']; ?></div>
                          <h3>Usuarios</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-leaf"></i></div>
                          <div class="count"><?php echo $frutillas['frutilla']; ?></div>
                          <h3>Cosecha</h3>
                        </div>
                      </div>
                      <div id="temp" class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <?php include "temp.php"; ?>
                      </div >
                      <script type="text/javascript">
                        $(document).ready(function(){
                          setInterval(
                            function(){
                            $('#temp').load('temp.php');
                          },2000
                          );
                        });
                      </script>
                      
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-home"></i></div>
                          <div class="count"><?php echo $cosecha['cosecha']; ?>--<?php echo $espacios['espacios']; ?></div>
                          <h3>Espacios</h3>
                        </div>
                      </div>
                      </div>



            <div class="row">
              <!--Estado de los componentes en el invernadero-->
              <div id="recarga">
                <?php
                include "recarga.php";
                ?>
                </div>
                <!--Script recarga-->
                <script type="text/javascript">
                  $(document).ready(function(){
                    setInterval(
                      function(){
                      $('#recarga').load('recarga.php');
                    },2000
                    );
                  });
                </script>
                <!--Fin componentes en el invernadero-->
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Produccion Mensual Frutillas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-7" style="overflow:hidden;">

                      
                        <div id="container" style="height: 400px"></div>
                      </div>

                      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
#container {
height: 400px;
min-width: 310px;
max-width: 800px;
margin: 0 auto;
}
</style>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 95,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Meses de Produccion'
        },

        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: Highcharts.getOptions().lang.shortMonths
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'Cantidad de frutillas',
            data: [
<?php
 include "../conexion.php";
$sql=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '1' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res=mysqli_fetch_array($sql)){
?>
[<?php echo $res['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '2' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '3' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '4' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '5' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '6' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '7' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '8' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '9' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '10' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '11' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
<?php
 include "../conexion.php";
$sql1=mysqli_query($conexion,"SELECT SUM(cantidad) AS total FROM registro_produccion WHERE MONTH(dia_cosecha) = '12' AND YEAR(dia_cosecha) = '2020' LIMIT 1 ");
while($res1=mysqli_fetch_array($sql1)){
?>
[<?php echo $res1['total'] ?>],
<?php
}
?>
]

        }]
    });
});
</script>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /page content -->




<?php
require "plantilla/footer.php";
?>
<script src="highcharts.js"></script>
<script src="highcharts-3d.js"></script>
<script src="exporting.js"></script>
  </body>
</html>
