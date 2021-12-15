<?php
session_start();
if($_SESSION['cargo']!=1 and $_SESSION['cargo'] !=3){
  header("location: ./");
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
           <h3>Reportes por fecha cosechas</h3>

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
                         <form action="buscarcosecha.php" method="get">
                         <label>De:</label>
                         <input type="date" name="fecha_de" id="fecha_de" required>
                         <label>Hasta</label>
                         <input type="date" name="fecha_a" id="fecha_a" required>
                         <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                       </form>
               <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">

                 <thead>


                   <tr>
                      <th>Usuario</th>
                      <th>Tiempo De Cosecha</th>
                      <th>Dia de siembra</th>
                      <th>Dia de Cosecha</th>
                      <th>Temperatura</th>
                      <th>Humedad</th>
                      <th>Cantidad</th>
                      <th>Descripcion</th>

                    </tr>
                 </thead>
                 <tbody>
                   <?php
                   include "../conexion.php";
                     $qury = mysqli_query($conexion,"SELECT u.nombre, r.tiempoCosecha,r.dia_siembra,r.dia_cosecha,r.temperatura,r.humedad,r.cantidad,r.descripcion FROM registro_produccion r INNER JOIN usuario u ON r.usuario_id = u.idusuario");
                      mysqli_close($conexion);
                      $result = mysqli_num_rows($qury);
                      if ($result > 0) {
                        while ($data = mysqli_fetch_array($qury)) {



                      ?>
                  <tr>
                    <td><?php echo $data['nombre']; ?></td>
                    <td><?php echo $data['tiempoCosecha']; ?></td>
                    <td><?php echo $data['dia_siembra']; ?></td>
                    <td><?php echo $data['dia_cosecha']; ?></td>
       <td><?php echo $data['temperatura']; ?></td>
       <td><?php echo $data['humedad']/10; ?></td>
        <td><?php echo $data['cantidad']; ?></td>
         <td><?php echo $data['descripcion']; ?></td>



     </tr>
     <?php }         }          ?>

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
