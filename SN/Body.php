<?php
session_start();
if ($_SESSION["autorizacion_LoginSN"]==0)
    Header("Location: fuera.htm");

   

?>

<!-- Sitio dise�ado y programado por Studio Quatro � -->
<!-- Visitenos en www.studioquatro.webrapida.com -->
<!-- todos los derechos reservados -->
<html>
<head>
<meta http-equiv="Page-Exit" content="revealTrans(Duration=2.0,Transition=23)">
<style>
BODY {
	SCROLLBAR-FACE-COLOR: #ebebeb; SCROLLBAR-HIGHLIGHT-COLOR: #ffcc00; SCROLLBAR-SHADOW-COLOR: #ffdd00; SCROLLBAR-3DLIGHT-COLOR: #ffBB00; SCROLLBAR-ARROW-COLOR: #5888b8; SCROLLBAR-TRACK-COLOR: #ffffff; SCROLLBAR-DARKSHADOW-COLOR: GREY
}
</style>


</head>
<BODY bgcolor=#ffffff>
<BR><P><BR><P><BR><P>
<TABLE width=600 border=0 cellpadding=0 cellspacing=0 align=center>
	<TR>
		<TD width=100% valign=middle>
			<TABLE width=100% border=1 cellpadding=0 cellspacing=0 bordercolor=SteelBlue align=center>
				<TR>
					<TD align=center>
						<BR><P>
						<BR><P>
					   <IMG src="imagenes/Logo_Stream.png" border=0>
					    <BR><BR><BR><P>
					    <BR><P>
					</TD>
				</TR>
			</TABLE>
		</TD>
	</TR>
    <TR>
		<TD align=Right><IMG src="imagenes/Powered.gif" border=0></TD>
   </TR>
</TABLE>
<?php
	if ($_GET["msg"]=="true")
    {
    	$mensaje = '<script name="accion">alert("La Nota se ha modifiado con exito") </script>';
        echo $mensaje;
    }
?>

</BODY>
</html>