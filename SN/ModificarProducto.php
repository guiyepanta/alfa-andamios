<?php
session_start();
if ($_SESSION["autorizacion_LoginSN"]==0)
    Header("Location: fuera.htm");

include_once("conexion.php");

$idProducto = $_GET["idProducto"];
$idCategoria = $_GET["cmbFiltroCategoria"];
$Accion = $_POST["Accion"];
$disponible=1;

if ($Accion == "Cargar")
{
	$idCategoria = $_POST["cmbCategoria"];
    $titu = $_POST["txtTitulo"];
	$detalle = $_POST["txtDetalle"];
	$precio = $_POST["txtPrecio"];
	$iva = $_POST["txtIva"];
	$hdnImagen1=$_POST["hdnIMG1"];
	$hdnImagen2=$_POST["hdnIMG2"];
	$hdnImagen3=$_POST["hdnIMG3"];
	$estado = $_POST["cmbEstado"];
	$chkDisponible = $_POST["chkDisponible"];
	$imagen1="";
	$imagen2="";
	$imagen3="";
	
	$prefijo = time();
	$carpetaDestino =  "imagenesProductos/";
	
	if ($chkDisponible != "on")
		$disponible=0;
	
	if (is_uploaded_file($_FILES['txtImagen1']['tmp_name'])) 
	{
		if($_FILES['txtImagen1']['size'] < 205000) 
		{
            $imagen1 = "";
            if($_FILES['txtImagen1']['type']=="image/gif" || $_FILES['txtImagen1']['type']=="image/jpeg" || $_FILES['txtImagen1']['type']=="image/png" || $_FILES['txtImagen1']['type']=="image/pjpeg" || $_FILES['txtImagen1']['type']=="image/x-png")
            {
            	if ($hdnImagen1 != "")
			    	if(file_exists("../" . $hdnImagen1))
			            unlink("../" . $hdnImagen1);

				copy($_FILES['txtImagen1']['tmp_name'], "../" . $carpetaDestino . $prefijo . "-img1-" . $_FILES['txtImagen1']['name']);
	            $imagen1 = $carpetaDestino . $prefijo . "-img1-" . $_FILES['txtImagen1']['name'];
			}
            else
            {
            	$imagen1_error = "N";
            	if ($hdnImagen1 != "")
		 			$imagen1=$hdnImagen1; 
            }
		}
        else
        {
        	if ($hdnImagen1 != "")
		 		$imagen1=$hdnImagen1; 
		 		
        	$imagen1_error = "G";
        }
	}
	else
	{
		if ($hdnImagen1 != "")
		 	$imagen1=$hdnImagen1;    	
	} 

	if (is_uploaded_file($_FILES['txtImagen2']['tmp_name'])) 
	{
		if($_FILES['txtImagen2']['size'] < 205000) 
		{
            $imagen2 = "";
            if($_FILES['txtImagen2']['type']=="image/gif" || $_FILES['txtImagen2']['type']=="image/jpeg" || $_FILES['txtImagen2']['type']=="image/png" || $_FILES['txtImagen2']['type']=="image/pjpeg" || $_FILES['txtImagen2']['type']=="image/x-png")
            {
            	if ($hdnImagen2 != "")
			    	if(file_exists("../" . $hdnImagen2))
			            unlink("../" . $hdnImagen2);

				copy($_FILES['txtImagen2']['tmp_name'], "../" . $carpetaDestino . $prefijo . "-img2-" . $_FILES['txtImagen2']['name']);
	            $imagen2 = $carpetaDestino . $prefijo . "-img2-" . $_FILES['txtImagen2']['name'];
			}
            else
            {
            	$imagen2_error = "N";
            	if ($hdnImagen2 != "")
		 			$imagen2=$hdnImagen2; 
            }
		}
        else
        {
        	if ($hdnImagen2 != "")
		 		$imagen2=$hdnImagen2; 
		 		
        	$imagen2_error = "G";
        }
	}
	else
	{
		if ($hdnImagen2 != "")
		 	$imagen2=$hdnImagen2;    	
	}
	
	if (is_uploaded_file($_FILES['txtImagen3']['tmp_name'])) 
	{
		if($_FILES['txtImagen3']['size'] < 205000) 
		{
            $imagen3 = "";
            if($_FILES['txtImagen3']['type']=="image/gif" || $_FILES['txtImagen3']['type']=="image/jpeg" || $_FILES['txtImagen3']['type']=="image/png" || $_FILES['txtImagen3']['type']=="image/pjpeg" || $_FILES['txtImagen3']['type']=="image/x-png")
            {
            	if ($hdnImagen3 != "")
			    	if(file_exists("../" . $hdnImagen3))
			            unlink("../" . $hdnImagen3);

				copy($_FILES['txtImagen3']['tmp_name'], "../" . $carpetaDestino . $prefijo . "-img3-" . $_FILES['txtImagen3']['name']);
	            $imagen3 = $carpetaDestino . $prefijo . "-img3-" . $_FILES['txtImagen3']['name'];
			}
            else
            {
            	$imagen3_error = "N";
            	if ($hdnImagen3 != "")
		 			$imagen3=$hdnImagen3; 
            }
		}
        else
        {
        	if ($hdnImagen3 != "")
		 		$imagen3=$hdnImagen3; 
		 		
        	$imagen3_error = "G";
        }
	}
	else
	{
		if ($hdnImagen3 != "")
		 	$imagen3=$hdnImagen3;    	
	} 	

    if($idCategoria != "" && $titu != "" && $precio != "" && $imagen1_error == "" && $imagen2_error == "" && $imagen3_error == "")
	{
		if ($idProducto=="0"){
			$sql = "INSERT INTO productos (idCategoria, titulo, detalle, imagen1, imagen2, imagen3, precio, idEstado, disponible, iva)" .
			       "VALUES ($idCategoria,'$titu', '$detalle', '$imagen1', '$imagen2', '$imagen3', '$precio', $estado, $disponible, $iva)";
	        $result = mysql_query($sql);
	        $mensaje = '<script name="accion">alert("Los datos se cargaron con exito");</script>';
            $rs = mysql_query("SELECT MAX(idproducto) AS idproducto FROM productos");
            if ($row = mysql_fetch_row($rs)) {
                $idProducto = trim($row["idproducto"]);
            }
		}
		else{
	        $sql = "UPDATE productos SET idCategoria=$idCategoria, titulo='$titu', detalle='$detalle'".
				   ", imagen1='$imagen1', imagen2='$imagen2', imagen3='$imagen3', precio=$precio, idestado=$estado, disponible=$disponible, iva=$iva WHERE idproducto=$idProducto";
	        $result = mysql_query($sql);
	        $mensaje = '<script name="accion">alert("Los datos se cargaron con exito");</script>';
		}
        echo $mensaje;
    }
    else
    {
        if ($idCategoria == ""){$mensaje = '<script name="accion">alert("Debe seleccionar una Categoria") </script>'; echo $mensaje;}
		elseif ($titu == ""){$mensaje = '<script name="accion">alert("Debe ingresar un Titulo a la nueva Linea") </script>'; echo $mensaje;}
		elseif ($imagen1_error == "N"){$mensaje = '<script name="accion">alert("El formato de la Imagen no es el permitido") </script>'; echo $mensaje;}
        elseif ($imagen1_error == "G"){$mensaje = '<script name="accion">alert("La Imagen exede el limite de tama�o permitido") </script>'; echo $mensaje;}
    }
}
else
{
	if ($idProducto != "0"){
		$result = mysql_query("SELECT idCategoria, titulo, detalle, imagen1, imagen2, imagen3, precio, idEstado, disponible, iva FROM productos where idProducto = " . $idProducto, $link);
	
		if(mysql_num_rows($result) != 0)
		{
			$array=mysql_fetch_array($result);
				
			$idCategoria = $array["idCategoria"];
			$titu = $array["titulo"];
			$detalle = $array["detalle"];
			$imagen1 = $array["imagen1"];
			$imagen2 = $array["imagen2"];
			$imagen3 = $array["imagen3"];
			$precio = $array["precio"];
			$estado = $array["idEstado"];
			$disponible = $array["disponible"];
			$iva = $array["iva"];
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
		<script type="text/javascript" src="Javascript/jquery-1.9.0.js"></script>
        <script type="text/javascript" src="Javascript/jHtmlArea-0.8.js"></script>
        <link rel="Stylesheet" type="text/css" href="Estilos/jHtmlArea.css" />        
        <script type="text/javascript" src="Javascript/jHtmlArea.ColorPickerMenu-0.8.js"></script>
        <link rel="Stylesheet" type="text/css" href="Estilos/jHtmlArea.ColorPickerMenu.css" />
		<script>
		    $(function() {
                $("#txtDetalle").htmlarea({
                    toolbar: ["html", "|",
                            "forecolor",  // <-- Add the "forecolor" Toolbar Button
                            "|", "bold", "italic", "underline", "|", "link", "unlink"] // Overrides/Specifies the Toolbar buttons to show
                    });
            });
		</script>
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
				setInterval('window.location.href="EditarProductos.php?secc_id=<?php echo $indice; ?>"', 500);
			}

			function isNumeric(evt)
			{
				var c = (evt.which) ? evt.which : evt.keyCode;
				if (evt.which)
					if ((c >= '48'  && c <= '57') || c == '46' )
					    return true;
				else
					if ((c >= '0'  && c <= '9') || c == '.' )
				    	return true;
				
				return false;
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
    	<?php if($idProducto == "0") {?>
    		<td style="padding: 5px 0 0 10px;"><h2><b>Nuevo Producto</b></h2></td>
    	<?php } else { ?>
    		<td style="padding: 5px 0 0 10px;"><h2><b>Editar Producto</b></h2></td>
    	<?php } ?>
    </tr>
    <TR>
		<TD align=middle><!--Cuerpo de Administraci�n-->
			<FORM method="post" action="ModificarProducto.php?idProducto=<?php echo $idProducto; ?>" enctype="multipart/form-data" name="form1">
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
				</TR>
				<TR>
					<TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=3 Face=Arial>
						<STRONG>Secci&oacute;n</STRONG>
						</FONT>
					</TD>
					<TD align=Left>
						<SELECT id=cmbCategoria name=cmbCategoria style='WIDTH: 200px'>
						<?php
                        	$result = mysql_query("SELECT idCategoria, titulo FROM categoria", $link);
                            if ($row = mysql_fetch_array($result))
                            {
                                if ($idCategoria=="") 
								{echo "<OPTION Selected value=''>(Seleccione)</OPTION>";}
                                else
								{echo "<OPTION value=''>(Seleccione)</OPTION>";}
								
								do {
                                    if ($row["idCategoria"] == $idCategoria)
                                    {
                                        echo "<OPTION selected value='" . $row["idCategoria"] . "'>". $row["titulo"] . "</OPTION>";
                                    }
                                	else
                                    {
                                        echo "<OPTION value='" . $row["idCategoria"] . "'>". $row["titulo"] . "</OPTION>";
                                    }
                                }while ($row = mysql_fetch_array($result));

                            }
                            mysql_close($link);
                        ?>
                        </SELECT>
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
                        <?php echo "<INPUT id=txtTitulo name=txtTitulo onKeyUp='validachar(this,100);' style='WIDTH: 350px; HEIGHT: 22px' size=40 value='".$titu."'>"; ?>
						<BR><FONT color=red size=1 Face=Arial>(maximo 100 caracteres)</FONT>
					</TD>
				</TR>
				<TR>
					<TD colspan=2 bgcolor=slategray height=1></TD>
				</TR>
				<TR>
					<TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=3 Face=Arial>
						<STRONG>Detalle</STRONG>
						</FONT>
					</TD>					
					<TD align=Left vAlign=top>
                        <?php 
						echo "<TEXTAREA id=txtDetalle name=txtDetalle style='WIDTH:450px; HEIGHT: 150px' onKeyUp='validachar(this,1000);'>".$detalle."</TEXTAREA>";                           
						?>
						<BR><FONT color=red size=1 Face=Arial>(maximo 1000 caracteres)</FONT>
					</TD>
				</TR>				
                <TR>
					<TD colspan=2 bgcolor=slategray height=1></TD>
				</TR>
                <TR>
					<TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=3 Face=Arial><STRONG>Precio $</STRONG></FONT>
					</TD>
					<TD align=Left vAlign=top >
                    	<?php echo "<input name='txtPrecio' type='text' id='txtPrecio' onkeypress='return isNumeric(event)' value='" . $precio . "'>"; ?>
                    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    	<FONT color=steelblue size=3 Face=Arial><STRONG>IVA&nbsp;
                    	<?php echo "<input name='txtIva' type='text' id='txtIva' onkeypress='return isNumeric(event)' value='" . $iva . "'>"; ?>%</STRONG></FONT>
                    	<BR><FONT color=red size=1 Face=Arial>(Valor con 2 decimales ejem: ####,##)</FONT>
					</TD>
				</TR>				
                <TR>
					<TD colspan=2 bgcolor=slategray height=1></TD>
				</TR>
                <TR>
					<TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=3 Face=Arial><STRONG>Disponible</STRONG></FONT>
					</TD>
					<TD align=Left vAlign=top >
						<?php 
                    	if ($disponible==1)
                    		echo "<input type='checkbox' name='chkDisponible' checked>";
						else 
							echo "<input type='checkbox' name='chkDisponible' >";
                    	?>
                    	&nbsp;<FONT color=red size=1 Face=Arial>(Marcar esta casilla para mostrar precio y estar disponible para la compra)</FONT>
					</TD>
				</TR>                
                <TR>
					<TD colspan=2 bgcolor=slategray height=1></TD>
				</TR>				
                <TR>                 	
					<TD align=right vAlign=top style="padding-right: 10px;">
						<FONT color=steelblue size=3 Face=Arial><STRONG>Imagenes</STRONG></FONT>
					</TD>
					<TD align=Left>					
						<TABLE cellSpacing=0 width="100%">
							<TBODY>
							<tr>
								<TD align=Left valign=top>
									<?php echo "<input type='hidden' id='hdnIMG1' name='hdnIMG1' value='" . $imagen1 . "'>"; ?>
									<input name="txtImagen1" type="file" id="txtImagen1">
									<BR><FONT color=red size=1 Face=Arial>(Solo formato GIF, JPG o PNG menores a 200 KB)</FONT>
								</TD>
								<TD align=right vAlign=top style="padding-right: 10px;">
									<FONT color=steelblue size=3 Face=Arial><STRONG>Imagen 1</STRONG></FONT>
								</TD>
								<TD align=Left>
									<?php

									if (ltrim($imagen1)!="")
										echo "<img id='imgProducto1' src='../" . $imagen1 . "' width=150 height=95>";
									else
										echo "<img id='imgProducto1' src='imagenes/no_imagen.png' width=80 height=80>";
									?>
								</TD>
							</tr>
							
							<tr>
								<TD align=Left valign=top>
									<?php echo "<input type='hidden' id='hdnIMG2' name='hdnIMG2' value='" . $imagen2 . "'>"; ?>
									<input name="txtImagen2" type="file" id="txtImagen2">
									<BR><FONT color=red size=1 Face=Arial>(Solo formato GIF, JPG o PNG menores a 200 KB)</FONT>
								</TD>
								<TD align=right vAlign=top style="padding-right: 10px;">
									<FONT color=steelblue size=3 Face=Arial><STRONG>Imagen 2</STRONG></FONT>
								</TD>
								<TD align=Left>
									<?php

									if (ltrim($imagen2)!="")
										echo "<img id='imgProducto2' src='../" . $imagen2 . "' width=150 height=95>";
									else
										echo "<img id='imgProducto2' src='imagenes/no_imagen.png' width=80 height=80>";
									?>
								</TD>
							</tr>
							
							<tr>
								<TD align=Left valign=top>
									<?php echo "<input type='hidden' id='hdnIMG3' name='hdnIMG3' value='" . $imagen3 . "'>"; ?>
									<input name="txtImagen3" type="file" id="txtImagen3">
									<BR><FONT color=red size=1 Face=Arial>(Solo formato GIF, JPG o PNG menores a 200 KB)</FONT>
								</TD>
								<TD align=right vAlign=top style="padding-right: 10px;">
									<FONT color=steelblue size=3 Face=Arial><STRONG>Imagen 3</STRONG></FONT>
								</TD>
								<TD align=Left>
									<?php

									if (ltrim($imagen3)!="")
										echo "<img id='imgProducto3' src='../" . $imagen3 . "' width=150 height=95>";
									else
										echo "<img id='imgProducto3' src='imagenes/no_imagen.png' width=80 height=80>";
									?>
								</TD>
							</tr>
							</TBODY>
						</TABLE>
					</TD>
                </tr>                
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
                        ?>					</TD>                    
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