 <?php
session_start();
if($_SESSION['cargo']!=1 and $_SESSION['cargo'] !=3){
  header('location: ../index.php');
}
include "../conexion.php";

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
      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Lista de cosechas</h3>
               <a href="nuevafrutilla.php"><button class="btn btn-success btn-xs">Sembrado Nuevo</button></a>
                    <a href="frutilla.php"><button class="btn btn-success btn-xs">Lista de Sembrados</button></a>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">


              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">

                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                        <thead>

                         <tr>

                             <th>Usuario</th>
                             <th>Invernadero</th>
                             <th>Tiempo Cosecha</th>
                           <th>Ingreso</th>
                           <th>Salida</th>
                           <th>Temperatura Necesaria</th>
                           <th>Humedad Necesaria</th>
                           <th>Cantidad Frutillas</th>
                           <th>Estado</th>
                         </tr>
                        </thead>

                      <tbody>
                        <?php
                        include "../conexion.php";
                    $qury = mysqli_query($conexion,"SELECT f.idfrutilla,f.cantidad, f.usuario_id, f.estado, f.idinvernadero, f.tiempoCosecha, f.dia_siembra, f.dia_cosecha, f.temperatura, f.humedad,i.nombre, u.nombre as usu, u.apellido FROM registro_produccion f
                                                     INNER JOIN usuario u ON f.usuario_id = u.idusuario
                                                     INNER JOIN invernadero i ON f.idinvernadero = i.idinvernadero
                                                     WHERE f.estado = 0 ORDER BY f.idfrutilla DESC");
                                                     mysqli_close($conexion);
         $result = mysqli_num_rows($qury);
         if ($result > 0) {
           while ($data = mysqli_fetch_array($qury)) {
             $formato = 'Y-m-d H:i:s';
            $fecha = DateTime::createFromFormat($formato, $data["dia_siembra"]);
         ?>
           <tr>
           <td><?php echo $data['usu']; ?><?php echo $data['apellido']; ?></td>
            <td><?php echo $data['nombre']; ?></td>
            <td><?php echo $data['tiempoCosecha']; ?> DIAS</td>
            <td><?php echo $fecha->format('Y-m-d'); ?></td>
            <td><?php echo $data['dia_cosecha']; ?></td>
            <td><?php echo $data['temperatura']; ?></td>
            <td><?php echo $data['humedad']; ?></td>
            <td><?php echo $data['cantidad']; ?></td>
            <td>COSECHADO</td>

          </tr>
          <?php }    }    ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
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
  </body>
</html>
