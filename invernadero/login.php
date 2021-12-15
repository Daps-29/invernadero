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
    $alert = 'Fallaste 4 veces el usuario ' .$user. ' esta bloqueado por 1 minuto';
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


    if(isset($_COOKIE["$user"])){
      $cont = $_COOKIE["$user"];
      $cont++;
      $alert ='Password Incorrectos Fallaste ' .$cont. ' veces';
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
