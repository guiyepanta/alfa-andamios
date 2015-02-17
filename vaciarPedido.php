<?php
	header("Cache-Control: no-store, no-cache, must-revalidate");
	include ("conexion.php");
	
	$idPedido = $_GET["id"];
	
	$sql = "DELETE FROM pedidosdetalles WHERE idPedido=".$idPedido;
	//echo $sql;
	$editarCant=mysql_query($sql);
	$error = mysql_errno($link) . ":" . mysql_error($link);
	if($error == "0:")
		echo "OK";
	else
		echo "ERROR";

?>
