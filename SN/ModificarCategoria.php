<?php
session_start();
if ($_SESSION["autorizacion_LoginSN"]==0)
    Header("Location: fuera.htm");

include ("conexion.php");

$idCategoria = $_GET["idCategoria"];
$Accion = $_POST["Accion"];
if ($Accion == "Cargar")
{
	$linea = $_POST["cmbLinea"];
	$titu = $_POST["txtTitulo"];
	$orden = $_POST["txtOrden"];
	$estado = $_POST["cmbEstado"];
   
    if($linea != "" && $titu != "" && $orden != "")
	{
		if ($idCategoria != "0")
			$sql = "UPDATE categoria SET idlinea=$linea, titulo='$titu', orden=$orden, estado=$estado WHERE idCategoria=$idCategoria";
		else
			$sql = "INSERT INTO categoria (idlinea,titulo, orden, estado) VALUES ($linea,'$titu', $orden, $estado)";
		
		$result = mysql_query($sql);		
	    $titu = "";
		$orden = "";
        echo $mensaje = '<script name="accion">alert("Los datos se cargaron con exito!"); setInterval(\'window.location.href="EditarCategorias.php"\', 1000) </script>';       
		
    }
    else
    {
    	if ($linea == ""){$mensaje = '<script name="accion">alert("Debe seleccionar un Linea") </script>'; echo $mensaje;}        
        if ($titu == ""){$mensaje = '<script name="accion">alert("Debe Ingresar un TITULO") </script>'; echo $mensaje;}
        if ($orden == ""){$mensaje = '<script name="accion">alert("Debe Ingresar un ORDEN") </script>'; echo $mensaje;} 
    }
}
elseif ($idCategoria != "0")
{
	$result = mysql_query("SELECT idCategoria, idlinea, titulo, orden, estado FROM categoria where idCategoria = " . $idCategoria, $link);
	if(mysql_num_rows($result) != 0)
	{
		$array=mysql_fetch_array($result);
		$linea = $array["idlinea"];
		$titu = $array["titulo"];
		$orden = $array["orden"];
		$estado = $array["estado"];
	}
}
?>
<HTML>
    <HEAD>
        <TITLE>ABM</TITLE>

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
		<meta http-equiv="Page-Exit" content="revealTrans(Duration=1.0,Transition=23)">
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
				setInterval('window.location.href="Editar_Secciones.php"', 500);
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
    	<td style="padding: 5px 0 0 10px;"><h2><b>Modificar Categor&iacute;a</b></h2></td>
    </tr>
    <TR>
		<TD align=middle><!--Cuerpo de Administraci?n-->
			<FORM method=post action='ModificarCategoria.php?idCategoria=<?PHP echo $idCategoria; ?>' enctype='multipart/form-data' name='form1'>
			<TABLE cellSpacing=0 width="100%" border="0">

				<TR>
					<TD align=center bgcolor="#c8e4ff" width="25%">
						<FONT color=steelblue size=2 Face=Arial>
						Fecha: <b><?php echo date("d/m/Y, H:m:s"); ?></b>
						</FONT>
					</TD>
					<TD align=left bgcolor="#c8e4ff" colspan=2>
						<input type="text" name="count" size="4" readonly>
						<FONT color=steelblue size=2 Face=Arial>
						<STRONG>Contador de Caracteres</STRONG>
						</FONT>
					</TD>
				</TR>
				<TR>
					<TD colspan=2 bgcolor=slategray height=1></TD>
				</TR>
				<TR>
					<TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=3 Face=Arial>
						<STRONG>Linea</STRONG>
						</FONT>
					</TD>
					<TD align=Left vAlign=top>
                        <?php
			            $result = mysql_query("SELECT idlinea, titulo FROM lineas WHERE idestado=1 ORDER BY titulo ASC", $link);
			
			            if (mysql_num_rows($result)> 0)
			            {
			            ?>
			            	<SELECT id=cmbLinea name=cmbLinea style="WIDTH: 175px">
			                 <?php
			                 if ($row = mysql_fetch_array($result))
				             {
				                 if ($linea=="") {echo "<OPTION Selected value=''>(Seleccione)</OPTION>";}
				                 else {echo "<OPTION value=''>(Seleccione)</OPTION>";}
				                 do {
				                     if ($row["idlinea"] == $linea)
				                     {
			                             echo "<OPTION selected value=" . $row["idlinea"] .  ">". $row["titulo"] . "</OPTION>";
				                     }
				                     else
				                     {
			                             echo "<OPTION value=" . $row["idlinea"] .  ">". $row["titulo"] . "</OPTION>";
				                     }
				                 }while ($row = mysql_fetch_array($result));
			
				             }
			            }
			            else
			            {
			                echo "<div align='center'>";
			    	        echo "<font face='verdana' size='-2'>No se encontraron Lineas Activas</font>";
				            echo "</div>";
			            }
				        ?>
					</TD>
				</TR>
				<TR>
					<TD colspan="2" bgcolor=slategray height=1></TD>
				</TR>			
				
				<TR>
					<TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=3 Face=Arial>
						<STRONG>Titulo</STRONG>
						</FONT>
					</TD>
					<TD align=Left vAlign=top>
                        <?php echo "<INPUT id=txtTitulo name=txtTitulo onKeyUp='validachar(this,100);' style='WIDTH: 350px; HEIGHT: 22px' size=40 value='".$titu."'>"; ?>
						<BR><FONT color=red size=1 Face=Arial>maximo 100 caracteres</FONT>
					</TD>
				</TR>
				<TR>
					<TD colspan="2" bgcolor=slategray height=1></TD>
				</TR>
                <TR>
					<TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=3 Face=Arial colspan=2>
						<STRONG>Nro Orden</STRONG>
						</FONT>
					</TD>
					<TD align=Left vAlign=top>
                        <?php echo "<input name='txtOrden' type='text' id='txtOrden' value='" . $orden . "'>"; ?>
						<BR><FONT color=red size=1 Face=Arial>(nro. de orden en el Menu)</FONT>
					</TD>
                </tr>
				<TR>
					<TD colspan=2 bgcolor=slategray height=1></TD>
				</TR>
				<TR>
                    <TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=4 Face=Arial><STRONG>Estado</STRONG></FONT>
					</TD>
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
                </tr>
                <TR>
					<TD colspan="2" bgcolor=slategray height=1></TD>
				</TR>
				<TR>
					<TD align=right colspan=2 bgcolor="#c8e4ff">
						<BR><INPUT type="submit" value="Cargar" id="Accion" name="Accion" style="FONT-WEIGHT: bold">&nbsp;&nbsp;&nbsp;<INPUT type="button" value="Cancelar" id=reset1 name=reset1 onClick="mLimpiarDatos()">&nbsp;&nbsp;
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