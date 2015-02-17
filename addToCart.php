<?php
    header("Cache-Control: no-store, no-cache, must-revalidate");
	session_start();	
	include_once("conexion.php");
	
	//$nombreUsuario=$_COOKIE["nombreUsuario"];
	$idUsuario=$_COOKIE["idUsuario"];
	$idProducto = $_POST["idProducto"];
	$cantidad = $_POST["cantidad"];
	
	// me fijo si existe un pedido "En confeccion" para el usuario
	$sql="SELECT idPedido FROM pedidos WHERE usuario='$idUsuario' AND estado=1 LIMIT 1";
	$rePendiente=mysql_query($sql);

	if(mysql_num_rows($rePendiente) != 0)
	{
		$array=mysql_fetch_array($rePendiente);		
		$idPedido= $array["idPedido"];
	}	
	
	// Si no existe pedido "En confeccion" creo uno nuevo y tomo el ID.
	if($idPedido=="")
	{
	    $date = date("d-m-Y");
		$sql="INSERT INTO pedidos (idPedido, Usuario, estado, fecha) VALUES (null,'$idUsuario',1, '$date')";
		$result = mysql_query($sql);
				
		$sql="SELECT idPedido FROM pedidos WHERE usuario='$idUsuario' AND estado=1 ORDER BY idPedido desc LIMIT 1";
		$rePed=mysql_query($sql);

		if(mysql_num_rows($rePed) != 0)
		{
			$array=mysql_fetch_array($rePed);		
			$idPedido= $array["idPedido"];				
		}					
	}	
	$_SESSION["idPedido"] = $idPedido;
	
	// Tomo datos del producto a agregar al carrito.
	if ($idProducto != "") 
	{
	   	$idDetalle="";
	   	$sql="SELECT idCategoria, titulo, precio FROM productos WHERE idProducto=$idProducto";
		$rePrd=mysql_query($sql);
	
		if(mysql_num_rows($rePrd) != 0)
		{
			$array=mysql_fetch_array($rePrd);		
			$precio = $array["precio"];
		}
		
		// Verifico si existe en el pedido el producto.
		$sql="SELECT idDetalle FROM pedidosdetalles WHERE idProducto=$idProducto AND idPedido=$idPedido";
		$reDeta=mysql_query($sql);
	
		if(mysql_num_rows($reDeta) != 0)
		{
			$array=mysql_fetch_array($reDeta);		
			$idDetalle = $array["idDetalle"];
		}
		
		// Si existe, aumento la cantidad segun lo ingresado.
		// Si NO, lo ingreso al pedido.
		if ($idDetalle!="") {
			$sql="UPDATE pedidosdetalles SET cantidad = cantidad + ".$cantidad." WHERE idDetalle=$idDetalle";
			$result = mysql_query($sql);
		} else {					
			$sql="INSERT INTO pedidosdetalles(idPedido,idProducto, precio, cantidad) VALUES ($idPedido, $idProducto, $precio, $cantidad)";
			$result = mysql_query($sql);
		}
	}
	echo "Se cargo el producto con exito!!!";
?>