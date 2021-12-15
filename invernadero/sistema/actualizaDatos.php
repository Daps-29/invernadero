<?php


	include "../conexion.php";
	$id=$_POST['id'];
	$n=$_POST['cantidad'];
	$a=$_POST['descripcion'];
	$c=$_POST['calendario'];

	$sql="UPDATE registro_produccion r INNER JOIN espacios e ON r.espacio = e.ides SET r.cantidad='$n',
								r.descripcion='$a', r.estado = '0', r.dia_cosecha = '$c', e.disponible = '1'
				WHERE r.idfrutilla=  '$id' ";
	echo $result=mysqli_query($conexion,$sql);

 ?>
