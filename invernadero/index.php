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
      $alert = 'Supero el maximo de intentos, ' .$user. ' bloqueado por 1 minuto';
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
        $alert ='Usuario o Password Incorrectos Usted lleva ' .$cont. ' Intentos';
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
  <link rel="stylesheet" type="text/css" href="css/login2.css">

</head>
<body class="hold-transition login-page">

  <div class="vid-container">
  <video src="video.mp4" class="bgvid" autoplay="autoplay" muted="muted" preload="auto" loop height= "650">
      <source src="video.mp4" type="video">
  </video>
  <div class="inner-container">
    <video src="video.mp4" class="bgvid inner" autoplay="autoplay" muted="muted" preload="auto" loop height= "650">
      <source src="video.mp4" type="video">
    </video>
    <div class="box">
      <h1>INVERNADEROS IMA </h1>
      <h1><a href="indexcamara.php">Login con camara</a></h1>
      <form method="post" action="">
      <input type="text" id="usuario" name="usuario" placeholder="Usuario" />
      <input type="password" id="password" name="password" placeholder="Password" />
      <div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
     <button type="submit">Ingresar</button>

    </div>
    </form>
  </div>
  </div>
<br>




<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>


</body>
</html>
