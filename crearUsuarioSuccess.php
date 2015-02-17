<?php
	$Accion = $_POST["action"];
	include_once("conexion.php");
	include_once("clases/Utils.php");
	if ($Accion == "process")
	{
	    $editMode=$_POST["editMode"];
	    
	    
	    $mail = $_POST["txtMail"];
		$nombre = $_POST["txtNombre"];
		$apellido = $_POST["txtApellido"];    
        $empresa = $_POST["txtEmpresa"];        
        $identificacion = $_POST["txtIdent"];    
		$telefono = $_POST["txtTelefono"];	
		$direccion = $_POST["txtDomicilio"];
		$codPostal = $_POST["txtCodigoPostal"];	
		$ciudad = $_POST["txtCiudad"];	
		$pais = $_POST["txtPais"];			
		$clave = mc_encrypt($_POST["txtClave"], "Optimus");	
		
		if ($editMode=="true")
		{
			$idUsuario=$_COOKIE["idUsuario"];
			$claveActual = $clave = mc_encrypt($_POST["txtClaveActual"], "Optimus");
			$sql="SELECT idCliente, nombre, apellido FROM clientesportal WHERE idCliente = '". $idUsuario ."' AND clave = '". $claveActual ."' AND estado=1";
			$result = mysql_query($sql, $link);	
			$error = mysql_errno($link) . ":" . mysql_error($link);
	
			if(mysql_num_rows($result)>0){
				$sql = "UPDATE clientesportal SET nombre='$nombre',apellido='$apellido',direccion='$direccion',codigoPostal='$codPostal',ciudad='$ciudad',pais='$pais',telefonos='$telefono',empresa='$empresa', identificacion='$identificacion', clave='$clave' WHERE idCliente='$mail'";
				mysql_query($sql, $link);			
			} else {
				echo "Los datos de Seguridad no son los correctos...";
			}
			
		}
		else
		{
			$sql = "INSERT INTO clientesportal VALUES('$mail','$nombre','$apellido','$direccion','$codPostal','$ciudad','$pais','$telefono','$clave','$empresa', '$identificacion', 1)";
			mysql_query($sql, $link);
			$error = mysql_errno($link) . ":" . mysql_error($link);			 	
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
                <div class="center_content" style="font-size: 10px;">		
					<?php if($error == "0:") { ?>
					    
						<div class='center_title_bar'>Su cuenta ha sido creada!</div>
                        <br/>
                        <table cellpadding="0" cellspacing="0" border="0">
							<tr>
							    <td class="padd_1">
							        <table cellpadding="0" cellspacing="0" border="0" style="margin:0px 10px 0px 0px;">
							            <tr>
							                <td align="center"><img src="images/ok.png" border="0" alt="Su cuenta ha sido creada!" title=" Su cuenta ha sido creada! " width="150" height="150"></td>
							                <td class="main" style="color: #666666; font-size: 12px; padding: 30px 0 0; width: 100%;">Enhorabuena! Su cuenta ha sido creada con &eacute;xito! <br>Ya puede ingresar a su cuenta y disfrutar la ventaja de ver, y realizar pedidos de nuestro catalogo desde la comodidad de su hogar. <br><br>Si tiene <small><b>cualquier</b></small> pregunta sobre el funcionamiento del sitio, por favor comuniquela al <a href="contacto.php">encargado</a>. <br /><br />Muchas Gracias.</td>
							            </tr>
							        </table>
							        <div style="padding:0px 0px 9px 0px;"><img src="images/spacer.gif" border="0" alt="" width="1" height="1"></div>
							        <table cellpadding="0" cellspacing="5" border="0">
							            <tr>
							                <td>
							                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
							                        <tr>
							                            <td align="right"><a href="index.php"><img src="images/btnContinuar.png" border="0" alt="Continuar" title=" Continuar " height="15"></a></td>
							                        </tr>
							                    </table>
							                </td>
							            </tr>
							        </table>
						        </td>
							</tr>
						</table>																				
								
					<?php } else { ?>	
					    							
						<div class='center_title_bar'>Su cuenta no pudo ser creada!</div>
                        <br/>
                        <table cellpadding="0" cellspacing="0" border="0">
						    <tr>
						        <td class="padd_1">
						            <table cellpadding="0" cellspacing="0" border="0" style="margin:0px 10px 0px 0px;">
						                <tr>
						                    <td align="center"><img src="images/atencion.gif" border="0" alt="Su cuenta no ha sido creada!" title=" Su cuenta no ha sido creada! " width="150" height="150"></td>
						                    <td class="main" style="color: #666666; font-size: 12px; padding: 30px 0 0; width: 100%;">Perdone las molestias ocasionadas! Su cuenta no ha sido creada debido a un error interno. Por favor intente nuevamente m&aacute;s tarde, si el error persiste por favor comuniquelo al <a href="contacto.php">encargado</a>.</td>
						                </tr>
						            </table>
						            <div style="padding:0px 0px 9px 0px;"><img src="images/spacer.gif" border="0" alt="" width="1" height="1"></div>
						            <table cellpadding="0" cellspacing="5" border="0">
						                <tr>
						                    <td>
						                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
						                            <tr>
						                                <td align="right"><a href="index.php"><img src="images/btnContinuar.png" border="0" alt="Continuar" title=" Continuar " width="73" height="28"></a></td>
						                            </tr>
						                        </table>
						                    </td>
						                </tr>
						            </table>
						        </td>
						    </tr>
						</table>
						
					<?php } ?>
					<!-- end of center content -->
				</div>
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