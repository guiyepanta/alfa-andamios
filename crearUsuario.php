<?php
    session_start();
    
    $editMode = $_GET["editMode"];
    if ($editMode != "true")
    	if($_SESSION["autorizacion_Login"] != "")
    		header("location: index.php");
    
    include_once("conexion.php");
    include_once("clases/Utils.php");
    
    $mail = "";
    $nombre = "";
    $apellido = "";	
    $empresa = "";
    $identificacion = "";	
    $telefono = "";	
    $direccion = "";
    $codPostal = "";	
    $ciudad = "";	
    $pais = "";
    
    $idLinea = $_GET["id"];
    $nueva = "";
    if ($editMode=="true")
    {
    	$userId = $_GET["user"];
    	
    	$nueva = "nueva";
    	
    	$sql = "SELECT idCliente, nombre, apellido, direccion, codigoPostal, ciudad, pais, telefonos, empresa, identificacion FROM clientesportal WHERE idCliente='".$userId."'";
    	$result = mysql_query($sql, $link);	
    	$error = mysql_errno($link) . ":" . mysql_error($link);
    
    	if(mysql_num_rows($result) > 0)
    	{		  	
    		$array=mysql_fetch_array($result);
    		
    		$mail = $array["idCliente"];
    		$nombre = $array["nombre"];
    		$apellido = $array["apellido"];	
    		$empresa = $array["empresa"];	
    		$telefono = $array["telefonos"];
            $identificacion = $array["identificacion"]; 	
    		$direccion = $array["direccion"];
    		$codPostal = $array["codigoPostal"];	
    		$ciudad = $array["ciudad"];	
    		$pais = $array["pais"];
    	} 
    }
    
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
		<script type=text/javascript src="js/utils.js" />
        <script>
            $(document).ready(function() { 
                $('.prod_details').click(function(event) { 
                	var target = $(event.target);
                	var idPrd = target.attr('data-id-prd');
                    $.blockUI({
                			message: '<h1>This has been blocked!</h1>',
                			css: { border: '3px solid #a00' }
            		});
            		var postData = {
            	        "idProducto" : idPrd,
            	    };
            		$.ajax({
                        url: 'details.php',
                        type: 'POST',
                        data: postData,
                        success: function (data) {
                            $.blockUI({
                            	message: data ,
                				css: { border: '3px solid #ccc', left: '25%', top: '25%', width: '625px'}
                			});
                        },
                        complete: function() {
                            $('.btn_close').click(function() {
                            	$.unblockUI();
                            });
                        },
                        error: function () {
                            $.unblockUI();
                        }
                    });
                }); 
            }); 
        </script>
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
                    <form method=post id='create_account' name='create_account' action='crearUsuarioSuccess.php'>
                        <INPUT name='action' id='action' value='process' type=hidden>
                        <INPUT name='editMode' id='editMode' value='<?php echo $editMode; ?>' type=hidden>
                        <div class='center_title_bar'>Datos de mi Cuenta</div>
                        <br/>
                        <TABLE border=0 cellSpacing=0 cellPadding=0 style="margin-left: 5px; padding: 10px;">
                            <TBODY>
                                <TR>
                                    <TD class=padd_1>
                                        <?php
                                        if ($editMode!="true") {
                                        ?>
                                        <TABLE border=0 cellSpacing=0 cellPadding=0>
                                            <TBODY>
                                                <TR>
                                                    <TD class=smallText>
                                                        <BR>
                                                        <FONT color=#ff0000><SMALL><B>NOTA:</B></SMALL></FONT> 
                                                        Si ya ha pasado por este proceso y tiene una 
                                                        cuenta, por favor 
                                                        <A href="login.php"><U><FONT color=#00aa00>entre</FONT></U></A> en ella.
                                                    </TD>
                                                </TR>
                                                <TR>
                                                    <TD><IMG border=0 alt="" src="images/pixel_trans.gif" width="100%" height=10></TD>
                                                </TR>
                                            </TBODY>
                                        </TABLE>
                                        <?php
                                        }
										?>
                                        <TABLE border=0 cellSpacing=0 cellPadding=2 width="100%">
                                            <TBODY>
                                                <TR>
                                                    <TD class=main><B>Datos Personales</B></TD>
                                                    <TD class=inputRequirement align=right>
                                                        Contador de Caracteres: <input type="text" name="count" size="2" readonly>
                                                    </TD>
                                                </TR>
                                            </TBODY>
                                        </TABLE>
                                        <div class="content_login spacer">
                                            <TABLE border=0 cellSpacing=4 cellPadding=2>
                                                <TBODY>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Nombre:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtNombre onKeyUp='validaCantidadChar(this,25);' value="<?php echo $nombre; ?>">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Apellidos:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtApellido onKeyUp='validaCantidadChar(this,25);' value="<?php echo $apellido; ?>">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <?php
                                                        if ($editMode=="true") {
                                                        ?>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>E-Mail:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <input name=txtMail value="<?php echo $mail; ?>" type="hidden" >
                                                            <input name=txtMailview value="<?php echo $mail; ?>" disabled="disabled" >&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                            <input name=txtConfirmaMail value="<?php echo $mail; ?>" disabled="disabled" style="visibility:hidden">
                                                        </TD>
                                                    </TR>
                                                    <?php } else { ?>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>E-Mail:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtMail onKeyUp='validaCantidadChar(this,50);' value="<?php echo $mail; ?>">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Canfirma E-Mail:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtConfirmaMail onKeyUp='validaCantidadChar(this,50);'>&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <?php } 
                                                    if ($editMode=="true") {
                                                    ?>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Clave actual:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name="txtClaveActual" onKeyUp='validaCantidadChar(this,12);' type="password">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <?php } ?>
                                                </TBODY>
                                            </TABLE>
                                        </div>
                                        <TABLE border=0 cellSpacing=0 cellPadding=2 width="100%">
                                            <TBODY>
                                                <TR>
                                                    <TD class=main><B>Datos de Facturaci&oacute;n</B></TD>
                                                </TR>
                                            </TBODY>
                                        </TABLE>
                                        <div class="content_login spacer">
                                            <TABLE border=0 cellSpacing=4 cellPadding=2>
                                                <TBODY>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Razon social:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtEmpresa onKeyUp='validaCantidadChar(this,50);' value="<?php echo $empresa; ?>">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>                                                    
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>DNI/CUIT:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtIdent onKeyUp='onlyNumbers(this);' value="<?php echo $identificacion; ?>" maxlength=11>&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                            <br><span style="color:#6E899D; font-size: 11px;">Sin puntos (.), espacios y guiones (-)</span>
                                                        </TD>
                                                    </TR>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Confirmar DNI/CUIT:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtConfirmIdent onKeyUp='onlyNumbers(this);' value="<?php echo $identificacion; ?>" maxlength=11>&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Telefono:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtTelefono onKeyUp='validaCantidadChar(this,30);' value="<?php echo $telefono; ?>">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Domicilio:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtDomicilio onKeyUp='validaCantidadChar(this,50);' value="<?php echo $direccion; ?>">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Codigo Postal:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtCodigoPostal onKeyUp='validaCantidadChar(this,15);' value="<?php echo $codPostal; ?>">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Ciudad - Provincia:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtCiudad onKeyUp='validaCantidadChar(this,50);' value="<?php echo $ciudad; ?>">&nbsp;<SPAN class=inputRequirement>* (ej: Junin - Buenos Aires)</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Pais:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtPais onKeyUp='validaCantidadChar(this,30);' value="<?php echo $pais; ?>">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                </TBODY>
                                            </TABLE>
                                        </div>
                                        <TABLE border=0 cellSpacing=0 cellPadding=2 width="100%">
                                            <TBODY>
                                                <TR>
                                                    <TD class=main><B>Contrase&ntilde;a</B></TD>
                                                </TR>
                                            </TBODY>
                                        </TABLE>
                                        <div class="content_login spacer">
                                            <TABLE border=0 cellSpacing=4 cellPadding=2>
                                                <TBODY>                                                    
                                                    <TR>
                                                        <TD class="main b_width"><STRONG><?php echo $nueva; ?> Clave:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT id='txtClave' name='txtClave' onKeyUp='validaCantidadChar(this,12);' type="password">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                    <TR>
                                                        <TD class="main b_width"><STRONG>Confirma <?php echo $nueva; ?>  Clave:</STRONG></TD>
                                                        <TD class="main width2_100">
                                                            <INPUT name=txtConfirmaClave onKeyUp='validaCantidadChar(this,12);' type="password">&nbsp;<SPAN class=inputRequirement>*</SPAN>
                                                        </TD>
                                                    </TR>
                                                </TBODY>
                                            </TABLE>
                                        </div>
                                        <TABLE border=0 cellSpacing=5 cellPadding=0 width="100%">
                                            <TBODY>
                                                <TR>
                                                    <TD>
                                                        <TABLE border=0 cellSpacing=0 cellPadding=2 width="100%">
                                                            <TBODY>
                                                                <TR>
                                                                    <TD class=inputRequirement align=left>* Dato Obligatorio</TD>
                                                                    <TD align="right">
                                                                        <input onclick='check_form()' type=button style="background: url('images/btnContinuar.png') no-repeat; border: none; cursor: pointer; width: 70px; float: right;">
                                                                    </TD>
                                                                </TR>
                                                            </TBODY>
                                                        </TABLE>
                                                    </TD>
                                                </TR>
                                            </TBODY>
                                        </TABLE>
                                        <!-- new_products_eof //-->
                                    </TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                    </form>
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
 