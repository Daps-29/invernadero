<?php
session_start();
include "../conexion.php";
if (!empty($_POST))
{
  if(empty($_POST['temperatura']))
{
  $alert='<p class="msg_error">LOS CAMPOS TEMPERATURA Y HUMEDAD SON OBLIGATORIOS.</p>';
} else {

    $idusuario = $_SESSION['idUser'];
    $idinvernadero = $_POST['idinvernadero'];
    $tiempoCosecha = $_POST['tiempoCosecha'];
    $temperatura = $_POST['temperatura'];
    $humedad = $_POST['humedad'];
    $ides = $_POST['ides'];



      $quey_insert = mysqli_query($conexion,"INSERT INTO registro_produccion(usuario_id,idinvernadero,tiempoCosecha,temperatura,humedad,espacio)
        VALUES('$idusuario','$idinvernadero','$tiempoCosecha','$temperatura','$humedad','$ides') ");
      if ($quey_insert) {
           echo '<script>';
      echo 'alert("Siembra guardada Exitosamente");';
      echo 'window.location.href="frutilla.php";';
    echo '</script>';
      }else{
        echo '<script>';
      echo 'alert("Error al crear la siembra");';
      echo 'window.location.href="nuevafrutilla.php";';
    echo '</script>';
      }

  }mysqli_close($conexion);
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
              <h3>Nueva Siembra</h3>
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
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>INVERNADERO:</label>
                            <?php include "../conexion.php";
                                $query_rol = mysqli_query($conexion,"SELECT * FROM invernadero WHERE estatus = 1 ORDER BY nombre ASC");
                                $result_rol = mysqli_num_rows($query_rol);
                            ?>
                             <select class="form-control" maxlength="256" name="idinvernadero" id="idinvernadero">
                             <?php
                                    if($result_rol > 0)
                                    {
                                      while ($rol = mysqli_fetch_array($query_rol)) {
                              ?>
              <option value="<?php echo $rol["idinvernadero"]; ?>"><?php echo $rol["nombre"] ?></option>
                              <?php } } ?>
                            </select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tiempo Cosecha:</label>
                            <input type="number" class="form-control" name="tiempoCosecha" id="tiempoCosecha" maxlength="100" placeholder="Tiempo de cosecha en dias" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Temperatura:</label>
                            <input type="number" class="form-control" name="temperatura" id="temperatura" maxlength="256" placeholder="Temperatura necesaria">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Humedad:</label>
                            <input type="number" class="form-control" name="humedad" id="humedad" placeholder="Humedad necesario" >
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>ESPACIO:</label>
                            <?php
                                $query_rol = mysqli_query($conexion,"SELECT * FROM espacios WHERE disponible = 1 ORDER BY numero ASC");
                                mysqli_close($conexion);
                                $result_rol = mysqli_num_rows($query_rol);
                            ?>
                             <select class="form-control" maxlength="256" name="ides" id="ides">
                             <?php
                                    if($result_rol > 0)
                                    {
                                      while ($rol = mysqli_fetch_array($query_rol)) {
                              ?>
                              <option value="<?php echo $rol["ides"]; ?>"><?php echo $rol["numero"] ?></option>
                                              <?php } } ?>
                            </select>
                          </div>



                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-success"  id="btnGuardar"> Guardar</button>

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



<?php
require "plantilla/footer.php";
?>
  </body>
</html>
