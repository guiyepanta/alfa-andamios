<html>
<head>
	<style>
		
		body {FONT-WEIGHT: normal; FONT-SIZE: 10px; COLOR: #555555; FONT-FAMILY: verdana}
		.titu {FONT-WEIGHT: bold; FONT-SIZE: 11px; BACKGROUND: #023977; COLOR: #FFFFFF; FONT-FAMILY: verdana}
		.row1 {FONT-WEIGHT: normal; FONT-SIZE: 12px; BACKGROUND: #e3f1ff;  FONT-FAMILY: verdana; HEIGHT: 15px}
		.row2 {FONT-WEIGHT: normal; FONT-SIZE: 12px; BACKGROUND: #EAEAEA; FONT-FAMILY: verdana; HEIGHT: 15px}
		.row {FONT-WEIGHT: normal; FONT-SIZE: 10px; BACKGROUND: #ffffff; FONT-FAMILY: verdana; HEIGHT: 15px}
		.titupagina {FONT-WEIGHT: bold; FONT-SIZE: 11px; BACKGROUND: #8f8f8f; COLOR: #ffffff; FONT-FAMILY: verdana}
		.titupaginasolapa {FONT-WEIGHT: bold; FONT-SIZE: 11px; BACKGROUND: #e6e6e6; COLOR: #ffffff; FONT-FAMILY: verdana}
		.botones {
            border-right: #999 1px solid;
            border-top: #999 1px solid;
            font-size: 14px;
            border-left: #999 1px solid;
            width: 100px;
            border-bottom: #999 1px solid;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            background-color: #ddd;
            line-height: 20px;
            margin-top: 10px;
            cursor: pointer;
        }
        .botones:hover {
            background-color: #98C0F4;
        }
	</style>	
    <script type="text/javascript" src="Javascript/funciones.js"></script>
</head>
<body>

<?php
	include ("conexion.php");
	
	$idPedido = $_GET["id"];
		
	$usuario="";
	$idLinea = 0;																																							    	
    $idCategoria = 0;
    $ban = 0;
    $total = 0;
    $sql = "SELECT 
				l.idLinea, 
				l.titulo as lTitulo, 
				c.idCategoria, 
				c.titulo, 
				pd.idDetalle,
				prd.idProducto,
				prd.titulo as pTitulo,
				pd.cantidad, 
				pd.precio,
				p.usuario,
				p.estado 
			FROM pedidos p, 
				 pedidosdetalles pd, 
				 productos prd,
				 categoria c, 
				 lineas l 
			WHERE p.idPedido=$idPedido 
				AND p.idPedido = pd.idPedido
				AND pd.idProducto = prd.idProducto 
				AND prd.idCategoria = c.idCategoria 
				AND c.idLinea = l.idlinea 
			ORDER BY l.idLinea, c.idCategoria";                                                                    
	$excel=mysql_query($sql);																																							    	
    $htmlMsj .= "#USUARIO#";
    $htmlMsj .= "<br /><table align='center' cellSpacing=1 cellPadding=1 width='100%' border=0 bgcolor='#e3e3e3'>";
    $htmlMsj .= "<tr>";																																						    			
    $htmlMsj .= "<td width='385' height='15' bgcolor='#ffffff'>&nbsp;Producto</td>";
    $htmlMsj .= "<td width='95' align=center bgcolor='#ffffff'>Cantidad</td>";
    $htmlMsj .= "<td width='90' bgcolor='#ffffff'>&nbsp;Precio $</td>";
    $htmlMsj .= "</tr>";
    while($regExcel=mysql_fetch_array($excel)) {
    	$usuario = $regExcel["usuario"];
    	$precio = $regExcel["precio"];
    	$total = $total + ($precio * $regExcel["cantidad"]);
    	if ($idLinea !=  $regExcel["idLinea"])
    	{
    		$idLinea = $regExcel["idLinea"];
    		$htmlMsj .= "<tr>";
    		$htmlMsj .= "<td style='background: url(\"../images/topnav-right-bg.gif\"); height: 20px;' colspan='3'>&nbsp;<span style='color: #fff; font-size: 13px; font-weight: bold;'>".$regExcel["lTitulo"]."</span></td>";
    		$htmlMsj .= "</tr>";
    	}																																			    		
    	
    	if ($idCategoria !=  $regExcel["idCategoria"])
    	{
    		$idCategoria = $regExcel["idCategoria"];
    		
    		$htmlMsj .= "<tr>";
    		$htmlMsj .= "<td bgcolor='#e3e3e3' height='15' colspan='3'>&nbsp;<span style='color: #666666; font-size: 11px; font-weight: bold;'>".$regExcel["titulo"]."</span></td>";
    		$htmlMsj .= "</tr>";
    	}																																							    			
    	$htmlMsj .= "<tr>";																																						    			
	    $htmlMsj .= "<td width='385' height='15' bgcolor='#ffffff'>&nbsp;&nbsp;".$regExcel["pTitulo"]."</td>";
	    $htmlMsj .= "<td width='85' align=right bgcolor='#ffffff'>".$regExcel["cantidad"]."&nbsp;&nbsp;</td>";
	    $htmlMsj .= "<td width='100' bgcolor='#ffffff' align='right'>&nbsp;".number_format(round($precio,2),2, ',','.')."&nbsp;</td>";
        $htmlMsj .= "</tr>";	
	    
	    $pedidoEstado = $regExcel["estado"];																																							
    }
    $totalIva = ($total * 21 / 100);
    $totalPagar = ($total + $totalIva);
    $htmlMsj .= "<tr><td colspan='3' height='1' bgcolor='#8f8f8f'></td></tr>";
    $htmlMsj .= "<tr><td bgcolor='#ffffff'></td><td bgcolor='#cceecc' align='right' style='color: #666666; font-size: 13px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>Total&nbsp;$</td><td bgcolor='#cceecc' align='right' style='color: #666666; font-size: 13px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>&nbsp;".number_format(round($total,2),2, ',','.')."&nbsp;</td></tr>";
    $htmlMsj .= "<tr><td bgcolor='#ffffff'></td><td bgcolor='#c3c3c3' align='right' style='color: #666666; font-size: 13px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>IVA 21%&nbsp;$</td><td bgcolor='#cceecc' align='right' style='color: #666666; font-size: 13px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>&nbsp;".number_format(round($totalIva,2),2, ',','.')."&nbsp;</td></tr>";
    $htmlMsj .= "<tr><td bgcolor='#ffffff'></td><td bgcolor='#e3f1ff' align='right' style='color: #666666; font-size: 13px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>Total a Pagar&nbsp;$</td><td bgcolor='#cceecc' align='right' style='color: #666666; font-size: 13px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>&nbsp;".number_format(round($totalPagar,2),2, ',','.')."&nbsp;</td></tr>";
    $htmlMsj .= "</table>";
    
	$sql="SELECT idCliente, nombre, apellido, direccion, codigoPostal, ciudad, pais, telefonos, empresa, identificacion FROM clientesportal WHERE idCliente = '". $usuario ."' AND estado=1";
	$datosUser = mysql_query($sql, $link);	
	$error = mysql_errno($link) . ":" . mysql_error($link);
		
	if(mysql_num_rows($datosUser)!=0) {
		$user=mysql_fetch_array($datosUser);			
		
		$htmlUser = "<table height='22' width='460' border='0' cellspacing='0' cellpadding='0'>";
		$htmlUser .= "<tr><td height='22' width='350' valign='middle' class='titupagina'>&nbsp;Datos Personales</td>";
		$htmlUser .= "<td width='46' valign='top' class='titupaginasolapa'>&nbsp;</td><td>&nbsp;</td></tr></Table><BR>";			
		$htmlUser .= "<table width='550' border='0' cellspacing='1' cellpadding='1' bgcolor='#ffffff'>";
		$htmlUser .= "<tr><td width='150' class='row1'>Apellido, Nombre:</td><td class='row2'>".$user["apellido"].", ".$user["nombre"]."</td></TR>";
		$htmlUser .= "<tr><td width='150' class='row1'>E-mail:</td><td class='row2'>".$user["idCliente"]."</td></TR>";
        $htmlUser .= "<tr><td width='150' class='row1'>Identificacion:</td><td class='row2'>".$user["identificacion"]."</td></TR>";
        $htmlUser .= "<tr><td width='150' class='row1'>Empresa:</td><td class='row2'>".$user["empresa"]."</td></TR>";
		$htmlUser .= "<tr><td width='150' class='row1'>Direccion:</td><td class='row2'>".$user["direccion"]." CP:".$user["codigoPostal"]."</td></TR>";
		$htmlUser .= "<tr><td width='150' class='row1'>Ciudad:</td><td class='row2'>".$user["ciudad"]."</td></TR>";
		$htmlUser .= "<tr><td width='150' class='row1'>Pais:</td><td class='row2'>".$user["pais"]."</td></TR>";
		$htmlUser .= "<tr><td width='150' class='row1'>Telefono:</td><td class='row2'>".$user["telefonos"]."</td></TR></Table>";

		$htmlMsj =  str_replace("#USUARIO#", $htmlUser, $htmlMsj);					
	}	
	echo $htmlMsj;
if ($pedidoEstado>=3)
	echo "<center><input type='button' onclick='imprimirPedido($idPedido,5)' value='Impimir' class='botones' /></center>";
else 
    echo "<center><input type='button' class='botones' disabled=disabled /></center>"; 
?>
</body>
</html>
