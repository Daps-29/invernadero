<?php
session_start();
if($_SESSION['cargo']!=1 and $_SESSION['cargo'] !=2){
  header("location: ./");
}

 ?>
<!DOCTYPE html>
<html lang="en">

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
 <?php include "datos/medidorgraficos.php"; ?>
         <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row" style="display: inline-block;" >

           <!-- MEDIDORES -->
           <h5>Mucha temperatura y humedad hacen que haya vapor de agua en el aire, y aumente la presión atmosférica (medida en hectopascales); por lo que es muy probable precipitaciones. Ahora bien, la lluvia/nube puede "armarse" aquí, y si hay viento se trasladará a otras zonas... deberemos revisar la velocidad del viento y el porcentaje de humedad, mientras mayor es la humedad, mas probabilidad de precipitaciones; y el viento nos dirá con que velocidad se traslada el tope nuboso.</h5>
           <div id="curve_chart" style="width: 900px; height: 500px"></div>


          </div>
        </>
        <!-- /page content -->

<?php
require "plantilla/footer.php";
?>
  </body>
</html>
