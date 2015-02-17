<?php
	header("Cache-Control: no-store, no-cache, must-revalidate");
	include ("conexion.php");
	
	$idProducto = $_GET["id"];
	$variacion = $_GET["variacion"];
	
	$sql = "UPDATE pedidosdetalles SET cantidad = cantidad + (".$variacion.") WHERE idDetalle=".$idProducto;
	//echo $sql;
	$editarCant=mysql_query($sql);

?>
