<?php
	header("Cache-Control: no-store, no-cache, must-revalidate");
	include ("conexion.php");
	
	$idProducto = $_GET["id"];
	$variacion = $_GET["variacion"];
	
	$sql = "DELETE FROM pedidosdetalles WHERE idDetalle=".$idProducto;
	//echo $sql;
	$editarCant=mysql_query($sql);
	$error = mysql_errno($link) . ":" . mysql_error($link);
	if($error == "0:")
		echo "OK";
	else
		echo "ERROR";

?>
