<?php
    header("Cache-Control: no-store, no-cache, must-revalidate");
    session_start();
    include_once("conexion.php");
    include_once("clases/Utils.php");    
    
    if ($_SESSION["autorizacion_Login"]!=1)
        Header("Location: login.php");    
    
    //http://localhost/php/Alfa-Andamios/confirmarCompra-MP.php?data=11&collection_id=847064940&collection_status=pending&preference_id=43587674-91d55d49-173a-4788-804e-09188e051a77&external_reference=null&payment_type=ticket
    $idPedido = $_GET["data"];
    $estado = $_GET["collection_status"];
    $codigoPago = $_GET["collection_id"];
    $idEstado = 1;
    include_once ("conexion.php");
    
    if ($estado=="success")
        $idEstado = 3;
    elseif ($estado=="pending") {
        $idEstado = 2;
    }
    $date = date("d-m-Y");
    $res = mysql_query("UPDATE pedidos SET fecha = '$date', estado=$idEstado WHERE idPedido=$idPedido", $link);
        
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Alfa Andamios</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!--[if IE 6]>
        <link rel="stylesheet" type="text/css" href="css/iecss.css" />
        <![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/utils.js"></script>
        <style>
            .cont_heading_td {
                font-size: 16px;
                padding-bottom: 10px;
                padding-left: 77px; 
            }
            .cont_heading_td span{
                font-weight: bold; 
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
                <div class="crumb_navigation"> Navigation: <span class="current">Confirmación pago</span> </div>
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
                                                    <?php 
                                                    $encabezado="";
                                                    if ($estado=="success")
                                                        $encabezado = "Su pedido fue Acreditado!";
                                                    elseif ($estado=="pending")
                                                        $encabezado = "Su pedido esta Pendiente de acreditarse!";
                                                    elseif ($estado=="failure") 
                                                        $encabezado = "Su pedido fallo al acreditarse!";                                                      
                                                    
                                                    
                                                    ?>
                                                    <span style='color: #666666; font-size: 20px;'>
                                                        <?php echo $encabezado; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                                        <TBODY>
                                            <TR>
                                                <TD class="tableBox_output_td main">
                                                    <?php                                                     
                                                    if ($estado!="failure") {
                                                    ?>
                                                    
                                                    <table cellpadding="0" cellspacing="0" border="0" class="cont_heading_table">
                                                        <tr>
                                                            <td class="cont_heading_td">Codigo Pedido: <span><?php echo $idPedido; ?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="cont_heading_td">Codigo Mercado-Pago: <span><?php echo $codigoPago; ?></span></td>
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
                                                                            <br><br>.
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
                                                    <?php } else {?>
                                                    <table cellpadding="0" cellspacing="0" border="0" class="cont_heading_table">
                                                        <tr>
                                                            <td class="cont_heading_td">Fall&oacute; la Acreditaci&oacute;n!</td>
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
                                                                            Malas noticias!
                                                                            <br>Su pedido no pudo ser procesado por el sistema de pago! 
                                                                            <br>Por favor vuelva a intentar realozar el pago. 
                                                                            <br>Si vuelve a fallar, por favor comuniquela al <a href="contacto.php">encargado</a>.
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
                                                                                        <a href="confirmarCarrito.php?action=terminar">Volver a intentar...</a>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>            
                                                                        </td>
                                                                    </tr>
                                                                </table>    
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <?php } ?>
                                                </TD>
                                            </TR>
                                        </TBODY>
                                    </TABLE>
                                    <!-- new_products_eof //-->
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
