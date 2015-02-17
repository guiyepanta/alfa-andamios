<?php
session_start();
if ($_SESSION["autorizacion_LoginSN"]==0)
    Header("Location: fuera.htm");

$Ubi=$_GET["ubi"];
if ($Ubi==0)
{
    $Ubicacion="Banner Cabecera";
    $NombreArchivo="header.swf";
}
else if ($Ubi==1)
{
    $Ubicacion="Banner Central";
    $NombreArchivo="banner.swf";
}
else if ($Ubi==2)
{
    $Ubicacion="Banner menu Iaquierdo";
    $NombreArchivo="banner_210.swf";
}
else if($Ubi==3)
{
    $Ubicacion="Banner Cuerpo 01";
    $NombreArchivo="banner_180_01.swf";
}
else if($Ubi==4)
{
    $Ubicacion="Banner Cuerpo 02";
    $NombreArchivo="banner_180_02.swf";
}
else if($Ubi==5)
{
    $Ubicacion="Banner Cuerpo 03";
    $NombreArchivo="banner_180_03.swf";
}


if ($_POST["Accion"]=="Cargar")
{
    $error="";					
    if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
       	if($_FILES['archivo']['size'] < 205000)
    	{
	        if($_FILES['archivo']['type']=="application/x-shockwave-flash")
	        {
	            copy($_FILES['archivo']['tmp_name'], "../swf/" .$_FILES['archivo']['name']);
	            $Imagen = "../swf/" . $_FILES['archivo']['name'];
	            $error="Y";				
	            rename("../swf/" . $_FILES['archivo']['name'], "../swf/". $NombreArchivo);
	        }
	        else{$error = "N";}
	    }
	    else{$error = "G";}
     }


    if ($error == "Y"){$mensaje = '<script name="accion">alert("El banner se subio con exito...") </script>'; echo $mensaje;}
    if ($error == "N"){$mensaje = '<script name="accion">alert("El formato de archivo no permitido") </script>'; echo $mensaje;}
	if ($error == "G"){$mensaje = '<script name="accion">alert("La imagen exede el limite de tamaño permitido") </script>'; echo $mensaje;}
}

?>
<HTML>
    <HEAD>
        <TITLE>Subir Banners</TITLE>

        <META http-equiv=Content-Type content="text/html; charset=windows-1252">
        <META content="MSHTML 6.00.2900.2627" name=GENERATOR>
		<meta http-equiv="Page-Exit" content="revealTrans(Duration=2.0,Transition=23)">
		<link href="Estilos/style.css" rel="stylesheet" type="text/css">
    </HEAD>


<BODY bgColor="#ffffff">
<DIV align=center>
<BR>
<TABLE cellSpacing=0 width="85%" border="1">
	<TBODY>
	<TR>
		<TD align=middle><!--Cuerpo de Administración-->

			<FORM method="POST" action="Subir.php?ubi=<?php echo $Ubi; ?>" enctype="multipart/form-data" name="form1">
			<TABLE cellSpacing=0 width="100%" border="0">
				<TR>
					<TD>
						<table border="0" width="100%"  cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td bgcolor="#c8e4ff" class="bordecelda" align="center">
									<table border="0" CELLPADDING="0" CELLSPACING="0" >
										<tr><td align="right">Ubicación: <b><?php echo $Ubicacion;?></b></td></tr>
										<tr><td align="left">Seleccionar Banner:</td></tr>
										<tr><td ><img src="imagenes/pixel_clear.gif" height="10"></td></tr>
	    								<tr><td align="left"><input name="archivo" type="file" id="archivo" SIZE=75></td></tr>
										<tr><td ><img src="imagenes/pixel_clear.gif" height="10"></td></tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<TR>
					<TD valign=top>
						<table border="0" CELLPADDING="0" CELLSPACING="0" width="100%">
							<tr><td align="left"><img src="imagenes/pixel_clear.gif" height="10"></td></tr>
							<tr><td align="left"><img src="imagenes/icon_atencion.gif">El nombre del banner es indiferente, el sistema se encargará de renombrarlo segun su ubicación.</td></tr>
							<tr><td align="left"><img src="imagenes/icon_atencion.gif">Los banners en ningún caso pueden superar los 200 kb </td></tr>
							<tr><td align="left"><img src="imagenes/pixel_clear.gif" height="10"></td></tr>
							<tr><td align="left">Formatos compatibles:&nbsp;&nbsp;<b>SWF</b></td></tr>
						</table>
					</TD>

				</TR>

                <TR>
					<TD bgcolor=slategray height=1>
					</TD>
				</TR>
				<TR>
					<TD align=right bgcolor="#f2f2f2">
						<BR><INPUT type="submit" value="Cargar" id="Accion" name="Accion" style="FONT-WEIGHT: bold">&nbsp;&nbsp;&nbsp;<INPUT type="reset" value="Limpiar datos" id=reset1 name=reset1>&nbsp;&nbsp;
					</TD>
				</TR>
			</TABLE>
			</FORM><!--Fin del Cuerpo-->
		</TD>
	</TR>
</TBODY>
</TABLE>
</DIV>
<BR><P>
<CENTER>
    <B><A href="Sel_Ubica.htm"><FONT size=6><< Volver</FONT></a></B>
</CENTER>
</BODY>
</HTML>