 <?php
 session_start();
 if ($_SESSION['cargo'] != 1  ) {
   header('location: ../index.php');
 }
include "../conexion.php";
if (!empty($_POST))
{
  /* print_r($_FILES);
  exit;*/
  if(empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['password']) || empty($_POST['celular']))
{
  $alert='<p class="msg_error">TODOS LOS CAMPOS SON OBLIGATORIOS.</p>';
} else {

    $cargo = $_POST['cargo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);
    $celular = $_POST['celular'];
    $genero = $_POST['genero'];

                    $foto        = $_FILES['foto'];
                    $nombre_foto = $foto['name'];
                    $type        = $foto['type'];
                    $url_temp    = $foto['tmp_name'];

                    $imgProducto = 'img_producto.png';

                    if ($nombre_foto !='') {
                      $destino = 'img/uploads/';
                      $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
                      $imgProducto = $img_nombre.'.jpg';
                      $src = $destino.$imgProducto;
                    }



    $query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario = '$usuario' OR celular = '$celular' ");
    $result = mysqli_fetch_array($query);

    if($result > 0){
      $alert='<p class="msg_error">EL USUARIO O TELEFONO YA EXISTE, NO SE PUDO CREAR EL USUARIO.</p>';
    }else{
      $quey_insert = mysqli_query($conexion,"INSERT INTO usuario(cargo,nombre,apellido,usuario,password,celular,genero,foto)
        VALUES('$cargo','$nombre','$apellido','$usuario','$password','$celular', '$genero' , '$imgProducto')");
      if ($quey_insert) {
        if ($nombre_foto != '') {
          move_uploaded_file($url_temp, $src);
        }
           echo '<script>';
      echo 'alert("usuario Creado Exitosamente");';
      echo 'window.location.href="usuario.php";';
    echo '</script>';
      }else{
        echo '<script>';
      echo 'alert("Error al crear Usuario");';
      echo 'window.location.href="nuevousuario.php";';
    echo '</script>';
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<script>
  function sololetras(e){
  key=e.keyCode || e.which;
  teclado= String.fromCharCode(key).toLowerCase();
  letras="abcdefghijklmnopqerstuvwxyz "
  especiales = "8-37-38-46-164";
  teclado_especial=false;
  for (var i  in especiales) {

   if (key==especiales[i]) {
     teclado_especial=true;break;
   }
 }
 if (letras.indexOf(teclado)==-1 && !teclado_especial) {
   return false;


 }
}
</script>
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
 <script type="text/javascript" src="js/functions.js"></script>
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
           <form method="POST" enctype="multipart/form-data" >
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo Usuario:</label>
                            <?php
                                include "../conexion.php";
                                $query_rol = mysqli_query($conexion,"SELECT * FROM cargo");

                                $result_rol = mysqli_num_rows($query_rol);
                            ?>
                             <select class="form-control" maxlength="256" name="cargo" id="cargo">
                             <?php
                                    if($result_rol > 0)
                                    {
                                      while ($rol = mysqli_fetch_array($query_rol)) {
                              ?>
              <option value="<?php echo $rol["idcargo"]; ?>"><?php echo $rol["cargo"] ?></option>
                              <?php } } ?>
                            </select>
                          </div>


                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombres:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre completo" onkeypress="return sololetras(event)" onpaste="return false">
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Apellidos:</label>
                            <input type="text" class="form-control" name="apellido" id="apellido" maxlength="100" placeholder="Apellidos" onkeypress="return sololetras(event)" onpaste="return false">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Usuario:</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" maxlength="256" placeholder="Nombre de Usuario">
                          </div>





                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label>Celular:</label>
                            <input type="number" class="form-control" maxlength="256" placeholder="+591" readonly>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-8">
                              <label>.</label>
                            <input type="number" class="form-control" name="celular" id="celular" maxlength="256" placeholder="Número de celular">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Genero:</label>
                             <select class="form-control" maxlength="256" name="genero" id="gnero">
                              <option value="1">Femenino</option>
                              <option value="2">Masculino</option>
                              <option value="3">Prefiero no decir</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="foto">Foto:</label>
                                    <div class="prevPhoto">
                                    <span class="delPhoto notBlock">X</span>
                                    <label for="foto"></label>
                                    </div>
                                    <div class="upimg">
                                    <input type="file" name="foto" id="foto" class="form-control" maxlength="256">
                                    </div>
                                    <div id="form_alert"></div>
                          </div>


                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Password:</label>
                            <input type="password" class="form-control newPass" name="password" id="password" placeholder="Password" required>
                          </div>


                          <div class="alertChangePass" style="display: none;">
                          </div>
                </div><br>

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button type="submit" class="btn btn-success"  id="btnGuardar"><i class="fa fa-save fa-lg"></i> Guardar</button>

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
