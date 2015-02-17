<?php
session_start();
if ($_SESSION["autorizacion_LoginSN"]==0)
    Header("Location: fuera.htm");

    if ($_GET["msg"] =="true")
    {
    	$mensaje = '<script name="accion">alert("Los datos de la Categoria se modificaron con exito!") </script>';
        echo $mensaje;
    }
    include ("conexion.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>ejemplo de paginaci�n de resultados</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Pragma" content="no-cache" />
	<STYLE type=text/css>
	<!--
	BODY {
		COLOR: #7f7f7f; SCROLLBAR-ARROW-COLOR: #fafafa; FONT-SIZE: 10px; FONT-FAMILY: Tahoma, verdana; SCROLLBAR-DARKSHADOW-COLOR: #000000; SCROLLBAR-BASE-COLOR: #c5c5c5; BACKGROUND-COLOR: #ffffff
	}
	A {
		COLOR: steelblue; TEXT-DECORATION: none
	}
	A:hover {
		COLOR: Gold; TEXT-DECORATION: none
	}
	.inputText {
		BORDER-RIGHT: #dfdfdf 1px solid; BORDER-TOP: #dfdfdf 1px solid; FONT-SIZE: 10px; BORDER-LEFT: #dfdfdf 1px solid; BORDER-BOTTOM: #dfdfdf 1px solid; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif
	}
	.botones {
	    BORDER-RIGHT: #999 1px solid;
	    BORDER-TOP: #999 1px solid;
	    FONT-SIZE: 12px;
	    BORDER-LEFT: #999 1px solid;
	    WIDTH: 60px;
	    BORDER-BOTTOM: #999 1px solid;
	    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
	    BACKGROUND-COLOR: #ddd;
	}
	.botones:hover {
	    BACKGROUND-COLOR: #98C0F4;
	}
	-->
	</style>  
    <SCRIPT src="Javascript/funciones.js"></SCRIPT>
</head>
<body bgcolor="#FFFFFF">
<script language="JavaScript">
function muestra(queCosa)
{
    alert(queCosa);
}
</script>

<?php

//inicializo el criterio y recibo cualquier cadena que se desee buscar
$criterio = "";
$idCategoria = $_GET["cmbFiltroCategoria"];
$txt_criterio = $_GET["criterio"];

if ($_GET["cantRegistro"] == "")
    $cantRegistro = 10;
else 
    $cantRegistro = $_GET["cantRegistro"];

if ($idCategoria!="")
	$criterio = " AND p.idCategoria=" . $idCategoria;
if ($txt_criterio!="")
	$criterio = $criterio . " AND p.titulo LIKE '%" . $txt_criterio . "%'";

$sql="SELECT DISTINCT p.idcategoria, c.titulo 'tituloCategoria' , p.titulo 'tituloProducto', p.precio, p.idEstado, esta_desc
	  FROM productos p, categoria c, estados e
	  WHERE p.idcategoria = c.idcategoria
	      AND p.idEstado = e.esta_id" . $criterio . " ORDER BY c.titulo, p.titulo";

$res=mysql_query($sql);
$numeroRegistros=mysql_num_rows($res);
?>
	<form action=EditarProductos.php method='get'>
		<div align='left'>
		<TABLE width="100%" cellspacing='1' cellpadding='0' bgcolor='#ffffff' align=Center>
    		<TR>
        		<TD align=left width="40%">
            		<font face='verdana' size='-2'>Produxtos encontrados: <B> <?php echo $numeroRegistros; ?>
            		</B>&nbsp;&nbsp;ordenados por <b>Categoria, Titulo</b><div align='left'>		
        		</TD>
        		
        		<td align="right" width="15%">
                    <font face='verdana' size='-2'>Mostrar: </font>
                    <?php
                        if ($cantRegistro=="10")
                        {
                            echo "<SELECT id=cantRegistro name=cantRegistro class='inputText' style='WIDTH: 100px'>";
                            echo "<option value='10' selected>10 Reg.</option><option value='25'>25 Reg.</option><option value='50'>50 Reg.</option>";
                            echo "</SELECT>";
                        } else if ($cantRegistro=="25"){
                            echo "<SELECT id=cantRegistro name=cantRegistro class='inputText' style='WIDTH: 100px'>";
                            echo "<option value='10'>10 Reg.</option><option value='25' selected>25 Reg.</option><option value='50'>50 Reg.</option>";
                            echo "</SELECT>";
                        } else if ($cantRegistro=="50"){
                            echo "<SELECT id=cantRegistro name=cantRegistro class='inputText' style='WIDTH: 100px'>";
                            echo "<option value='10'>10 Reg.</option><option value='25'>25 Reg.</option><option value='50' selected>50 Reg.</option>";
                            echo "</SELECT>";
                        }
                    ?>
                </td>
        		
        		<TD align=Right width="45%">
            		<font face='verdana' size='-2'><b>Filtros: </b></font>
            		<select id=cmbFiltroCategoria name=cmbFiltroCategoria class="inputText" style='WIDTH: 200px'>
            		<?php
                    	$result = mysql_query("SELECT idCategoria, titulo FROM categoria", $link);
                        if ($row = mysql_fetch_array($result))
                        {
                            if ($idCategoria=="") 
            				{echo "<OPTION Selected value=''>Todos</OPTION>";}
                            else
            				{echo "<OPTION value=''>Todos</OPTION>";}
            				
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
                    ?>
              		</select>&nbsp;
            		<input type="text" name="criterio" size="22" maxlength="150" class="inputText" value="<?php echo $txt_criterio; ?>">
            		<input type="submit" value="Buscar" class="botones">&nbsp;&nbsp;
        		</TD>
    		</TR>
		</TABLE>
		
		<hr noshade style='color:023977;height:1px'>
	</div></form>
<?php
if($numeroRegistros<=0)
{
    echo "<div align='center'>";
    echo "<font face='verdana' size='-2'>No se encontraron resultados</font>";
    echo "</div>";
}else{
    //////////elementos para el orden
    if(!isset($orden))
    {
       $orden="prdt_id";
    }
    //////////fin elementos de orden

    //////////calculo de elementos necesarios para paginacion
    //tama�o de la pagina
    $tamPag=$cantRegistro;

    //pagina actual si no esta definida y limites
    if(!isset($_GET["pagina"]))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $pagina = $_GET["pagina"];
    }
    //calculo del limite inferior
    $limitInf=($pagina-1)*$tamPag;

    //calculo del numero de paginas
    $numPags=ceil($numeroRegistros/$tamPag);
    if(!isset($pagina))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $seccionActual=intval(($pagina-1)/$tamPag);
       $inicio=($seccionActual*$tamPag)+1;

       if($pagina<$numPags)
       {
          $final=$inicio+$tamPag-1;
       }else{
          $final=$numPags;
       }

       if ($final>$numPags){
          $final=$numPags;
       }
    }

	//////////fin de dicho calculo
	
	//////////creacion de la consulta con limites
	$sql="SELECT DISTINCT p.idcategoria, p.idproducto, c.titulo 'tituloCategoria' , p.titulo 'tituloProducto', p.precio, p.idEstado, esta_desc
	  FROM productos p, categoria c, estados e
	  WHERE p.idcategoria = c.idcategoria
	      AND p.idEstado = e.esta_id" . $criterio . " ORDER BY c.titulo ASC, p.titulo ASC LIMIT ".$limitInf.",".$tamPag;
	$res=mysql_query($sql);
	//////////fin consulta con limites
	?>
	
	<TABLE width="750" cellspacing='1' cellpadding='1' bgcolor='#c3c3c3' align=Center>
	  <TBODY>
	  <TR>
			<TD align=left bgcolor="#c8e4ff">Categoria</TD>
			<TD align=left bgcolor="#c8e4ff">Producto</TD>
	        <TD style="background:#c8e4ff; width:100px; text-align:center;">Estado</TD>
	        <TD align=center bgcolor="#c8e4ff" width=25>Modificar</TD>
	        <TD align=center bgcolor="#c8e4ff" width=25>Eliminar</TD>
	  </TR>
	<?php
	$ban=0;
	while($registro=mysql_fetch_array($res))
	{
		$c++; 
		
	    echo "<TR><TD bgcolor=#ffffff valign=top align=left><FONT size=2>". $registro["tituloCategoria"] ."</FONT></TD>";
	    echo "<TD bgcolor=#ffffff valign=top align=left><FONT size=2><b>". $registro["tituloProducto"] ."</b></FONT></TD>";
	    
	    $div='divPrd_' . $c;
	    if ($registro["idEstado"]==1)
	    	echo "<td bgcolor=#ffffff id='" . $div . "' align=center><img src='imagenes/on.png' onclick='activarProducto(\"". $registro["idproducto"] ."\",\"" . $div . "\", 0)' border=0 style='cursor: pointer;' /></td>";   
	    else
	    	echo "<td bgcolor=#ffffff id='" . $div . "' align=center><img src='imagenes/off.png' onclick='activarProducto(\"". $registro["idproducto"] ."\",\"" . $div . "\", 1)' border=0 style='cursor: pointer;' /></td>";
				 
	    echo "<TD bgcolor=#ffffff align=center valign=middle width=25><A HREF='ModificarProducto.php?idProducto=". $registro["idproducto"] ."&cmbFiltroCategoria=$idCategoria'><img src='imagenes/ok.gif' border=0 alt='Modificar Producto'></A></TD>";
	    echo "<TD bgcolor=#ffffff  align=center valign=middle width=25><A HREF='Delete_Generico.php?ID=". $registro["idproducto"] ."&tabla=productos&Campo=idproducto&pag=EditarProductos'><img src='imagenes/delete.gif' border=0 alt='Eliminar Producto'></A></TD></TR>";
	   
	}//fin while
	?>
	</table>
<?php
}//fin if
//////////a partir de aqui viene la paginacion
?>
    <table border="0" cellspacing="0" cellpadding="0" align="center">
    <tr><td align="center" valign="top">
<?php
    if($pagina>1)
    {
       echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?id=".$ID."&pagina=".($pagina-1)."&orden=".$orden."&criterio=".$txt_criterio."'>";
       echo "<font face='verdana' size='-2'>anterior</font>";
       echo "</a> ";
    }

    for($i=$inicio;$i<=$final;$i++)
    {
       if($i==$pagina)
       {
          echo "<font face='verdana' size='-2'><b>".$i."</b> </font>";
       }else{
          echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?id=".$ID."&pagina=".$i."&orden=".$orden."&criterio=".$txt_criterio."'>";
          echo "<font face='verdana' size='-2'>".$i."</font></a> ";
       }
    }
    if($pagina<$numPags)
   {
       echo " <a class='p' href='".$_SERVER["PHP_SELF"]."?id=".$ID."&pagina=".($pagina+1)."&orden=".$orden."&criterio=".$txt_criterio."'>";
       echo "<font face='verdana' size='-2'>siguiente</font></a>";
   }
//////////fin de la paginacion
?>
    </td></tr>
    </table>
<hr noshade style="color:023977;height:1px">
</body>
</html>
<?php
    mysql_close();
?>