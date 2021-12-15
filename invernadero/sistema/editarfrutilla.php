<?php 
session_start();
if($_SESSION['cargo'] != 1)
{
  header("location: plantilla.php");
}
include "../conexion.php";
if (!empty($_POST)) 
{
 if (empty($_POST['temperatura']) || empty($_POST['humedad']))
 {
      $alert='<p class="msg_error">TODOS LOS CAMPOS SON OBLIGATORIOS.</p>';
  }else{


    $idfrutilla = $_POST['id'];
    $idinvernadero = $_POST['idinvernadero'];
    $tiempoCosecha = $_POST['tiempoCosecha'];
    $temperatura = $_POST['temperatura'];
    $humedad = $_POST['humedad'];
    
    
        $sql_update = mysqli_query($conexion,"UPDATE registro_produccion
         SET idinvernadero = '$idinvernadero', tiempoCosecha = '$tiempoCosecha', temperatura='$temperatura', humedad='$humedad'
          WHERE idfrutilla = $idfrutilla");
      }
      if($sql_update){
        $alert='<p class="msg_save">Siembra actualizada correctamente.</p>';
      }else{
        $alert='<p class="msg_error">Error al actualizar la siembra.</p>';
      }
    }
//Mostrar datos
if (empty($_REQUEST['id'])) {
  header('location: frutilla.php');
  mysqli_close($conexion);
  
}
$idfrutilla = $_REQUEST['id'];
$sql = mysqli_query($conexion,"SELECT  * , i.nombre as nombre FROM registro_produccion f 
INNER JOIN invernadero i ON f.idinvernadero = i.idinvernadero 
WHERE f.idfrutilla = $idfrutilla and f.estado = 1 ");

mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
   header('location: frutilla.php');
}else{
  while ($data = mysqli_fetch_array($sql)) {
   $idfrutilla = $data['idfrutilla'];   
   $idinvernadero = $data['idinvernadero'];
    $tiempoCosecha = $data['tiempoCosecha'];
    $dia_cosecha = $data['dia_cosecha'];
    $temperatura = $data['temperatura'];
    $humedad = $data['humedad'];
    $nombre = $data['nombre'];


    if ($idinvernadero == 1) {
      $option = ' <option value="'.$idinvernadero.'" select>'.$nombre.'</option>';
    }
  }
}
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Editar Siembra</title>

    <?php include "includes/bootstrap.php"; ?>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      <?php include "includes/nav.php"; ?>


         <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Editar Siembra</h3>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            </div>
            
          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="x_panel">
                <div class="x_title">
                </div>
                <div class="x_content">
                 <form method="POST">
                 <input type="hidden" name="id" value="<?php echo $idfrutilla; ?>">
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo:</label>
                            
                               <?php 
                               include "../conexion.php";
                            $query_rol = mysqli_query($conexion,"SELECT * FROM invernadero");
                            mysqli_close($conexion);
                            $result_rol = mysqli_num_rows($query_rol);
                             ?>
                             <select class="form-control notItemOne" maxlength="256" name="idinvernadero" id="idinvernadero">
                             <?php 
                             echo $option;
                             if ($result_rol > 0) {
                               while ($cargo = mysqli_fetch_array($query_rol)) {
                                ?>
                                 <option value="<?php echo $cargo["idinvernadero"]; ?>"><?php echo $cargo["nombre"] ?></option>
                                 <?php
                               }
                             }

                              ?>
                            </select>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tiempo Cosecha:</label>
                            <input type="number" class="form-control" name="tiempoCosecha" id="tiempoCosecha" maxlength="100" placeholder="Tiempo de cosecha en dias" value="<?php  echo $tiempoCosecha; ?>">
                          </div>
                        
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Temperatura:</label>
                            <input type="number" class="form-control" name="temperatura" id="temperatura" maxlength="256" placeholder="Temperatura necesaria" value="<?php  echo $temperatura; ?>">
                          </div>
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Humedad:</label>
                            <input type="number" class="form-control" name="humedad" id="humedad" placeholder="Humedad necesaria" value="<?php  echo $humedad; ?>">
                          </div>
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary"  id="btnGuardar"> Guardar</button>

                            <a href="usuario.php"><button class="btn btn-danger"type="button"> Cancelar</button></a>
                          </div>
                        </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

        
      </div>
    </div>
    <?php include "includes/scripts.php"; ?>
  
  </body>
</html>


