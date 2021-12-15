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
require "plantilla/nave.php";
?>
     <!-- page content -->
       <div class="right_col" role="main">
         <div class="">
           <div class="page-title">
             <div class="title_left">
               <h3>Lista de frutillas</h3>



              <a href="nuevafrutilla.php"><button class="btn btn-success btn-xs" >Sembrado Nuevo</button></a>
                   <a href="cosecha.php"><button class="btn btn-dark btn-xs">Cosechas</button></a>
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
                            <th><?php
                            include "../conexion.php";
                  $query_proveedor = mysqli_query($conexion,"SELECT idinvernadero, nombre FROM invernadero WHERE estatus = 1 ORDER BY nombre ASC");
                  mysqli_close($conexion);
                  $result_proveedor = mysqli_num_rows($query_proveedor);
                  ?>
                  <select name="proveedor" id="search_proveedor" >
                   <option value="" selected>Invernadero</option>
                   <?php
                     if ($result_proveedor > 0) {
                       while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                         ?>
                         <option value="<?php echo $proveedor['idinvernadero']; ?>"><?php echo $proveedor['nombre']; ?></option>

                         <?php
                       }
                     }
                   ?>

                  </select></th>
                            <th>Tiempo Cosecha</th>
                          <th>Dia de Siembra</th>
                          <th>Temperatura</th>
                          <th>Humedad</th>
                          <th>Dias Restantes</th>
                          <th>Espacio</th>
                          <th>Estado</th>
                          <?php  if ($_SESSION['cargo'] == 1 || $_SESSION['cargo'] == 2) {?>
                          <th>Acciones</th>
                          <?php } ?>
                        </tr>
                       </thead>
                     <tbody>
                       <?php
                       include "../conexion.php";
                   $qury = mysqli_query($conexion,"SELECT f.idfrutilla, f.tiempoCosecha, f.usuario_id, f.idinvernadero,f.espacio, f.dia_siembra, f.dia_cosecha, f.temperatura, f.humedad,f.cantidad,f.descripcion,f.estado,i.nombre, u.nombre as usu, u.apellido FROM registro_produccion f
                                         INNER JOIN usuario u ON f.usuario_id = u.idusuario
                                         INNER JOIN invernadero i ON f.idinvernadero = i.idinvernadero
                                         INNER JOIN espacios e ON  f.espacio = e.ides
                                         WHERE f.estado = '1' ");
                                         mysqli_close($conexion);
        $result = mysqli_num_rows($qury);
        if ($result > 0) {
          while ($data = mysqli_fetch_array($qury)) {
            $datos = $data['idfrutilla']."||".
                    $data['cantidad']."||".
                    $data['descripcion'];

           $formato = 'Y-m-d H:i:s';
           $fecha = DateTime::createFromFormat($formato, $data["dia_siembra"]);
           //en td se pone esto $fecha->format('d-m-Y')
              $hoy = getdate();            ?>
        <tr>

           <td><?php echo $data['usu']; ?><?php echo $data['apellido']; ?></td>
           <td><?php echo $data['nombre']; ?></td>
           <td><?php echo $data['tiempoCosecha']; ?> DIAS</td>
           <td><?php echo $fecha->format('d-m-Y'); ?></td>
           <td><?php echo $data['temperatura']; ?></td>
           <td><?php echo $data['humedad']; ?></td>
           <td><?php echo $fecha->format('d-m-Y'); ?></td>
           <td><?php echo $data['espacio']; ?></td>
           <td><button class="btn btn-primary btn-xs">EN GERMINACION</button></td>
           <?php  if ($_SESSION['cargo'] == 1 || $_SESSION['cargo'] == 2) {?>
             <td>
             <div class="btn-group">

             <button class="btn btn-warning" data-toggle="modal" data-target="#modal_edit" onclick="agregaform('<?php echo $datos ?>')"><i class="fa fa-pied-piper"></i> COSECHAR</button>
             </div>
           </td> 
           <?php } ?>

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
       <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body">
        		<input type="text" hidden="" id="idfrutilla" name="">
          	<label>Cantidad</label>
          	<input type="number" name="" id="cantidadu" class="form-control input-sm">
          	<label>descripcion</label>
          	<input type="text" name="" id="descripcionu" class="form-control input-sm">
            <label>Fecha</label>
          	<input type="datetime" name="" id="calendariou" class="form-control" value="<?php echo date("Y-m-d"); ?>" disabled>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>

        </div>
      </div>
    </div>
  </div>
<?php
require "plantilla/footer.php";
?>
<script type="text/javascript">
$(document).ready(function(){
        $('#actualizadatos').click(function(){
          actualizaDatos();
        });

    });

function agregaform(datos){
 d=datos.split('||');

 $('#idfrutilla').val(d[0]);
 $('#cantidadu').val(d[1]);
 $('#descripcionu').val(d[2]);

}

function actualizaDatos(){


	id=$('#idfrutilla').val();
	cantidad=$('#cantidadu').val();
	descripcion=$('#descripcionu').val();
  calendario=$('#calendariou').val();

	cadena= "id=" + id +
			"&cantidad=" + cantidad +
			"&descripcion=" + descripcion +
      "&calendario=" + calendario;

	$.ajax({
		type:"POST",
		url:"actualizaDatos.php",
		data:cadena,
		success:function(r){

			if(r==1){

				 alert(" Exitosamente");
         window.location.href="frutilla.php";
			}else{

   alert("Error");
			}
		}
	});

}

</script>
 </body>
</html>
