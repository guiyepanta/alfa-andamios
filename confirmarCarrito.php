<?php
    header("Cache-Control: no-store, no-cache, must-revalidate");
    session_start();
    include ("conexion.php");
    include("clases/Utils.php");	
    
    if ($_SESSION["autorizacion_Login"]!=1)
    	Header("Location: login.php");    
    
	$action=$_GET["action"];
	$idLinea=$_GET["linea"];
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/utils.js"></script>
        <style>
            fieldset {
                 border-radius:5px; 
                -moz-border-radius:5px; /* Firefox */ 
                -webkit-border-radius:5px; /* Safari y Chrome */ 
                
                /* Otros estilos */ 
                border:2px solid #4082AD;
                margin-top: 20px;
                float: inherit;
                width: 580px;
                margin-bottom: 25px; 
                margin-left: 5px;               
            }
            legend {
                font-size: 20px;
                font-weight: bold;
                font-family: Arial;
                color: darkslateblue;
            }
            .wrapper-MP{
                width: 200px;
                padding: 5px;
                margin-right: 5px;
                float: left;
            }            
            .wrapper-MP a {
                width: 145px; 
            }            
            .wrapper-MP span {
                margin-top: 2px;
            }
            .wrapper-PL{
                width: 200px;
                padding: 5px;
                margin-bottom: 25px;
                margin-right: 5px;
                float: left;
            }            
            .wrapper-PL a {
                 border-radius:5px; 
                -moz-border-radius:5px; /* Firefox */ 
                -webkit-border-radius:5px; /* Safari y Chrome */ 
                width: 145px;
                color: rgb(255, 255, 255);
                text-decoration: none;
                background-position: 0px -80px;
                background-color: rgb(47, 113, 157); 
                font-size: 20px;
                line-height: 40px;
                padding: 0px 20px;
                font-family: 'Trebuchet MS';
                cursor: pointer;
                display: inline-block;
                margin: 10px;
                font-weight: normal;
                background: url("./images/pl-payButton-blue.png") rgb(40, 83, 111);
                border: 1px solid rgb(41, 62, 117);
                border-image-source: initial;
                border-image-slice: initial;
                border-image-width: initial;
                border-image-outset: initial;
                border-image-repeat: initial;
                text-shadow: rgb(41, 62, 117) 1px 1px;
                text-align: center;
            }
            .wrapper-PL a:hover {
                background-position: 0px -300px;
                background-color: rgb(46, 113, 147); 
            }
            
            .wrapper-CANCEL{
                width: 135px;
                padding: 5px;
                margin-bottom: 25px;
                margin-right: 5px;
                float: left;
            }            
            .wrapper-CANCEL a {
                 border-radius:5px; 
                -moz-border-radius:5px; /* Firefox */ 
                -webkit-border-radius:5px; /* Safari y Chrome */ 
                width: 80px;
                color: rgb(51, 51, 51);
                text-decoration: none;
                background-position: 0px -80px;
                background-color: rgb(47, 113, 157); 
                font-size: 20px;
                line-height: 40px;
                padding: 0px 20px;
                font-family: 'Trebuchet MS';
                cursor: pointer;
                display: inline-block;
                margin: 10px;
                font-weight: normal;
                background: url("./images/lp-payButton-grey.png") rgb(197, 197, 197);;
                border: 1px solid rgb(173, 173, 173);
                border-image-source: initial;
                border-image-slice: initial;
                border-image-width: initial;
                border-image-outset: initial;
                border-image-repeat: initial;
                text-align: center;
            }
            .wrapper-CANCEL a:hover {
                background-position: 0px -300px;
                background-color: rgb(225, 225, 225); 
            }
        </style>
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
                <div class="center_content">
                    <div class='center_title_bar'>Detalle de su pedido</div>
                    <!-- FIN Miga de Pan -->
                    <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" style="margin-left: 5px; margin-top: 15px; float: left">
                        <TBODY>
                            <TR>
                                <TD class=padd_3 id="resultConfirm">
                                	<TABLE border=0 cellSpacing=0 cellPadding=0>
                                        <tbody>
                                            <tr>
                                                <td><img alt="Atencion" src="images/atencion.gif" height="75"></td>
                                                <td style="padding-top:25px;">
                                                    <span style='color: #666666; font-size: 20px;'>
                                                    <?php 
                                                        if($action=="terminar")
                                                        	echo "Estas por <span style='color: #33ee33;'>Confirmar</span> el Pedido!"; 
                                                        else
                                                        	echo "Estas por <span style='color: #ee3333;'>Vaciar</span> el Pedido!";
                                                        ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                                        <TBODY>
                                            <TR>
                                                <TD class="tableBox_output_td main">
                                                    <TABLE border=0 cellSpacing=0 cellPadding=0 width="98%">
                                                        <TBODY>
                                                            <TR>
                                                                <TD align=left>																																						
                                                                    <?php
                                                                        $cliente = "";
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
                                                                    	$excel=mysql_query($sql);																																							    	
                                                                        $htmlExcel .= "<table align='center' cellSpacing=1 cellPadding=1 width='100%' border=0 bgcolor='#e3e3e3'>";
                                                                        $htmlExcel .= "<tr>";																																						    			
                                                                        $htmlExcel .= "<td width='380' height='15' bgcolor='#ffffff'>&nbsp;Producto</td>";
	                                                                    $htmlExcel .= "<td width='75' bgcolor='#ffffff'>&nbsp;Precio</td>";
	                                                                    $htmlExcel .= "<td width='75' align=center bgcolor='#ffffff'>Cantidad</td>";
	                                                                    $htmlExcel .= "<td width='50' bgcolor='#ffffff'>&nbsp;IVA</td>";
	                                                                    $htmlExcel .= "<td width='75' align=center bgcolor='#ffffff'>Total + IVA</td>";
	                                                                    $htmlExcel .= "</tr>";
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
																	
                                                                        if($action!="terminar"){
                                                                            $htmlExcel .= "<table align='center' cellSpacing=0 cellPadding=0 width='100%' border=0 bgcolor='#ffffff'>";
                                                                            $htmlExcel .= "<tr><td align='right' style='color: #666666; font-size: 13px; font-weight: bold; padding-top: 15px; padding-bottom: 30px;'>&nbsp;<a href='carritoCompras.php?linea=$idLinea' style='color: #dd3333; font-size: 12px; font-weight: normal'>Cancelar</a>&nbsp;|&nbsp;<a href='javascript: ConfirmarAccionPedido(\"$action\", $idPedido);' style='color: #33dd33; font-size: 14px; font-weight: bold'>Confirmar</a>&nbsp;</td></tr>";
                                                                            $htmlExcel .= "</table>";
                                                                        }
                                                                        echo $htmlExcel;
                                                                        ?>
                                                                        
                                                                        <?php
                                                                        if($action=="terminar") {
                                                                            
                                                                            require_once ("lib/mercadopago.php");
                                                                        
                                                                            $sql = "SELECT 
                                                                                        cp.idCliente,
                                                                                        cp.nombre,
                                                                                        cp.apellido,
                                                                                        cp.direccion,
                                                                                        cp.codigoPostal,
                                                                                        cp.ciudad,
                                                                                        cp.pais,
                                                                                        cp.telefonos,
                                                                                        cp.empresa
                                                                                    FROM pedidos p, 
                                                                                         clientesportal cp 
                                                                                    WHERE p.idPedido=$idPedido 
                                                                                        AND cp.idCliente = p.usuario";                                                                    
                                                                            
                                                                            $res=mysql_query($sql);
                                                                            if(mysql_num_rows($res) != 0)
                                                                            {
                                                                                $datosCliente=mysql_fetch_array($res);                                                                                                                                                                   
                                                                                                                                    
                                                                                $mp = new MP("6821107677944976", "nhxHkZ6tFLpvjbHlpesZjklTmQLTapcY");
                                                                                
                                                                                $preference_data = array(
                                                                                    "items" => array(
                                                                                        array(
                                                                                            "id" => "$idPedido",
                                                                                            "title" => "WEB: " . $datosCliente["empresa"] . " (Nro. Pedido: $idPedido)",
                                                                                            "currency_id" => "ARS",
                                                                                            "quantity" => 1,
                                                                                            "unit_price" => round($totalPagar,2)
                                                                                        )
                                                                                    ),
                                                                                    "payer" => array(
                                                                                        "name" => $datosCliente["nombre"],
                                                                                        "surname" => $datosCliente["apellido"],
                                                                                        "email" => $datosCliente["idCliente"],
                                                                                        "date_created" => "2000-01-01T00:00:00.000-00:00",
                                                                                        "phone" => array(
                                                                                            "area_code" => "+549",
                                                                                            "number" => $datosCliente["telefonos"]
                                                                                        ),
                                                                                        "address" => array(
                                                                                            "street_name" => $datosCliente["direccion"] . " - " . $datosCliente["ciudad"] . " - " . $datosCliente["pais"],
                                                                                            "street_number" => 0,
                                                                                            "zip_code" => $datosCliente["codigoPostal"]
                                                                                        )
                                                                                    ),
                                                                                    "back_urls" => array(
                                                                                        "success" => "http://www.andamiosalfa.com.ar/Store/confirmarCompra-MP.php?data=$idPedido",
                                                                                        "failure" => "http://www.andamiosalfa.com.ar/Store/confirmarCompra-MP.php?data=$idPedido",
                                                                                        "pending" => "http://www.andamiosalfa.com.ar/Store/confirmarCompra-MP.php?data=$idPedido"
                                                                                    )
                                                                                );
                                                                            }
                                                                            
                                                                            $preference = $mp->create_preference($preference_data);
                                                                            ?>
                                                                            <fieldset>
                                                                                <legend>Metodos de pago</legend>
                                                                                <div class="wrapper-CANCEL">
                                                                                    <a href='<?php echo "carritoCompras.php?linea=$idLinea"; ?>' name="cancel-Checkout">Cancelar</a>                                
                                                                                </div>
                                                                                
                                                                                <div class="wrapper-MP">
                                                                                    <a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout" class="orange-L-Rn-Tr-ArOn">Mercado Pago</a>
                                                                                    <script type="text/javascript" src="http://mp-tools.mlstatic.com/buttons/render.js"></script>
                                                                                </div>
                                                                                
                                                                                <div class="wrapper-PL">
                                                                                    <a href="javascript: ConfirmarAccionPedido('<?php echo $action;?>', <?php echo $idPedido; ?>);" name="Local-Checkout">Pagar al retirar</a>                                
                                                                                </div>
                                                                                
                                                                            </fieldset>
                                                                        <?php
                                                                        }
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
                    <!-- Fin Contents //-->                    					
                </div>
                <!-- end of center content -->
                <div class="right_content">
                    
                    <?php include_once 'menu-right.php'; ?>
                    
                </div>
                <!-- end of right content -->
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
