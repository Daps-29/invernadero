<?php
		session_start();
		include "../conexion.php";

		$fecha_de = '';
		$fecha_a='';


		if (isset($_REQUEST['fecha_de']) || isset($_REQUEST['fecha_a'])) {
			if ($_REQUEST['fecha_de'] == '' || $_REQUEST['fecha_a'] == '') {
				header("location: reportefecha.php");
			}
		}

		if (!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])) {
			$fecha_de = $_REQUEST['fecha_de'];
			$fecha_a = $_REQUEST['fecha_a'];

			$buscar = '';

			if ($fecha_de > $fecha_a) {
        echo '<script>';
   echo 'alert("Fecha incorrecta");';
   echo 'window.location.href="reportefecha.php";';
 echo '</script>';
			} else if ($fecha_de == $fecha_a){

				$where = "fecha LIKE '$fecha_de%'";
				$buscar="fecha_de=$fecha_de&fecha_a=$fecha_a";
			}else{
				$f_de = $fecha_de.' 00:00:00';
				$f_a = $fecha_a.' 23:59:59';
				$where = "fecha BETWEEN '$f_de' AND '$f_a' ";
				$buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a";
			}
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


 <!-- page content -->
   <div class="right_col" role="main">
     <div class="">
       <div class="page-title">
         <div class="title_left">
           <h3>Reportes por fecha</h3>

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
                         <form action="buscar_fecha.php" method="get">
                         <label>De:</label>
                         <input type="date" name="fecha_de" id="fecha_de" required>
                         <label>Hasta</label>
                         <input type="date" name="fecha_a" id="fecha_a" required>
                         <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                       </form>
               <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">

                 <thead>


                   <tr>

                      <th>Fecha/Hora</th>
                      <th>Temperatura</th>
                      <th>Humedad</th>
                      <th>Riego</th>
											<th>Ventilador</th>
                      <th>Foco</th>
                      <th>Estado del sensor de humedad</th>

                    </tr>
                 </thead>
                 <tbody>
                   <?php
                   include "../conexion.php";
                     $qury = mysqli_query($conexion,"SELECT * FROM sensor WHERE $where ");
                      mysqli_close($conexion);
                      $result = mysqli_num_rows($qury);
                      if ($result > 0) {
                        while ($data = mysqli_fetch_array($qury)) {
                          if ($data["riego"] == 1){
                            $riego = 'Encendido';
                          } else {
                            $riego = 'Apagado';
                          }
                          if ($data["ventilador"] == 1){
                            $venti = 'Encendido';
                          } else {
                            $venti = 'Apagado';
                          }
                          if ($data["foco_noche"] == 1){
                            $foco = 'Encendido';
                          } else {
                            $foco = 'Apagado';
                          }
                          if ($data["foco_seco"] == 1){
                            $fs = 'Sensor arruinado';
                          } else {
                            $fs = 'Funcionando';
                          }



                        ?>
                        <tr>
                        <td><?php echo $data['fecha']; ?></td>
                        <td><?php echo $data['temperatura']; ?> °C </td>
                        <td><?php echo $data['humedad']/10; ?> % </td>
                        <td><?php echo $riego; ?></td>
                        <td><?php echo $venti; ?> </td>
                        <td><?php echo $foco; ?> </td>
                        <td><?php echo $fs; ?> </td>



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
