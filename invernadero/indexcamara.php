<?php
$alert = '';
session_start();
if (!empty( $_SESSION['active'])) {
header('location: sistema/index.php');
}else{

if (!empty($_POST)) {
if (empty($_POST['usuario']) || empty($_POST['password'])) {
  $alert ='Ingrese su usuario y password';
}else{
  require_once"conexion.php";
  $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
  $pass = md5(mysqli_real_escape_string($conexion, $_POST['password']));
  $query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario = '$user' AND password = '$pass'");
  mysqli_close($conexion);
  $result = mysqli_num_rows($query);
  if(isset($_COOKIE["block".$user])){
    $alert = 'el usuario esta bloqueado por 1 minuto';
  }else {

  if ($result > 0) {
    $data = mysqli_fetch_array($query);
     $_SESSION['active'] = true;
     $_SESSION['idUser'] = $data['idusuario'];
     $_SESSION['nombre'] = $data['nombre'];
     $_SESSION['apellido'] = $data['apellido'];
     $_SESSION['usuario'] = $data['usuario'];
     $_SESSION['cargo'] = $data['cargo'];
     $_SESSION['foto'] =$data['foto'];
     $_SESSION['genero'] =$data['genero'];

     header('location: sistema/');
  }else{
    $alert ='Usuario o Password Incorrectos';

    if(isset($_COOKIE["$user"])){
      $cont = $_COOKIE["$user"];
      $cont++;
      setcookie($user,$cont,time()+ 120);
      if($cont >=3){
        setcookie("block".$user,$cont,time()+60);
      }
    }else{
      setcookie($user,1,time()+120);
    }
   }
 }
 }
}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>INVERNADEROS IMA</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="css/login.css">

<!-- llamamos a las libreria y al codigo para activar la camara -->
<script src="face-api.js"></script>
<style>
  body {
    margin: 0;
    padding: 0;
    width: 100vw;
    height:  100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  canvas{ position: absolute; }
</style>

</head>
<body class="hold-transition login-page">
<div id="camara" >
  <video id="video" width="720" height="560" autoplay muted></video>
  <script src="main.js"></script>
</div>
<!-- camara web y canvas-->
<div class="">
<form  class="form-signin" method="POST" action="">
  <input type="hidden" id="usuario" name="usuario" value="david">
  <input type="hidden" id="password" name="password" value="david">
<a href="index.php"><input type="button" value="Mostrar Login"></a>
<input type="submit" value="Ingresar" class="btn btn-lg btn-primary btn-block">
</form>
</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="js/login.js"></script>
<script>
$(function () {
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass   : 'iradio_square-blue',
    increaseArea : '20%' // optional
  })
})
function ocultar(){
  document.getElementById('mostrarOcultar').style.display="none";
  document.getElementById('camara').style.display="block";
  document.getElementById('video').style.display="block";
}
function mostrar(){
  document.getElementById('mostrarOcultar').style.display="block";
  document.getElementById('camara').style.display="none";
}
</script>

</body>
</html>
