<?php
	header("Cache-Control: no-store, no-cache, must-revalidate");
	session_start();
	include ("conexion.php");
	
	$idPedido = $_GET["id"];
	$date = date("d-m-Y");
	$sql = "UPDATE pedidos SET fecha = '$date', estado = 4 WHERE idPedido=".$idPedido;

	$editarCant=mysql_query($sql);
	$error = mysql_errno($link) . ":" . mysql_error($link);
	if($error == "0:"){	
		$_SESSION["idPedido"] = "";	
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
					prd.iva,
					p.usuario 
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
        $htmlExcel .= "<table align='center' cellSpacing=1 cellPadding=1 width='100%' border=0 bgcolor='#e3e3e3'>";
        $htmlExcel .= "<tr><td colspan='5' height='20' bgcolor='#ffffff' style='font-wheith: bold; font-size: 14px; color: #3F4C6B; padding 4px;'>&nbsp;Pedido nro: $idPedido</td></tr>";																																						    			
        $htmlExcel .= "<tr>";																																						    			
        $htmlExcel .= "<td width='380' height='15' bgcolor='#ffffff'>&nbsp;Producto</td>";
        $htmlExcel .= "<td width='75' bgcolor='#ffffff'>&nbsp;Precio</td>";
        $htmlExcel .= "<td width='75' align=center bgcolor='#ffffff'>Cantidad</td>";
        $htmlExcel .= "<td width='50' bgcolor='#ffffff'>&nbsp;IVA</td>";
        $htmlExcel .= "<td width='75' align=center bgcolor='#ffffff'>Total + IVA</td>";
        $htmlExcel .= "</tr>";
        while($regExcel=mysql_fetch_array($excel)) {
        	$usuario = $regExcel["usuario"];
        	$precio = $regExcel["precio"];
        	$totalConIva = (($precio * $regExcel["cantidad"]) * (($regExcel["iva"] / 100) + 1));
            $totalPagar = $totalPagar + $totalConIva;
            if ($idLinea !=  $regExcel["idLinea"])
        	{
        		$idLinea = $regExcel["idLinea"];
        		$htmlExcel .= "<tr>";
        		$htmlExcel .= "<td colspan='5' style='background-color: #3F4C6B; height: 20px;'>&nbsp;<span style='color: #fff; font-size: 13px; font-weight: bold;'>".$regExcel["lTitulo"]."</span></td>";
        		$htmlExcel .= "</tr>";
        	}																																			    		
        	
        	if ($idCategoria !=  $regExcel["idCategoria"])
        	{
        		$idCategoria = $regExcel["idCategoria"];
        		$htmlExcel .= "<tr>";
        		$htmlExcel .= "<td bgcolor='#e3e3e3' height='15' colspan='4'>&nbsp;<span style='color: #666666; font-size: 11px; font-weight: bold;'>".$regExcel["titulo"]."</span></td>";
        		$htmlExcel .= "</tr>";
        	}																																							    			
        	$htmlExcel .= "<tr>";																																						    			
            $htmlExcel .= "<td width='380' height='15' bgcolor='#ffffff'>&nbsp;&nbsp;".$regExcel["pTitulo"]."</td>";
            $htmlExcel .= "<td width='75' bgcolor='#eeeeee' align='right'>&nbsp;".number_format(round($precio,2),2, ',','.')."&nbsp;</td>";
            $htmlExcel .= "<td width='75' align=right bgcolor='#ffffff'>&nbsp;".$regExcel["cantidad"]."&nbsp;</td>";
			$htmlExcel .= "<td width='50' align=right bgcolor='#ffffff'>&nbsp;".number_format(round($regExcel["iva"], 2),2,',', '.')."</td>";
            $htmlExcel .= "<td width='75' align=right bgcolor='#CEE3F6'>&nbsp;".number_format(round($totalConIva, 2),2,',', '.')."</td>";
            $htmlExcel .= "</tr>";																																								
        }
        $htmlExcel .= "<tr><td colspan='5' height='5' bgcolor='#fff'></td></tr>";
        $htmlExcel .= "<tr><td colspan='5' height='1' bgcolor='#333'></td></tr>";
        $htmlExcel .= "<tr><td colspan='5' bgcolor='#fff'>";
        $htmlExcel .= "<table align='right' cellSpacing=0 cellPadding=0 width='45%' border=0 bgcolor='#ffffff'>";
        //$htmlExcel .= "<tr><td bgcolor='#dddddd' align='right' style='color: #666666; font-size: 14px; font-weight: bold; padding-top: 2px; padding-bottom: 2px; width: 55%;'>SubTotal &#36;&nbsp;</td><td bgcolor='#dddddd' align='right' style='color: #666666; font-size: 14px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>".number_format(round($total,2),2, ',','.')."&nbsp;</td></tr>";
        //$htmlExcel .= "<tr><td bgcolor='#ffffff' align='right' style='color: #666666; font-size: 14px; font-weight: bold; padding-top: 2px; padding-bottom: 2px; width: 55%;'>IVA (21%)&nbsp;</td><td bgcolor='#ffffff' align='right' style='color: #666666; font-size: 14px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>".number_format(round($totalIva,2),2, ',','.')."&nbsp;</td></tr>";
        $htmlExcel .= "<tr><td bgcolor='#cceecc' align='right' style='color: #666666; font-size: 16px; font-weight: bold; padding-top: 2px; padding-bottom: 2px; width: 45%;'>Total a pagar &#36;&nbsp;</td><td bgcolor='#cceecc' align='right' style='color: #666666; font-size: 16px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>".number_format(round($totalPagar,2),2, ',','.')."&nbsp;</td></tr>";
        $htmlExcel .= "</table>";
		$htmlExcel .= "</td></tr></table>";
		
		$sql="SELECT idCliente, nombre, apellido, direccion, codigoPostal, ciudad, pais, telefonos, empresa FROM clientesportal WHERE idCliente = '". $usuario ."' AND estado=1";
		$datosUser = mysql_query($sql, $link);	
		$error = mysql_errno($link) . ":" . mysql_error($link);

			
		if(mysql_num_rows($datosUser)!=0) {
			$user=mysql_fetch_array($datosUser);
			
			$destMailCliente="";
			
			$htmlUser = "<html><head><style type='text/css'>";
			$htmlUser .= "body {FONT-WEIGHT: normal; FONT-SIZE: 10px; COLOR: #555555; FONT-FAMILY: verdana}";
			$htmlUser .= ".titu {FONT-WEIGHT: bold; FONT-SIZE: 11px; BACKGROUND: #023977; COLOR: #FFFFFF; FONT-FAMILY: verdana}";
			$htmlUser .= ".row1 {FONT-WEIGHT: normal; FONT-SIZE: 10px; BACKGROUND: #e3f1ff;  FONT-FAMILY: verdana; HEIGHT: 15px}";
			$htmlUser .= ".row2 {FONT-WEIGHT: normal; FONT-SIZE: 10px; BACKGROUND: #EAEAEA; FONT-FAMILY: verdana; HEIGHT: 15px}";
			$htmlUser .= ".row {FONT-WEIGHT: normal; FONT-SIZE: 10px; BACKGROUND: #ffffff; FONT-FAMILY: verdana; HEIGHT: 15px}";
			$htmlUser .= ".titupagina {FONT-WEIGHT: bold; FONT-SIZE: 11px; BACKGROUND: #8f8f8f; COLOR: #ffffff; FONT-FAMILY: verdana}";
			$htmlUser .= ".titupaginasolapa {FONT-WEIGHT: bold; FONT-SIZE: 11px; BACKGROUND: #e6e6e6; COLOR: #ffffff; FONT-FAMILY: verdana}";
			$htmlUser .= "</style></head><body>";
			$htmlUser .= "<br><table height='22' width='460' border='0' cellspacing='0' cellpadding='0'>";
			$htmlUser .= "<tr><td height='22' width='350' valign='middle' class='titupagina'>&nbsp;Datos Personales</td>";
			$htmlUser .= "<td width='46' valign='top' class='titupaginasolapa'>&nbsp;</td><td>&nbsp;</td></tr></Table><BR>";			
			$htmlUser .= "<table width='300' border='0' cellspacing='1' cellpadding='1' bgcolor='#ffffff'>";
			$htmlUser .= "<tr><td width='100' class='row1'>Apellido, Nombre:</td><td class='row2'>".$user["apellido"].", ".$user["nombre"]."</td></TR>";
			$htmlUser .= "<tr><td width='100' class='row1'>E-mail:</td><td class='row2'>".$user["idCliente"]."</td></TR>";
			$htmlUser .= "<tr><td width='100' class='row1'>Empresa:</td><td class='row2'>".$user["empresa"]."</td></TR>";
			$htmlUser .= "<tr><td width='100' class='row1'>Direccion:</td><td class='row2'>".$user["direccion"]." CP:".$user["codigoPostal"]."</td></TR>";
			$htmlUser .= "<tr><td width='100' class='row1'>Ciudad:</td><td class='row2'>".$user["ciudad"]."</td></TR>";
			$htmlUser .= "<tr><td width='100' class='row1'>Pais:</td><td class='row2'>".$user["pais"]."</td></TR>";
			$htmlUser .= "<tr><td width='100' class='row1'>Telefono:</td><td class='row2'>".$user["telefonos"]."</td></TR></Table>";
			$htmlUser .= "<br>#USUARIO#";
			
			$htmlMsj =  str_replace("#USUARIO#", $htmlExcel, $htmlUser);
			
			$mailHead="info@andamiosalfa.com.ar";		
			//$mailHead="guillermo.pantanetti@hotmail.com";		
			$destMailCliente= $user["idCliente"];			
			
			// Mail para el Cliente
			$head = "From: ".$mailHead."\r\nContent-type: text/html\r\n";
			$ok = mail($destMailCliente, "Pedido Web", "Usted acaba de solicitar el siguiente pedido:" . $htmlMsj, $head);
			
			// Mail para Alfa-Andamios
			$head = "From: ".$destMailCliente."\r\nContent-type: text/html\r\n";
			$ok = mail($mailHead, "Pedido Web-PRUEBA (DESCARTAR)", "Acaban de ingresar el siguiente pedido via Web:" . $htmlMsj, $head);
		}
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="cont_heading_table">
			<tr>
				<td class="cont_heading_td">Su pedido fue ingresado!</td>
			</tr>
		</table>								
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td class="padd_1">	
					<table cellpadding="0" cellspacing="0" border="0" style="margin:0px 10px 0px 0px;">
						<tr>
							<td align="center">
								<img src="images/ok.png" border="0" alt="Su pedido fue ingresado!" title=" Su pedido fue ingresado! " width="150" height="150">
							</td>
							<td class="main" style="padding:30px 0px 0px 0px; width:100%;">
								Enhorabuena! Su pedido fue ingresado con &eacute;xito! 
								<br>Y en breve nos estaremos poniendo en contacto con Ud. 
								<br> Si tiene <small><b>alguna o duda</b></small>, por favor comuniquela al <a href="contacto.php">encargado</a>.
								<br><br>Se ha enviado una confirmaci&oacute;n a la direcci&oacute;n de correo que nos ha proporcionado. Si no lo ha recibido en 1 hora pongase en contacto con <a href="contacto.php">nosotros</a>.
							</td>							
						</tr>
						<tr>
							<td align="right" colspan="2">
								Muchas Gracias!...
							</td>							
						</tr>

					</table>			
					<div style="padding:0px 0px 9px 0px;"><img src="images/spacer.gif" border="0" alt="" width="1" height="1"></div>				
					<table cellpadding="0" cellspacing="5" border="0">
						<tr>
							<td>
								<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td align="right">
											<a href="index.php"><img src="images/btnContinuar.png" border="0" alt="Continuar" title=" Continuar " height="15"></a>
										</td>
									</tr>
								</table>			
							</td>
						</tr>
					</table>	
				</td>
			</tr>
		</table>
		
		<?php		
	} else {
		echo "ERROR";
	}

?>
