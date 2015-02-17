<?PHP
	session_start();
	
	if($_SESSION["autorizacion_Login"] != "")
		header("location: index.php");
	
	include_once("conexion.php");
	include_once("clases/Utils.php");
	
	//echo mc_decrypt("VwDtPpw+R7yC3rjJ7jMxzbN3LFDKahb1eI/CaRBK9ns=", "Optimus");
	
	$action = $_POST["action"];		
	$error = false;
	if ($action == "ingresar")
	{
		$usuario = $_POST["txtUsuario"];
		$password = $_POST["txtClave"];
		if ($password != "")
			$password = mc_encrypt($password, "Optimus");        
			
		$sql="SELECT idCliente, nombre, apellido FROM clientesportal WHERE idCliente = '". $usuario ."' AND clave = '". $password ."' AND estado=1";
		$result = mysql_query($sql, $link);	
		//$error = mysql_errno($link) . ":" . mysql_error($link);

		if(mysql_num_rows($result)==0)
		{
		    $_SESSION["autorizacion_Login"] = "";
		  	$error = true;
		}
		else
		{		
			$array=mysql_fetch_array($result);
			$idUsuario = $array["idCliente"];
			$nombreUsuario = $array["nombre"] . ", " . $array["apellido"];
            
			setcookie("idUsuario", $idUsuario);
			setcookie("nombreUsuario", $nombreUsuario);
			$_SESSION["autorizacion_Login"] = 1;
			//Compruebo pedidos sin terminar
			$sql="SELECT idPedido FROM pedidos WHERE usuario = '$idUsuario' AND estado=1";
            $resPedido = mysql_query($sql, $link); 
            if(mysql_num_rows($resPedido)!=0) {       
    			$array=mysql_fetch_array($resPedido);            
    			$_SESSION["idPedido"] = $array["idPedido"];                
    		} 
    		
            header("location: index.php");
        }
		/* Cerramos el else que corresponde a la comprobaci n de que el login existe */	
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
        <script src="http://malsup.github.io/jquery.blockUI.js"></script>       
        <script type="text/javascript" src="js/boxOver.js"></script>
        <script src="js/login.js"></script>
        <script src="js/utils.js"></script>
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
                	<form name="login" action="login.php" method="post">	
						<input type="hidden" value="ingresar" name="action">
	                    <div class="width_100">	
							<div class='center_title_bar'>Ingresar al Sitio!</div>
							<br/>						
							<table cellpadding="0" cellspacing="0" border="0" style="margin-left: 5px; padding: 10px;">
								<?php if ($error == true) { ?>
								<tr>
							        <td>
							        	<table border="0" width="100%" cellspacing="0" cellpadding="0">
										  <tr class="messageStackError">
										    <td class="messageStackError"><img src="images/error.gif" border="0" alt="Error" title=" Error " width="10" height="10">&nbsp;El E-mail o Contrase&ntilde;a no son correctos o no pertenecen a una cuenta activa.</td>
										  </tr>
										</table>
									</td>
							    </tr>
							    <?php } ?>
								<tr>
									<td class="padd_1"> 
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
							          		<tr>
							            		<td class="main" width="50%"><b>Nuevo Cliente</b></td>
												<td><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
							            		<td class="main" width="50%"><b>Ya Soy Cliente</b></td>
							          		</tr>
							         		<tr>
							           	 		<td width="50%" height="100%">																								
													<div class="content_login">
														<table border="0" width="100%" height="100%" cellspacing="5" cellpadding="0" style="height:240px;">
										                  <tr>
										                    	<td><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="10"></td>
										                  </tr>
										                  <tr>
										                    	<td class="main" style="height:100%;">Soy un nuevo cliente.<br><br>Al crear una cuenta en este sitio podr&aacute; realizar sus compras <b>Online</b> rapidamente</td>
										                  </tr>
										                  <tr>
										                    	<td><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="10"></td>
										                  </tr>
										                  <tr>
										                    	<td>
										                    		<table border="0" width="100%" cellspacing="0" cellpadding="2">
											                     	<tr>
											                        		<td width="10"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
											                       		<td align="right"><a href="crearUsuario.php"><img src="images/btnContinuar.png" border="0" alt="Continuar" title=" Continuar " height="15"></a></td>
											                        		<td width="10"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
										                      		</tr>
										                    		</table>
										                    	</td>
										                  </tr>
										              </table>
													</div>
												</td>
												<td><img src="images/pixel_trans.gif" border="0" alt="" width="1" height="1"></td>
										         <td width="50%" height="100%">																								
													<div class="content_login">
														<table border="0" width="100%" height="100%" cellspacing="5" cellpadding="0" style="height:240px;">
											                <tr><td><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="10"></td></tr>
											                <tr> <td class="main" colspan="2">Tengo una cuenta activa.</td></tr>
											                <tr><td><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="10"></td></tr>
											                <tr><td class="main"><b>E-Mail:</b></td></tr>
											                <tr><td class="main"><input type="text" name="txtUsuario"></td></tr>
											                <tr><td class="main"><b>Contrase&ntilde;a:</b></td></tr>
													    	<tr><td class="main"><input type="password" name="txtClave" maxlength="40"></td></tr>
													    	<tr><td colspan="2"><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="10"></td></tr>
													    	<tr><td class="smallText"><a href="#" class="recuest_account_link">&iquest;Ha olvidado su clave? Siga este enlace y se la enviamos.</a></td></tr>
													    	<tr><td><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="10"></td></tr>
											                <tr><td>
											                  	<table border="0" width="100%" cellspacing="0" cellpadding="2">
											                      <tr>
											                        <td width="10"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
											                        <td align="right"><input type="image" src="images/btnEntrar.png" border="0" alt="Entrar" height="15" title=" Entrar "></td>
											                        <td width="10"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
											                      </tr>
											                    </table>
											                  </td>
											                </tr>
										             	</table>
													</div>
												</td>
											</tr>
									 	</table>																					
									</td>
								</tr>
							</table>      		
						</div>
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