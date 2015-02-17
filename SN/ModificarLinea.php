<?php
session_start();
if ($_SESSION["autorizacion_LoginSN"]==0)
    Header("Location: fuera.htm");

$idlinea = $_GET["idLinea"];
$indice = $_GET["ind"];
$Accion = $_POST["Accion"];
include ("conexion.php");
if ($Accion == "Cargar")
{
    $titu = $_POST["txtTitulo"];
	$orden = $_POST["txtOrden"];
	$estado = $_POST["cmbEstado"];

    
    if($titu != "" && $orden != "")
	{
 		if ($idlinea != "0")
 			$sql = "UPDATE lineas SET titulo='$titu', orden='$orden', idestado=$estado WHERE idlinea=$idlinea";
 		else
			$sql = "INSERT INTO lineas (titulo, orden, idestado) VALUES ('$titu','$orden', $estado)";
	    
	    $result = mysql_query($sql);
		$titu = "";
		$orden = "";		
		echo '<script name="accion">alert("Los datos se cargaron con exito!"); setInterval(\'window.location.href="EditarLineas.php"\', 1000) </script>';
    }
    else
    {
        if ($titu == ""){$mensaje = '<script name="accion">alert("Debe ingresar un TITULO") </script>'; echo $mensaje;}
		if ($orden == ""){$mensaje = '<script name="accion">alert("Debe ingresar un ORDEN") </script>'; echo $mensaje;}		
    }
}
else
{
	if ($idlinea != "0"){
		$item_result = mysql_query("SELECT idlinea, titulo, orden, idestado FROM lineas where idlinea = " . $idlinea, $link);
	
		if(mysql_num_rows($item_result) != 0)
		{
			$array=mysql_fetch_array($item_result);
	
			$titu = $array["titulo"];
			$orden = $array["orden"];
			$estado = $array["idestado"];
		}
	}
}

?>
<HTML>
    <HEAD>
        <TITLE>Nuevo ITEM</TITLE>

        <META http-equiv=Content-Type content="text/html; charset=windows-1252">
        <META content="MSHTML 6.00.2900.2627" name=GENERATOR>
        <STYLE type=text/css>
			A {
				COLOR: #00608f; TEXT-DECORATION: none
			}
			A:hover {
				COLOR: Gold; TEXT-DECORATION: none
			}
		</STYLE>
		<script language="javascript">
		//-----------------------------------------------------------------------------------------------
		function validachar(que,carac) {
			if (que.value.length > carac)
			 {
				alert('Ha excedido los ' + carac + ' caracteres');
					que.value = que.value.substring(0,carac);
					que.focus()
			}
			que.form.count.value = parseInt(carac)-parseInt(que.value.length);
		}

		//-----------------------------------------------------------------------------------------------

			function validar(e)
            {
    			tecla = (document.all) ? e.keyCode : e.which;
    			if (tecla==8) return true; //Tecla de retroceso (para poder borrar)
    				patron = /\d/; //ver nota
    				te = String.fromCharCode(tecla);
    				return patron.test(te);
			}			

			function mLimpiarDatos()
			{
				setInterval('window.location.href="Editar_Items.php', 500);
			}


		</script>
		<SCRIPT src="Javascript/funciones.js"></SCRIPT>
		<link href="Estilos/style.css" rel="stylesheet" type="text/css">

    </HEAD>


<BODY bgColor="#ffffff">
<DIV align=center>
<BR>
<TABLE cellSpacing=0 width="95%" border="1" bgcolor="#f2f2f2">
	<TBODY>
    <tr>
    	<td style="padding: 5px 0 0 10px;"><h2><b>Nueva Linea</b></h2></td>
    </tr>
    <TR>
		<TD align=middle><!--Cuerpo de Administraci�n-->
			<FORM method="post" action="ModificarLinea.php?idLinea=<?php echo $idlinea; ?>&ind=<?php echo $indice; ?>" enctype="multipart/form-data" name="form1">
			<TABLE cellSpacing=0 width="100%" border="0">

				<TR>
					<TD align=center bgcolor="#c8e4ff" width=25%>
						<FONT color=steelblue size=2 Face=Arial>
						Fecha: <b><?php echo date("d/m/Y, H:m:s"); ?></b>
						</FONT>
					</TD>
					<TD align=left bgcolor="#c8e4ff">
						<input type="text" name="count" size="4" readonly>
						<FONT color=steelblue size=2 Face=Arial>
						<STRONG>Contador de Caracteres</STRONG>
						</FONT>
					</TD>
				</TR>
				<TR>
					<TD colspan=2 bgcolor=slategray height=1></TD>
				<TR>
					<TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=3 Face=Arial>
						<STRONG>Titulo</STRONG>
						</FONT>
					</TD>					
                 	<TD align=Left>
                        <?php echo "<INPUT id=txtTitulo name=txtTitulo onKeyUp='validachar(this,50);' style='WIDTH: 350px; HEIGHT: 22px' size=40 value='".$titu."'>"; ?>
						<BR><FONT color=red size=1 Face=Arial>(maximo 50 caracteres)</FONT>
					</TD>
				</TR>
				<TR>
					<TD colspan=2 bgcolor=slategray height=1></TD>
				</TR>
                <TR>
					<TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=3 Face=Arial><STRONG>Nro Orden</STRONG></FONT>
					</TD>
					<TD align=Left vAlign=top >
                    	<?php echo "<input name='txtOrden' type='text' id='txtOrden' value='" . $orden . "'>"; ?>
                    	<BR><FONT color=red size=1 Face=Arial>(nro. de orden en el Menu)</FONT>
					</TD>
				</TR>                
                <TR>
					<TD colspan=2 bgcolor=slategray height=1></TD>
				</TR>
				<TR>
					<td align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=4 Face=Arial><STRONG>Estado</STRONG></FONT>
					</td>
					<TD align=Left>
						<?php
							if ($estado=="1")
							{
                         		echo "<SELECT id=cmbEstado name=cmbEstado style='WIDTH: 150px'>";
                         		echo "<option value='1' selected>ACTIVO</option><option value='0'>INACTIVO</option>";
                        		echo "</SELECT>";
                        	} else {
                        		echo "<SELECT id=cmbEstado name=cmbEstado style='WIDTH: 150px'>";
                         		echo "<option value='1'>ACTIVO</option><option value='0' selected>INACTIVO</option>";
                        		echo "</SELECT>";
                        	}
                        ?>
                    </TD>                    
				</TR>                
                <TR>
					<TD colspan=2 bgcolor=slategray height=1></TD>
				</TR>
				<TR>
					<TD align=right colspan=2 bgcolor="#c8e4ff">
						<BR><INPUT type="submit" value="Cargar" id="Accion" name="Accion" style="FONT-WEIGHT: bold">&nbsp;&nbsp;&nbsp;<INPUT type="button" value="Limpiar datos" id=reset1 name=reset1 onClick="mLimpiarDatos()">&nbsp;&nbsp;
					</TD>
				</TR>
			</TABLE>			
			</FORM><!--Fin del Cuerpo-->
		</TD>
	</TR>
</TBODY>
</TABLE>
</DIV>
</BODY>
</HTML>