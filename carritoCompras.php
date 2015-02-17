<?php
    header("Cache-Control: no-store, no-cache, must-revalidate");
    session_start();
    
    include ("conexion.php");
    include("clases/Utils.php");	
    
    if ($_SESSION["autorizacion_Login"]!=1)
    	Header("Location: login.php");
	
	$idPedido = $_SESSION["idPedido"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Alfa Andamios</title>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!--[if IE 6]>
        <link rel="stylesheet" type="text/css" href="css/iecss.css" />
        <![endif]-->
        <style>
            .view_cart {
            width: 780px;
            }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/utils.js"></script>
    </head>
    <body>
        <div id="main_container">
            <div id="header">
                <?php include_once 'header.php'; ?>	
            </div>
            <div id="main_content">
                <div id="menu_tab">
                    <?PHP include_once 'menu.php'; ?>
                </div>
                <!-- end of menu tab -->
                <div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
                <div class="left_content">
                    
                    <?php include_once 'menu-left.php'; ?>
                    
                </div>
                <!-- end of left content -->
                <div class="center_content view_cart">                    
                    <div class='center_title_bar'>Detalle de su pedido</div>
                    <TABLE border=0 cellSpacing=0 cellPadding=0 width="98%" style="margin-left: 5px; margin-top: 15px; float: left">
                        <TBODY>
                            <TR>
                                <TD class=padd_3>
                                    <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                                        <TBODY>
                                            <TR>
                                                <TD class="tableBox_output_td main">
                                                    <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                                                        <TBODY>
                                                            <TR>
                                                                <TD align=left>																																							
                                                                    <?php
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
																				prd.iva 
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
                                                                    																																							    	
                                                                    $htmlExcelBotones = "";
                                                                    $htmlExcel .= "<table align='center' cellSpacing=1 cellPadding=1 width='100%' border=0 bgcolor='#e3e3e3'>";
                                                                    $htmlExcel .= "<tr>";																																						    			
                                                                    $htmlExcel .= "<td width='380' height='15' bgcolor='#ffffff'>&nbsp;Producto</td>";
                                                                    $htmlExcel .= "<td width='75' bgcolor='#ffffff'>&nbsp;Precio</td>";
                                                                    $htmlExcel .= "<td width='75' align=center bgcolor='#ffffff'>Cantidad</td>";
                                                                    $htmlExcel .= "<td width='50' bgcolor='#ffffff'>&nbsp;IVA</td>";
                                                                    $htmlExcel .= "<td width='75' align=center bgcolor='#ffffff'>Total + IVA</td>";
                                                                    $htmlExcel .= "</tr>";
                                                                    if($idPedido!='') {
                                                                        $excel=mysql_query($sql);
                                                                        if (mysql_num_rows($excel) > 0) {
    	                                                                    while($regExcel=mysql_fetch_array($excel)) {
    	                                                                    	
    	                                                                    	$precio = $regExcel["precio"];
    	                                                                    	$totalConIva = (($precio * $regExcel["cantidad"]) * (($regExcel["iva"] / 100) + 1));
    	                                                                    	$totalPagar = $totalPagar + $totalConIva;
    	                                                                    	if ($idLinea !=  $regExcel["idLinea"])
    	                                                                    	{
    	                                                                    		$idLinea = $regExcel["idLinea"];
    	                                                                    		$htmlExcel .= "<tr>";
    	                                                                    		$htmlExcel .= "<td colspan='5' style='background: url(\"./images/topnav-right-bg.gif\"); height: 20px;'>&nbsp;<span style='color: #fff; font-size: 13px; font-weight: bold;'>".$regExcel["lTitulo"]."</span></td>";
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
    		                                                                    $htmlExcel .= "<td width='380' height='15' bgcolor='#ffffff'>&nbsp;&nbsp;".$regExcel["pTitulo"]."&nbsp;&nbsp;&nbsp;<a href='javascript: eliminarItemCarrito(".$regExcel["idDetalle"].");' style='color: #dd6666; font-size: 11px;'>[Eliminar]</a></td>";
    		                                                                    $htmlExcel .= "<td width='75' bgcolor='#eeeeee' align='right'>&nbsp;".number_format(round($precio,2),2, ',','.')."&nbsp;</td>";
    		                                                                    /*onBlur='setearCantidad(".$regExcel["idDetalle"].", ".$regExcel["cantidad"].", this.value);'*/
    		                                                                    $htmlExcel .= "<td width='75' align=center bgcolor='#ffffff'>&nbsp;<a href='javascript: editarCantidad(".$regExcel["idDetalle"].", -1);' title='Disminuir cantidad'><img src='images/remove.gif' border=0 /></a>&nbsp;<input style='width:40px; height:12px; font-size:12px;' id='txtProdId_".$regExcel["idDetalle"]."' name='txtProdId_".$regExcel["idDetalle"]."' type='text' value='".$regExcel["cantidad"]."' readonly />&nbsp;<a href='javascript: editarCantidad(".$regExcel["idDetalle"].", 1);' title='Aumentar cantidad'><img src='images/add.gif' border=0 /></a>&nbsp;</td>";
    																			$htmlExcel .= "<td width='50' align=right bgcolor='#ffffff'>&nbsp;".number_format(round($regExcel["iva"], 2),2,',', '.')."</td>";
    		                                                                    $htmlExcel .= "<td width='75' align=right bgcolor='#CEE3F6'>&nbsp;".number_format(round($totalConIva, 2),2,',', '.')."</td>";
    		                                                                    $htmlExcel .= "</tr>";																																								
    	                                                                    }
                                                                            $htmlExcelBotones .= "<table align='center' cellSpacing=0 cellPadding=0 width='100%' border=0 bgcolor='#ffffff'>";
                                                                            $htmlExcelBotones .= "<tr><td align='right' style='color: #666666; font-size: 13px; font-weight: bold; padding-top: 15px; padding-bottom: 30px;'><a href='index.php'>Seguir Comprando</a>&nbsp;|&nbsp;<a href='confirmarCarrito.php?action=vaciar' style='color: #dd3333; font-size: 13px; font-weight: bold'>Vaciar Pedido</a>&nbsp;|&nbsp;<a href='confirmarCarrito.php?action=terminar' style='color: #33dd33; font-size: 14px; font-weight: bold'>Terminar Pedido</a>&nbsp;</td></tr>";
                                                                            $htmlExcelBotones .= "</table>";
	                                                                    
                                                                        } else{
                                                                            $htmlExcelBotones .= "<table align='center' cellSpacing=0 cellPadding=0 width='100%' border=0 bgcolor='#ffffff'>";
                                                                            $htmlExcelBotones .= "<tr><td align='right' style='color: #666666; font-size: 13px; font-weight: bold; padding-top: 15px; padding-bottom: 30px;'><a href='index.php'>Seguir Comprando</a>&nbsp;</td></tr>";
                                                                            $htmlExcelBotones .= "</table>";
                                                                        }
            
	                                                                } else {
                                                                            $htmlExcelBotones .= "<table align='center' cellSpacing=0 cellPadding=0 width='100%' border=0 bgcolor='#ffffff'>";
                                                                            $htmlExcelBotones .= "<tr><td align='right' style='color: #666666; font-size: 13px; font-weight: bold; padding-top: 15px; padding-bottom: 30px;'><a href='index.php'>Seguir Comprando</a>&nbsp;</td></tr>";
                                                                            $htmlExcelBotones .= "</table>";
                                                                    }
                                                                    
                                                                    $htmlExcel .= "<tr><td colspan='5' height='5' bgcolor='#fff'></td></tr>";
                                                                    $htmlExcel .= "<tr><td colspan='5' height='1' bgcolor='#333'></td></tr>";
                                                                    $htmlExcel .= "<tr><td colspan='5' bgcolor='#fff'>";
                                                                    $htmlExcel .= "<table align='right' cellSpacing=0 cellPadding=0 width='31.25%' border=0 bgcolor='#ffffff'>";
                                                                    //$htmlExcel .= "<tr><td bgcolor='#dddddd' align='right' style='color: #666666; font-size: 14px; font-weight: bold; padding-top: 2px; padding-bottom: 2px; width: 55%;'>SubTotal &#36;&nbsp;</td><td bgcolor='#dddddd' align='right' style='color: #666666; font-size: 14px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>".number_format(round($total,2),2, ',','.')."&nbsp;</td></tr>";
                                                                    //$htmlExcel .= "<tr><td bgcolor='#ffffff' align='right' style='color: #666666; font-size: 14px; font-weight: bold; padding-top: 2px; padding-bottom: 2px; width: 55%;'>IVA (21%)&nbsp;</td><td bgcolor='#ffffff' align='right' style='color: #666666; font-size: 14px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>".number_format(round($totalIva,2),2, ',','.')."&nbsp;</td></tr>";
                                                                    $htmlExcel .= "<tr><td bgcolor='#cceecc' align='right' style='color: #666666; font-size: 16px; font-weight: bold; padding-top: 2px; padding-bottom: 2px; width: 55%;'>Total a pagar &#36;&nbsp;</td><td bgcolor='#cceecc' align='right' style='color: #666666; font-size: 16px; font-weight: bold; padding-top: 2px; padding-bottom: 2px;'>".number_format(round($totalPagar,2),2, ',','.')."&nbsp;</td></tr>";
                                                                    $htmlExcel .= "</table>";
																	$htmlExcel .= "</td></tr></table>";
                                                                    
                                                                    $htmlExcel .= $htmlExcelBotones;
                                                                    
                                                                    echo $htmlExcel;
                                                                    ?>
                                                                </TD>
                                                            </TR>
                                                        </TBODY>
                                                    </TABLE>
                                                </TD>
                                            </TR>
                                        </TBODY>
                                    </TABLE>
                                    <!-- new_products_eof //-->
                                    <table border=0 cellSpacing=0 cellPadding=0 width="100%" style="margin-bottom: 15px;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 10px 25px; background-color: #D3DCF3; margin-bottom: 15px;">
                                                	<p style="font-size: 14px; line-height: 20px;">
                                                		<span style="font-weight: bold; text-decoration: underline; font-size: 16px;">Condiciones de entrega:</span> 
											            <br>Los materiales comprados en nuestro sitio WEB, se retiran en nuestro deposito.
											            <br>Consulte costos de Env&iacute;os.
											        </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </TD>
                            </TR>
                        </TBODY>
                    </TABLE>
                </div>                
            </div>
            <!-- end of main content -->
            
            <?php include_once 'footer.php'; ?>
            
        </div>
        <!-- end of main_container -->
        <script language="Javascript">
            document.oncontextmenu = function(){return false}
        </script>
    </body>
</html>