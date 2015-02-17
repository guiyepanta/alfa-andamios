<?php 
session_start();
if ($_SESSION["autorizacion_LoginSN"]==0)
    Header("Location: fuera.htm");

include ("conexion.php");
$Item_Id =$_GET["ID"];
$Tabla =$_GET["tabla"];
$Campo=$_GET["Campo"];
$Pagina=$_GET["pag"];
$indice=$_GET["ind"];
$editorial=$_GET["edito"];
$Borro = $_POST["Boton"];
$msj ="";
$borrar=true;

if ($indice!="" && $Tabla=="seccion_item")
    $Pagina = $Pagina . '.php?secc_id='.$indice;
else if ($indice!="" && $Tabla=="productos_catalogos")
    $Pagina = $Pagina . '.php?cata_id='.$indice;
else
    $Pagina = $Pagina . '.php';


if ($Borro=="SI")
{
    $Item_Id=$_POST["hdnItem_Id"];
    $Tabla=$_POST["hdnTabla"];
    $Campo=$_POST["hdnCampo"];
    $indice=$_POST["hdnIND"];

    if ($Tabla=="clientesportal")
    {
    	$SQL = "UPDATE ".$Tabla." SET estado=2 where ".$Campo."=".$Item_Id;
        $res = mysql_query($SQL);
        
        $borrar=false;
        $msj="El Registro se dejo inactivo" ;
       
    } 
    else if ($Tabla=="lineas")
    {
    	$SQL = "SELECT imagen FROM ".$Tabla." WHERE ".$Campo."=".$Item_Id;
        $res = mysql_query($SQL);
        if ($row = mysql_fetch_array($res))
        {
        	//borro la imagen
            $dirLogo = "../" . $row["imagen"];
			if ($dirLogo != "../")
				if(file_exists($dirLogo))
				{ 	unlink($dirLogo);}
        }
        
    }
	else if ($Tabla=="secciones")
    {
    	$sqlItems = "SELECT * FROM lineas WHERE id_seccion = ".$Item_Id;
		$resItems = mysql_query($sqlItems);
        if ($rowItems = mysql_fetch_array($resItems))
        {
			$borrar=false;
			$msj="El Registro no se puede eliminar porque posee registros de Lineas de productos relacionados" ;
		}		
    }    
    
    if ($borrar)
	{
		$SQL="Delete From ".$Tabla." where ".$Campo."=".$Item_Id;
		$result = mysql_query($SQL);
		$error = mysql_errno($link) . ":" . mysql_error($link);
		
		if($error == "0:")			
			$msj="El Registro se elimino con exito" ;
		else
			$msj="Ocurrio un error al borrar el registro, Por favor comuniquese con el administrador" .
			"<br>Error: ".$error;
		
		$Pagina = $_POST["hdnPag"];
	}
	else
	{
		$Pagina = $_POST["hdnPag"];
		//$msj="El Registro no se puede eliminar porque posee registros relacionados en otra tabla" ;
	}
	
}
?>

<HTML>
	<HEAD>
		<TITLE>Upload</TITLE>
		<STYLE type=text/css>
			<!--
			BODY {
				COLOR: #7f7f7f; SCROLLBAR-ARROW-COLOR: #fafafa; FONT-FAMILY: Tahoma, verdana; SCROLLBAR-DARKSHADOW-COLOR: #000000; SCROLLBAR-BASE-COLOR: #c5c5c5; BACKGROUND-COLOR: #ffffff
			}
			A {
			    COLOR: steelblue; TEXT-DECORATION: none
			}
			A:hover {
			    COLOR: Gold; TEXT-DECORATION: none
			}
			.botones {
				BORDER-RIGHT: #dfdfdf 1px solid; Cursor: hand; BORDER-TOP: #dfdfdf 1px solid; FONT-SIZE: 10px; BORDER-LEFT: #dfdfdf 1px solid; WIDTH: 65px; BORDER-BOTTOM: #dfdfdf 1px solid; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; BACKGROUND-COLOR: #ffffff
			}
			-->
		</STYLE>
	</HEAD>
	<BODY>
		<BR><P>
		<TABLE width="700" cellspacing='1' align=center cellpadding='3'>
			<TBODY>
			<TR>
				<TD align=center bgcolor="#c8e4ff">
					Eliminando Registro
				</TD>
			</TR>
			<tr>
				<TD align=center height=1 bgcolor="#ff0000"></TD>
			</TR>
		    <?php  if($msj==""){?>
			   <TR>
				<TD align=center bgcolor="#c8e4ff">
		            <table border="0" width="100%" bgcolor="#FFFFFF">
						<form method="post" action="Delete_Generico.php" id=form1 name=form1>
		                <tr>
							<td align=center colspan=2>
		                        <?php 
		                        if ($Tabla=="editoriales")
		                        {
		                            echo '<FONT color=steelblue size=4>Atencion..!!</FONT><BR>';
		                            echo '<FONT color=steelblue size=2>Si elimina la editorial >> <FONT color=red>'. $editorial . '</Font> <<, <b>se eliminaran todos los Productos'.
		                            ' que pertenezcan a ella.</B></FONT><BR>';
		                        }
		                        ?>
		                        <FONT color=steelblue size=2>�Esta seguro de eliminar el Registro?</FONT>
							</td>
						</tr>
						<tr>
							<td width="100%" colspan="2" align=Center>
								<Input type="Hidden" Value='<?php  echo $Item_Id;?>' name=hdnItem_Id id=hdnItem_Id>
		                        <input type="hidden" Value='<?php  echo $Tabla;?>' name=hdnTabla id=hdnTabla>
		                        <input type="hidden" Value='<?php  echo $Campo;?>' name=hdnCampo id=hdnCampo>
		                        <input type="hidden" Value='<?php  echo $Pagina;?>' name=hdnPag id=hdnPag>
		                        <input type="hidden" Value='<?php  echo $indice;?>' name=hdnIND id=hdnIND>
								<INPUT id="Boton" type="submit" value="SI" name="Boton" size=20 class="botones">&nbsp;&nbsp;<INPUT onclick="parent.body.location.href=('<?php  echo $Pagina; ?>')" type=button id="Boton" value="NO" name="Boton" size=20 class="botones">		
							</td>
						</tr>
		                </form>
					</table>
				</td>
			</TR>
		    <?php  } else if ($msj!="") { ?>
		        <TR>
		    	<TD align=center height=100  bgcolor="#c8e4ff">
		            <table border="0" width="100%" bgcolor="#FFFFFF" height=100>
		               	<tr>
							<td width="100%" align=Center>
		                        <Br>
		            			<?php  echo $msj; ?>
							</td>
						</tr>
					</table>
		        </TD>
		    	</TR>
		    <?php }?>
		    <TR>
		    	<TD valign=middle height=150 align=center>
		        	<a href="<?php  echo $Pagina;?>"><FONT color=steelblue size=2><< <?php  if($msj!=""){echo 'Volver';}else{echo 'Cancelar';} ?></Font></a>
		        		<?php  if($msj!=""){echo '<script>setInterval(\'window.location.href="'.$Pagina.'"\', 1000);</script>';}?>
		        </TD>
		    </TR>
		</table>	
	</BODY>
</HTML>