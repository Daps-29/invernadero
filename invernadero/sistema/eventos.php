<?php
header('Content-Type: application/json');
$pdo= new PDO("mysql:dbname=invernaderooriginal;host=127.0.0.1","root","");

//SELECCIONAR LOS EVENTOS DEL Calendario
$sentenciaSQL = $pdo->prepare("SELECT r.espacio as title, textColor, dia_siembra as start, ADDDATE( dia_siembra, INTERVAL tiempoCosecha DAY) as end FROM registro_produccion r WHERE estado = '1'");
$sentenciaSQL->execute();
$resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultado);

?>
