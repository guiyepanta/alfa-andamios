<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
$entidad=$_GET["entidad"];
$campoId=$_GET["campoId"];
$id = $_GET["id"];
$campoEstado=$_GET["campoEstado"];
$estado = $_GET["estado"];

include_once("conexion.php");

if($entidad=='clientesportal')
	$sql = "UPDATE $entidad SET $campoEstado = $estado WHERE $campoId='$id'";
else 
	$sql = "UPDATE $entidad SET $campoEstado = $estado WHERE $campoId=$id";
	
$result = mysql_query($sql);
mysql_close($link);


if ($estado==1)
	echo "ACTIVO";
else 
	echo "INACTIVO";
   
?>