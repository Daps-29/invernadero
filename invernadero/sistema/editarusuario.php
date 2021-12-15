 <?php
session_start();
if($_SESSION['cargo'] != 1)
{
  header("location: index.php");
}
include "../conexion.php";
if (!empty($_POST))
{
 if (empty($_POST['nombre']) || empty($_POST['apellido']))
 {
      $alert='<p class="msg_error">TODOS LOS CAMPOS SON OBLIGATORIOS.</p>';
  }else{


    $idUsuario = $_POST['id'];
    $cargo = $_POST['cargo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);
    $celular = $_POST['celular'];
    $genero = $_POST['genero'];


      $query = mysqli_query($conexion,"SELECT * FROM usuario WHERE  (nombre='$nombre' AND idusuario != $idUsuario) OR (usuario = '$usuario' AND idusuario != $idUsuario)");

    $result = mysqli_fetch_array($query);


    if ($result > 0) {
      $alert='<p class="msg_error">EL USUARIO YA EXISTE.</p>';
    }else{
    if (empty($_POST['password'])) {
        $sql_update = mysqli_query($conexion,"UPDATE usuario SET cargo = '$cargo', nombre = '$nombre', apellido='$apellido', celular='$celular', genero='$genero', usuario='$usuario' WHERE idusuario = $idUsuario");
      }else{
         $sql_update = mysqli_query($conexion,"UPDATE usuario SET cargo = '$cargo', nombre = '$nombre', apellido='$apellido', password='$password', celular='$celular', genero='$genero',usuario='$usuario' WHERE idusuario = $idUsuario");

      }
      if($sql_update){
        $alert='<p class="msg_save">Usuario actualizado correctamente.</p>';
      }else{
        $alert='<p class="msg_error">Error al actualizar el usuario.</p>';
      }
    }
  }
}
//Mostrar datos
if (empty($_REQUEST['id'])) {
  header('location: usuario.php');

}
$iduser = $_REQUEST['id'];
$sql = mysqli_query($conexion,"SELECT u.idusuario,u.nombre,u.password,u.apellido,u.celular,u.genero,u.usuario, (u.cargo) as idcargo, c.cargo as cargo  FROM usuario u INNER JOIN cargo c ON u.cargo = c.idcargo WHERE idusuario = $iduser AND u.estado=1");

mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
   header('location: usuario.php');
}else{
  $option = '';
  while ($data = mysqli_fetch_array($sql)) {
   $iduser = $data['idusuario'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $usuario = $data['usuario'];
    $password = $data['password'];
    $celular = $data['celular'];
    $genero = $data['genero'];
    $idcargo = $data['idcargo'];
    $cargo = $data['cargo'];


    if ($idcargo == 1) {
      $option = ' <option value="'.$idcargo.'" select>'.$cargo.'</option>';
    }else if ($idcargo == 2) {
      $option = ' <option value="'.$idcargo.'" select>'.$cargo.'</option>';
    }
    else if ($idcargo == 3) {
      $option = ' <option value="'.$idcargo.'" select>'.$cargo.'</option>';
    }
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
              <h3><i class="fa fa-plus-square"></i>Nuevo Usuario</h3>
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
                  <input type="hidden" name="id" value="<?php echo $iduser; ?>">
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo:</label>

                               <?php
                               include "../conexion.php";
                            $query_rol = mysqli_query($conexion,"SELECT * FROM cargo");
                            mysqli_close($conexion);
                            $result_rol = mysqli_num_rows($query_rol);
                             ?>
                             <select class="form-control notItemOne" maxlength="256" name="cargo" id="cargo">
                             <?php
                             echo $option;
                             if ($result_rol > 0) {
                               while ($cargo = mysqli_fetch_array($query_rol)) {
                                ?>
                                 <option value="<?php echo $cargo["idcargo"]; ?>"><?php echo $cargo["cargo"] ?></option>
                                 <?php
                               }
                             }

                              ?>
                            </select>
                          </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombres:</label>
                            <input type="hidden" name="nombre" id="nombre">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" value="<?php  echo $nombre; ?>" >
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Apellidos:</label>
                            <input type="hidden" name="apellido" id="apellido">
                            <input type="text" class="form-control" name="apellido" id="apellido" maxlength="100" placeholder="Apellidos"value="<?php  echo $apellido; ?>" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Usuario:</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" maxlength="256" placeholder=" Usuario" value="<?php  echo $usuario; ?>">
                          </div>

                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Contraseña:</label>
                            <input type="text" class="form-control" name="password" id="password" maxlength="256" placeholder="Contraseña">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Celular:</label>
                            <input type="number" class="form-control" name="celular" id="celular" placeholder="Celular" value="<?php  echo $celular; ?>">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Genero:</label>
                             <select class="form-control" maxlength="256" name="genero" id="gnero">
                              <option value="1">Femenino</option>
                              <option value="2">Masculino</option>
                              <option value="3">Prefiero no decir</option>
                            </select>
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


<?php
require "plantilla/footer.php";
?>
  </body>
</html>
