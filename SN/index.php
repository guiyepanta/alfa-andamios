<?PHP
    session_start();
    $MSG=$_GET["MSG"];
    if ($MSG == "Salir")
    {
        $_SESSION["autorizacion_LoginSN"] = "";
        Header("Location: index.php");
    }
    
    $usuario = str_replace("", " ",$_POST["txtUser"]);
    $password = $_POST["txtPass"];
    if ($usuario!="")
    {
        include ("conexion.php");
        $sql="SELECT * FROM usuarios where USUARIO = '". $usuario ."' and CLAVE = '". $password ."'";
        $result = mysql_query($sql, $link);
        
        if(mysql_num_rows($result)==0)
        {
            $_SESSION["autorizacion_LoginSN"] = "";
            Header("Location: index.php?MSG=false");
            mysql_close($link);
        }
        else
        {
        
            $array=mysql_fetch_array($result);
            
            $nombreUsuario = $array["NOMBRE_APELLIDO"];
            
            setcookie("Nombre_Usuario", $nombreUsuario);
            $_SESSION["autorizacion_LoginSN"] = 1;
            header("location: PanelControl.php");
        } /* Cerramos el else que corresponde a la comprobaci�n de que el login existe */
    
    }
    
?>
<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>Sistema Administrativo - Login</title>
		<link href="Estilos/estilosGenerales.css" type="text/css" rel="stylesheet" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
	<body bgcolor="#ffffff" topmargin="20" leftmargin="0">
		<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" height="600px">
			<tr>
				<td valign="middle" align="center" width="100%" height="100%">
					<!------------------ RECUADRO ------------------->
					<table border="0" cellpadding="0" cellspacing="0" align="center">
						<tr>
							<td width="9"><img src="imagenes/recsupiz.jpg" border="0" WIDTH="9" HEIGHT="10"></td>
							<td background="imagenes/recsup.jpg"><img src="imagenes/recsup.jpg" border="0" WIDTH="9" HEIGHT="10"></td>
							<td width="13"><img src="imagenes/recsupde.jpg" border="0" WIDTH="13" HEIGHT="10"></td>
						</tr>
						<tr>
							<td width="9" background="imagenes/reciz.jpg"><img src="imagenes/reciz.jpg" border="0" WIDTH="9" HEIGHT="10"></td>
							<td valign="middle">
								<!----- CONTENIDO ----->
								<table border="0">
									<tr>
										<td><img src="imagenes/Logo_Stream.png" border="0" ></td>
									</tr>
									<tr>
										<td height="10"></td>
									</tr>
									<tr>
										<td>
											<form name="frmLogin" method="post" action="index.php" id="frmLogin">
											<!-------- FORMULARIO LOGIN -------->
											    <table border="0">
												    <tr>
													    <td align="center" width="150"><img src="imagenes/llaves1.jpg" border="0" WIDTH="118" HEIGHT="115"></td>
													    <td>														
															<table border="0" cellpadding="0" cellspacing="0" width="200">
																<tr>
																	<td>
																		<table border="0" width="100%" cellpadding="0" cellspacing="0">
																			<tr>
																				<td width="24"><img src="imagenes/formfle.jpg" border="0" WIDTH="24" HEIGHT="25"></td>
																				<td width="42"><img src="imagenes/formtxlogin.jpg" border="0" WIDTH="42" HEIGHT="25"></td>
																				<td width="26"><img src="imagenes/formcap.jpg" border="0" WIDTH="26" HEIGHT="25"></td>
																				<td background="imagenes/formfdocap.jpg"><img src="imagenes/formfdocap.jpg" border="0" WIDTH="7" HEIGHT="25"></td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td>
																		<table border="0" width="100%" cellpadding="0" cellspacing="0">
																			<tr>
																				<td background="imagenes/formiz.jpg" width="3"><img src="imagenes/formiz.jpg" border="0" WIDTH="3" HEIGHT="30"></td>
																				<td>
																					<!-- FOMULARIO -->
																					<table border="0" width="100%" cellpadding="0" cellspacing="0">
																						<tr>
																							<td background="imagenes/formfdofields.jpg" width="20"></td>
																							<td background="imagenes/formfdofields.jpg" align="right"><font class="titulo">Usuario:</font></td>
																							<td background="imagenes/formfdofields.jpg" width="8"></td>
																							<td background="imagenes/formfdofields.jpg" align="left">
																								<input name="txtUser" type="text" id="txtUser" class="cuadrotexto" style="width:100px;" />
																							</td>
																						</tr>
																						<tr>
																							<td background="imagenes/formdivmed.jpg" height="2" align="right"><img src="imagenes/formdivmed.jpg" width="1" height="2"></td>
																							<td background="imagenes/formdivmed.jpg" height="2" align="right"><img src="imagenes/formdivmed.jpg" width="1" height="2"></td>
																							<td background="imagenes/formdivmed.jpg" height="2" width="8"><img src="imagenes/formdivmed.jpg" width="1" height="2"></td>
																							<td background="imagenes/formdivmed.jpg" height="2" align="left"><img src="imagenes/formdivmed.jpg" width="1" height="2"></td>
																						</tr>
																						<tr>
																							<td background="imagenes/formfdofields.jpg" width="20"></td>
																							<td background="imagenes/formfdofields.jpg" align="right"><font class="titulo">Password:</font></td>
																							<td background="imagenes/formfdofields.jpg" width="8"></td>
																							<td background="imagenes/formfdofields.jpg" align="left">
																								<input name="txtPass" type="password" id="txtPass" class="cuadrotexto" style="width:100px;" />
																							</td>
																						</tr>
																						<tr>
																							<td background="imagenes/formdivmed.jpg" height="2" align="right"><img src="imagenes/formdivmed.jpg" width="1" height="2"></td>
																							<td background="imagenes/formdivmed.jpg" height="2" align="right"><img src="imagenes/formdivmed.jpg" width="1" height="2"></td>
																							<td background="imagenes/formdivmed.jpg" height="2" width="8"><img src="imagenes/formdivmed.jpg" width="1" height="2"></td>
																							<td background="imagenes/formdivmed.jpg" height="2" align="left"><img src="imagenes/formdivmed.jpg" width="1" height="2"></td>
																						</tr>
																						<tr>
																							<td align="center" colspan="4" background="imagenes/formfdofields.jpg">
																								<table border="0">
																									<tr>
																										<td>
																											<input type="submit" name="cmdLogin" value="Ingresar" id="cmdLogin" class="boton" style="width:90px;" />
																										</td>
																									</tr>
																								</table>
																							</td>
																						</tr>
																						<tr>
																							<td background="imagenes/formdivfin.jpg" height="2" align="right"><img src="imagenes/formdivfin.jpg" width="1" height="2"></td>
																							<td background="imagenes/formdivfin.jpg" height="2" align="right"><img src="imagenes/formdivfin.jpg" width="1" height="2"></td>
																							<td background="imagenes/formdivfin.jpg" height="2" width="8"><img src="imagenes/formdivfin.jpg" width="1" height="2"></td>
																							<td background="imagenes/formdivfin.jpg" height="2" align="left"><img src="imagenes/formdivfin.jpg" width="1" height="2"></td>
																						</tr>
																					</table>
																					<!-- FOMULARIO -->
																				</td>
																				<td background="imagenes/formde.jpg" width="2"><img src="imagenes/formde.jpg" border="0" WIDTH="2" HEIGHT="30"></td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>															
													    </td>
												    </tr>
												    <tr>
													    <td vAlign="middle" align="center" height="30" colspan="2">
															<?PHP
																if ($MSG=="false")
																{
																	echo '<span id="lblMsg" style="display:inline-block;color:Red;font-family:Arial;font-size:Medium;font-weight:normal;width:100%;">Error: Los datos ingresados son incorrectos</span>';																
																}
																else if ($MSG=="denegado")
																{
																	echo '<span id="lblMsg" style="display:inline-block;color:Red;font-family:Arial;font-size:Medium;font-weight:normal;width:100%;">Error: Acceso Denegado. Por Favor Logueese !!!</span>';
																}
															?>														    
													    </td>
												    </tr>
											    </table>
											<!------ FIN FORMULARIO LOGIN ------>
											</form>
										</td>
									</tr>
								</table>
								<!--- FIN CONTENIDO --->
							</td>
							<td width="13" background="imagenes/recde.jpg"><img src="imagenes/recde.jpg" border="0" WIDTH="13" HEIGHT="10"></td>
						</tr>
						<tr>
							<td width="9"><img src="imagenes/recinfiz.jpg" border="0" WIDTH="9" HEIGHT="15"></td>
							<td background="imagenes/recinf.jpg"><img src="imagenes/recinf.jpg" border="0" WIDTH="13" HEIGHT="15"></td>
							<td width="13"><img src="imagenes/recinfde.jpg" border="0" WIDTH="13" HEIGHT="15"></td>
						</tr>
					</table>
					<!----------------- FIN RECUADRO ----------------->
				</td>
			</tr>
		</table>
		<script language="javascript">
	        document.frmLogin.txtUser.focus();
		</script>
	</body>
</html>
