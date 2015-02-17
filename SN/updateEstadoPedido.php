<?php
header("Cache-Control: no-store, no-cache, must-revalidate");

$idPedido = $_POST["idPedido"];
$estado = $_POST["estado"];
include_once ("conexion.php");

$res = mysql_query("UPDATE pedidos SET estado=$estado WHERE idPedido=$idPedido", $link);
echo "OK";
?>