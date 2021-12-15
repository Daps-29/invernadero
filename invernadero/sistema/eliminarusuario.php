 <?php
session_start();
if($_SESSION['cargo'] != 1)
{
  header("location: plantilla.php");
}
include "../conexion.php";

if(!empty($_POST))
{
  if($_POST['idusuario'] == 1){
    header("location: usuario.php");
    mysqli_close($conexion);
    exit;
  }
  $idusuario = $_POST['idusuario'];
  $quey_delete = mysqli_query($conexion,"UPDATE usuario SET estado = '0' WHERE idusuario='$idusuario'");
  if ($quey_delete) {
    echo '<script>';
      echo 'alert("usuario Eliminado Exitosamente");';
      echo 'window.location.href="usuario.php";';
    echo '</script>';
  }else{
    echo "Error al eliminar usuario";
  }
}
if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1 ) {
  header("location: usuario.php");
  mysqli_close($conexion);
}else{
  $idusuario = $_REQUEST['id'];
  $query = mysqli_query($conexion,"SELECT u.nombre,u.apellido, c.cargo FROM usuario u INNER JOIN cargo c ON u.cargo = c.idcargo WHERE u.idusuario = $idusuario");
  mysqli_close($conexion);
  $result = mysqli_num_rows($query);
  if ($result > 0) {
    while ($data = mysqli_fetch_array($query)) {
      $nombre = $data['nombre'];
      $apellido = $data['apellido'];
      $cargo = $data['cargo'];
    }
  }else{
    header("location: usuario.php");
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
          <div class="right_col" role="main">
          <div class="">
                  <div class="dialogo">
  <div class="data_delete">
    <p class="mensaje">Esta seguro de eliminar este usuario!??</p>
    <p>Nombre:<span><?php echo $nombre; ?></span></p>
    <p>Apellido:<span><?php echo $apellido; ?></span></p>
    <p>Cargo:<span><?php echo $cargo; ?></span></p>

  </div>
  <form method="POST" action="">
  <div class="data_delete">
    <input type="hidden" name="idusuario"  value="<?php echo $idusuario ?>">
    <input type="submit" value="Aceptar" class="btn_ok btn btn-primary">
    <a href="usuario.php" class="btn_cancel btn btn-danger">Cancelar</a>
  </div>
  </form>
     </div>
            </div>
          </div>
        <!-- /page content -->


      </div>
    </div>
    <?php
    require "plantilla/footer.php";
    ?>

  </body>
</html>
