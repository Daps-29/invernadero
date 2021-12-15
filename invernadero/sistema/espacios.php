<?php
session_start();
if($_SESSION['cargo']!=1 and $_SESSION['cargo'] !=2){
  header('location: ../index.php');
}

 ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row" style="display: inline-block;" >
          <div class="tile_count btn-toolbar form-group col-lg-8 col-md-8 col-sm-10 col-xs-20" style="float: left; padding:80px; margin-left:5px;top:50px; position:absolute;" role="toolbar" aria-label="Toolbar with button groups">
                <!--  <div class="btn-group mr-2" role="group" aria-label="First group"> -->
                <?php
                                          include "../conexion.php";
                                            $qury = mysqli_query($conexion,"SELECT e.ides, e.disponible, r.dia_siembra,r.dia_cosecha,r.tiempoCosecha,r.humedad,r.temperatura, DATEDIFF(ADDDATE(r.dia_siembra, INTERVAL r.tiempoCosecha DAY), curdate()) as dias FROM espacios e INNER JOIN registro_produccion r ON e.ides = r.espacio WHERE e.ides = '1' AND r.estado = '1'");
                                             mysqli_close($conexion);
                                             $result = mysqli_num_rows($qury);
                                             if ($result > 0) {
                                               while ($data = mysqli_fetch_array($qury)) {

                                                 $datos = $data['ides']."||".
                                                         $data['tiempoCosecha']."||".
                                                         $data['dia_siembra']."||".
                                                         $data['humedad']."||".
                                                         $data['temperatura']."||".
                                                         $data['dias'];
                                             ?>
                     <button class="btn btn-success" data-toggle="modal" data-target="#modal_edit" onclick="agregaform('<?php echo $datos ?>')"><i class="fas fa-leaf fa-6x"></i> ESPACIO 1</button>
                <?php }  }?>

                <?php
                                          include "../conexion.php";
                                            $qury = mysqli_query($conexion,"SELECT e.ides, e.disponible, r.dia_siembra,r.dia_cosecha,r.tiempoCosecha,r.humedad,r.temperatura, DATEDIFF(ADDDATE(r.dia_siembra, INTERVAL r.tiempoCosecha DAY), curdate()) as dias FROM espacios e INNER JOIN registro_produccion r ON e.ides = r.espacio WHERE e.ides = '2' AND r.estado = '1'");
                                             mysqli_close($conexion);
                                             $result = mysqli_num_rows($qury);
                                             if ($result > 0) {
                                               while ($data = mysqli_fetch_array($qury)) {

                                                 $datos = $data['ides']."||".
                                                         $data['tiempoCosecha']."||".
                                                         $data['dia_siembra']."||".
                                                         $data['humedad']."||".
                                                         $data['temperatura']."||".
                                                         $data['dias'];
                                             ?>
                     <button class="btn btn-danger" data-toggle="modal" data-target="#modal_edit" onclick="agregaform('<?php echo $datos ?>')"><i class="fas fa-leaf fa-6x"></i> ESPACIO 2</button>
                <?php }  }?>

                <?php
                                          include "../conexion.php";
                                            $qury = mysqli_query($conexion,"SELECT e.ides, e.disponible, r.dia_siembra,r.dia_cosecha,r.tiempoCosecha,r.humedad,r.temperatura, DATEDIFF(ADDDATE(r.dia_siembra, INTERVAL r.tiempoCosecha DAY), curdate()) as dias FROM espacios e INNER JOIN registro_produccion r ON e.ides = r.espacio WHERE e.ides = '3' AND r.estado = '1'");
                                             mysqli_close($conexion);
                                             $result = mysqli_num_rows($qury);
                                             if ($result > 0) {
                                               while ($data = mysqli_fetch_array($qury)) {

                                                 $datos = $data['ides']."||".
                                                         $data['tiempoCosecha']."||".
                                                         $data['dia_siembra']."||".
                                                         $data['humedad']."||".
                                                         $data['temperatura']."||".
                                                         $data['dias'];
                                             ?>
                     <button class="btn btn-primary" data-toggle="modal" data-target="#modal_edit" onclick="agregaform('<?php echo $datos ?>')"><i class="fas fa-leaf fa-6x"></i> ESPACIO 3</button>
                <?php }  }?>

                <?php
                                          include "../conexion.php";
                                            $qury = mysqli_query($conexion,"SELECT e.ides, e.disponible, r.dia_siembra,r.dia_cosecha,r.tiempoCosecha,r.humedad,r.temperatura, DATEDIFF(ADDDATE(r.dia_siembra, INTERVAL r.tiempoCosecha DAY), curdate()) as dias FROM espacios e INNER JOIN registro_produccion r ON e.ides = r.espacio WHERE e.ides = '4' AND r.estado = '1'");
                                             mysqli_close($conexion);
                                             $result = mysqli_num_rows($qury);
                                             if ($result > 0) {
                                               while ($data = mysqli_fetch_array($qury)) {

                                                 $datos = $data['ides']."||".
                                                         $data['tiempoCosecha']."||".
                                                         $data['dia_siembra']."||".
                                                         $data['humedad']."||".
                                                         $data['temperatura']."||".
                                                         $data['dias'];
                                             ?>
                     <button class="btn btn-success" data-toggle="modal" data-target="#modal_edit" onclick="agregaform('<?php echo $datos ?>')"><i class="fas fa-leaf fa-6x"></i> ESPACIO 4</button>
                <?php }  }?>



                    <?php
                    include "../conexion.php";
                      $qury = mysqli_query($conexion,"SELECT e.ides, e.disponible, r.dia_siembra,r.dia_cosecha,r.tiempoCosecha,r.humedad,r.temperatura, DATEDIFF(ADDDATE(r.dia_siembra, INTERVAL r.tiempoCosecha DAY), curdate()) as dias FROM espacios e INNER JOIN registro_produccion r ON e.ides = r.espacio WHERE e.ides = '5' AND r.estado = '1'");
                       mysqli_close($conexion);
                       $result = mysqli_num_rows($qury);
                       if ($result > 0) {
                         while ($data = mysqli_fetch_array($qury)) {

                           $datos = $data['ides']."||".
                                   $data['tiempoCosecha']."||".
                                   $data['dia_siembra']."||".
                                   $data['humedad']."||".
                                   $data['temperatura']."||".
                                   $data['dias'];
                       ?>
<button class="btn btn-danger" data-toggle="modal" data-target="#modal_edit" onclick="agregaform('<?php echo $datos ?>')"><i class="fas fa-leaf fa-6x"></i> ESPACIO 5</button>
<?php }  }?><?php
                       include "../conexion.php";
                         $qury = mysqli_query($conexion,"SELECT e.ides, e.disponible, r.dia_siembra,r.dia_cosecha,r.tiempoCosecha,r.humedad,r.temperatura, DATEDIFF(ADDDATE(r.dia_siembra, INTERVAL r.tiempoCosecha DAY), curdate()) as dias FROM espacios e INNER JOIN registro_produccion r ON e.ides = r.espacio WHERE e.ides = '6' AND r.estado = '1'");
                          mysqli_close($conexion);
                          $result = mysqli_num_rows($qury);
                          if ($result > 0) {
                            while ($data = mysqli_fetch_array($qury)) {

                              $datos = $data['ides']."||".
                                      $data['tiempoCosecha']."||".
                                      $data['dia_siembra']."||".
                                      $data['humedad']."||".
                                      $data['temperatura']."||".
                                      $data['dias'];
                          ?>
  <button class="btn btn-primary" data-toggle="modal" data-target="#modal_edit" onclick="agregaform('<?php echo $datos ?>')"><i class="fas fa-leaf fa-6x"></i> ESPACIO 6</button>
<?php }  }?><?php
                          include "../conexion.php";
                            $qury = mysqli_query($conexion,"SELECT e.ides, e.disponible, r.dia_siembra,r.dia_cosecha,r.tiempoCosecha,r.humedad,r.temperatura, DATEDIFF(ADDDATE(r.dia_siembra, INTERVAL r.tiempoCosecha DAY), curdate()) as dias FROM espacios e INNER JOIN registro_produccion r ON e.ides = r.espacio WHERE e.ides = '7' AND r.estado = '1'");
                             mysqli_close($conexion);
                             $result = mysqli_num_rows($qury);
                             if ($result > 0) {
                               while ($data = mysqli_fetch_array($qury)) {

                                 $datos = $data['ides']."||".
                                         $data['tiempoCosecha']."||".
                                         $data['dia_siembra']."||".
                                         $data['humedad']."||".
                                         $data['temperatura']."||".
                                         $data['dias'];
                             ?>
     <button class="btn btn-success" data-toggle="modal" data-target="#modal_edit" onclick="agregaform('<?php echo $datos ?>')"><i class="fas fa-leaf fa-6x"></i> ESPACIO 7</button>
<?php }  }?><?php
                             include "../conexion.php";
                               $qury = mysqli_query($conexion,"SELECT e.ides, e.disponible, r.dia_siembra,r.dia_cosecha,r.tiempoCosecha,r.humedad,r.temperatura, DATEDIFF(ADDDATE(r.dia_siembra, INTERVAL r.tiempoCosecha DAY), curdate()) as dias FROM espacios e INNER JOIN registro_produccion r ON e.ides = r.espacio WHERE e.ides = '8' AND r.estado = '1'");
                                mysqli_close($conexion);
                                $result = mysqli_num_rows($qury);
                                if ($result > 0) {
                                  while ($data = mysqli_fetch_array($qury)) {

                                    $datos = $data['ides']."||".
                                            $data['tiempoCosecha']."||".
                                            $data['dia_siembra']."||".
                                            $data['humedad']."||".
                                            $data['temperatura']."||".
                                            $data['dias'];
                                ?>
        <button class="btn btn-danger" data-toggle="modal" data-target="#modal_edit" onclick="agregaform('<?php echo $datos ?>')"><i class="fas fa-leaf fa-6x"></i> ESPACIO 8</button>
<?php }  }?>
                <!-- </div> -->

        </div>
        <img src="img/invernadero.jpg" style="background-size: cover; background-repeat: repeat-y">
           <!-- ESPACIOS -->
        </div>
        <!-- /page content -->

<?php
require "plantilla/footer.php";
?>
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Datos del espacio</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form>

  <div class="form-group">
    <input type="text" hidden="" id="ides" name="">
    <label for="recipient-name" class="col-form-label">TIEMPO DE COSECHA (EN DIAS):</label>
    <input type="number" name="" id="tiempou" class="form-control input-sm"  readonly>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">DIA DE SIEMBRA:</label>
    <input type="text" name="" id="diau" class="form-control input-sm" readonly>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">TEMPERATURA:</label>
    <input type="text" name="" id="temperaturau" class="form-control input-sm" readonly>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">HUMEDAD:</label>
    <input type="text" name="" id="humedadu" class="form-control input-sm" readonly>
  </div>
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">DIAS RESTANTES:</label>
    <input type="text" name="" id="dias" class="form-control input-sm" readonly>
  </div>



</form>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">SALIR</button>
</div>
</div>
</div>
</div>


  </body>
  <script type="text/javascript">
  function agregaform(datos){
   d=datos.split('||');

   $('#ides').val(d[0]);
   $('#tiempou').val(d[1]);
   $('#diau').val(d[2]);
   $('#temperaturau').val(d[3]);
   $('#humedadu').val(d[4]);
   $('#dias').val(d[5]);

  }
  </script>
</html>
