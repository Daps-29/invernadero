<?php
header ('Content-Type: application/json');
$pdo = new PDO("mysql:dbname=admin_admin_invernadero;host=bombatilata.ga","admin_1","1234567");
switch ($_GET['q']){
    //BUSCAMOS EL ULTIMO DATO
    case 1:
        $statement=$pdo->prepare("SELECT humedad, temperatura FROM sensor ORDER BY id DESC LIMIT 0,1");
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        $json=json_encode($results);
        echo $json;
    break;
    //BUSCAR TODOS LOS DATOS
    default:
    $statement=$pdo->prepare("SELECT humedad, temperatura FROM sensor ORDER BY id ASC");
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        $json=json_encode($results);
        echo $json;
    break;
}
?>
