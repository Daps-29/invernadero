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
   $foto = $_POST['foto'];
   $genero = $_POST['genero'];


     $query = mysqli_query($conexion,"SELECT * FROM usuario WHERE  (nombre='$nombre' AND idusuario != $idUsuario) OR (usuario = '$usuario' AND idusuario != $idUsuario)");

   $result = mysqli_fetch_array($query);


   if ($result > 0) {
     $alert='<p class="msg_error">EL USUARIO YA EXISTE.</p>';
   }else{
   if (empty($_POST['password'])) {
       $sql_update = mysqli_query($conexion,"UPDATE usuario SET cargo = '$cargo', nombre = '$nombre', apellido='$apellido', celular='$celular', foto='$foto', usuario='$genero', usuario='$usuario' WHERE idusuario = $idUsuario");
     }else{
        $sql_update = mysqli_query($conexion,"UPDATE usuario SET cargo = '$cargo', nombre = '$nombre', apellido='$apellido', password='$password', celular='$celular', foto='$foto', genero='$genero',usuario='$usuario', WHERE idusuario = $idUsuario");

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
$sql = mysqli_query($conexion,"SELECT u.idusuario,u.nombre,u.apellido,u.celular,u.foto,u.genero,u.usuario, (u.cargo) as idcargo, c.cargo as cargo  FROM usuario u INNER JOIN cargo c ON u.cargo = c.idcargo WHERE idusuario = $iduser AND u.estado=1");

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
   $celular = $data['celular'];
   $foto = $data['foto'];
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
