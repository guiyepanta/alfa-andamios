<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");

if ($_SESSION["autorizacion_LoginSN"]==0)
    Header("Location: fuera.htm");

    include_once("conexion.php");

$filEstado="";
$txt_criterio = "";
$txt_criterio = $_GET["criterio"];
$filEstado = $_GET["filEstado"];
if ($_GET["cantRegistro"] == "")
    $cantRegistro = 10;
else 
    $cantRegistro = $_GET["cantRegistro"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>ejemplo de paginaci�n de resultados</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Pragma" content="no-cache" />
	<STYLE type=text/css>
	
	BODY {
		COLOR: #7f7f7f; SCROLLBAR-ARROW-COLOR: #fafafa; FONT-FAMILY: Tahoma, verdana; SCROLLBAR-DARKSHADOW-COLOR: #000000; SCROLLBAR-BASE-COLOR: #c5c5c5; BACKGROUND-COLOR: #ffffff
	}
	A {
		COLOR: steelblue; TEXT-DECORATION: none
	}
	A:hover {
		COLOR: Gold; TEXT-DECORATION: none
	}
	.inputText {
		BORDER-RIGHT: #dfdfdf 1px solid; BORDER-TOP: #dfdfdf 1px solid; FONT-SIZE: 11px; BORDER-LEFT: #dfdfdf 1px solid; BORDER-BOTTOM: #dfdfdf 1px solid; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif
	}
	.botones {
	    border-right: #999 1px solid;
	    border-top: #999 1px solid;
	    font-size: 12px;
	    border-left: #999 1px solid;
	    width: 60px;
	    border-bottom: #999 1px solid;
	    font-family: Verdana, Arial, Helvetica, sans-serif;
	    background-color: #ddd;
	}
	.botones:hover {
	    background-color: #98C0F4;
	}
	
	</style>
	<SCRIPT src="Javascript/funciones.js"></SCRIPT>
</head>
<body bgcolor="#FFFFFF">
<?php
$criterio = "";
if ($txt_criterio!="")
   $criterio = " AND (cp.nombre like '%" . $txt_criterio . "%' or cp.apellido like '%" . $txt_criterio . "%' or cp.empresa like '%" . $txt_criterio . "%')";
if ($filEstado!="")
	$criterio .= " AND p.estado=" . $filEstado;

$sql="SELECT p.idPedido, cp.apellido, cp.nombre, cp.empresa, p.fecha, ep.idEstado, ep.detalle"; //, SUM(pd.precio) as totalImporte, SUM(cantidad) totalItems";
$sql.=" FROM  pedidos p, pedidosdetalles pd,clientesportal cp, estadopedidos ep";
$sql.=" WHERE p.idPedido = pd.idPedido AND p.usuario = cp.idCliente AND p.estado = ep.idEstado".$criterio;
$sql.=" GROUP BY p.idPedido, cp.apellido, cp.nombre, cp.empresa, p.fecha, ep.detalle, p.fecha Desc ORDER BY ep.idEstado";
$res=mysql_query($sql);	
$numeroRegistros=mysql_num_rows($res);
?>
<form action=EditarPedidos.php method='get'><div align='left'>
	<TABLE width="100%" cellspacing='1' cellpadding='0'bgcolor='#ffffff' align=Center>
		<TR>
			<TD align=left width="27%">
				<?php
				echo "<font face='verdana' size='-2'>Pedidos encontrados: <B>".$numeroRegistros;
				echo "</B>&nbsp;&nbsp;ordenados por <b>Estado y Fecha </b><div align='left'>";
				?>			
			</TD>
			<td align="right" width="12%">
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
			<td align="right" width="18%">
				<font face='verdana' size='-2'>Estado: </font>
				<?php
					$sqlEstados = "SELECT idEstado, Detalle FROM estadopedidos ORDER BY idEstado";
					$resEstados=mysql_query($sqlEstados);
					echo "<SELECT id=filEstado name=filEstado class='inputText' style='WIDTH: 150px' >";
					if ($filEstado=="")
						echo "<option value='' selected>Todos</option>";
					else
						echo "<option value=''>Todos</option>";
					
					while($reg=mysql_fetch_array($resEstados))
					{
						if ($filEstado==$reg["idEstado"])
						echo "<option value='".$reg["idEstado"]."' selected>".$reg["Detalle"]."</option>";
						else						
							echo "<option value='".$reg["idEstado"]."'>".$reg["Detalle"]."</option>";
					}
					echo "</SELECT>";	
			    ?>
			</td>		
			<TD align=Right width="20%">
				<font face='verdana' size='-2'>Texto: </font>
				<input type="text" name="criterio" size="22" maxlength="150" value='<?php echo $txt_criterio; ?>' class="inputText">
				<input type="hidden" name="id" value='<?php echo $ID; ?>'>
				<input type="submit" value="Buscar" class="botones">
			</TD>
		</TR>
	</TABLE>
<hr noshade style='color:023977;height:1px'>
</font></form>


<?php
//inicializo el criterio y recibo cualquier cadena que se desee buscar
$ID = $_GET["id"];
$criterio = "";
if ($txt_criterio!="")
   $criterio = " AND (cp.nombre like '%" . $txt_criterio . "%' or cp.apellido like '%" . $txt_criterio . "%' or cp.empresa like '%" . $txt_criterio . "%')";
if ($filEstado!="")
	$criterio .= " AND p.estado=" . $filEstado;

$sql="SELECT p.idPedido, cp.apellido, cp.nombre, cp.empresa, p.fecha, ep.idEstado, ep.detalle"; //, SUM(pd.precio) as totalImporte, SUM(cantidad) totalItems";
$sql.=" FROM  pedidos p, pedidosdetalles pd,clientesportal cp, estadopedidos ep";
$sql.=" WHERE p.idPedido = pd.idPedido AND p.usuario = cp.idCliente AND p.estado = ep.idEstado".$criterio;
$sql.=" GROUP BY p.idPedido, cp.apellido, cp.nombre, cp.empresa, p.fecha, ep.detalle, p.fecha Desc ORDER BY ep.idEstado";
$res=mysql_query($sql);
$numeroRegistros=mysql_num_rows($res);
if($numeroRegistros>0)
{
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

//fin de dicho calculo

//creacion de la consulta con limites

$sql="SELECT p.idPedido, cp.apellido, cp.nombre, cp.empresa, p.fecha, ep.idEstado, ep.detalle"; //, SUM(pd.precio) as totalImporte, SUM(cantidad) totalItems";
$sql.=" FROM  pedidos p, pedidosdetalles pd,clientesportal cp, estadopedidos ep";
$sql.=" WHERE p.idPedido = pd.idPedido AND p.usuario = cp.idCliente AND p.estado = ep.idEstado".$criterio;
$sql.=" GROUP BY p.idPedido, cp.apellido, cp.nombre, cp.empresa, p.fecha, ep.detalle ORDER BY ep.idEstado, p.fecha desc LIMIT ".$limitInf.",".$tamPag;
$res=mysql_query($sql);

//////////fin consulta con limites
?>
<TABLE width="850" cellspacing='1' cellpadding='3' bgcolor='#c3c3c3' align=Center>
  <TBODY>
  <TR>  	
		<TD align=center width="50" bgcolor="#c8e4ff" style="border-bottom: 2px solid #f00">Pedido</TD>
		<TD align=center bgcolor="#c8e4ff" style="border-bottom: 2px solid #f00">Cliente</TD>
        <TD align=center bgcolor="#c8e4ff" width=180 style="border-bottom: 2px solid #f00">Empresa</TD>
        <TD align=center bgcolor="#c8e4ff" width=70 style="border-bottom: 2px solid #f00">Fecha</TD>
        <TD align=center bgcolor="#c8e4ff" width=150 style="border-bottom: 2px solid #f00">Estado</TD>
        <TD align=center bgcolor="#c8e4ff" width=25 style="border-bottom: 2px solid #f00">Ver</TD>
        <TD align=center bgcolor="#c8e4ff" width=25 style="border-bottom: 2px solid #f00">Del.</TD>
  </TR>
<?php

while($registro=mysql_fetch_array($res))
{
	echo "<TR><TD bgcolor=#ffffff align=Center><FONT size=2>". $registro["idPedido"] ."</FONT></TD>";
	echo "<TD bgcolor=#ffffff style='color: #969594; font-size: 11px;'>&nbsp;<B>". $registro["apellido"] . ", ". $registro["nombre"] . "</B></TD>";
	echo "<TD bgcolor=#ffffff style='color: #969594; font-size: 11px;'>&nbsp;<B>". $registro["empresa"] . "</B></TD>";
	echo "<TD bgcolor=#ffffff style='color: #969594; font-size: 11px;'>&nbsp;<B>". $registro["fecha"] . "</B></TD>";
	
	if($registro["idEstado"] == 1)
		echo "<td align=center valign=middle style='background:#f2c2c2; color: #DF0A1B; font-size: 11px;'>". $registro["detalle"] ."</td>";
	else if($registro["idEstado"] == 2)
        echo "<td align=center valign=middle style='background:#f2c2c2; color: #669966; font-size: 11px;'>". $registro["detalle"] ."</td>";
    else if($registro["idEstado"] == 3 || $registro["idEstado"] == 4)
        echo "<td align=center valign=middle style='background:#FFFFCC; color: #666; font-size: 11px;'>". $registro["detalle"] ."</td>";
    else
		echo "<td align=center valign=middle style='background:#c4ecc4; color: #666; font-size: 11px;'>". $registro["detalle"] ."</td>";	
	
	echo "<TD bgcolor=#ffffff align=center valign=middle width=25><A HREF='javascript: openPagina(\"verPedido.php?id=".$registro["idPedido"]."\",\"verPedido\",680,500,\"yes\");'><img src='imagenes/ok.gif' border=0 alt='Modificar Estado'></A></TD>";
	echo "<TD bgcolor=#ffffff align=center valign=middle width=25><A HREF='Delete_Generico.php?ID=". $registro["idPedido"] ."&tabla=pedidos&Campo=idPedido&pag=EditarPedidos'><img src='imagenes/delete.gif' border=0 alt='Eliminar Cliente'></A></TD></TR>";
	

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
       echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?id=".$ID."&pagina=".($pagina-1)."&orden=".$orden."&criterio=".$txt_criterio."&filEstado=".$filEstado."'>";
       echo "<font face='verdana' size='-2'>anterior</font>";
       echo "</a> ";
    }

    for($i=$inicio;$i<=$final;$i++)
    {
       if($i==$pagina)
       {
          echo "<font face='verdana' size='-2'><b>".$i."</b> </font>";
       }else{
          echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?id=".$ID."&pagina=".$i."&orden=".$orden."&criterio=".$txt_criterio."&filEstado=".$filEstado."'>";
          echo "<font face='verdana' size='-2'>".$i."</font></a> ";
       }
    }
    if($pagina<$numPags)
   {
       echo " <a class='p' href='".$_SERVER["PHP_SELF"]."?id=".$ID."&pagina=".($pagina+1)."&orden=".$orden."&criterio=".$txt_criterio."&filEstado=".$filEstado."'>";
       echo "<font face='verdana' size='-2'>siguiente</font></a>";
   }
//////////fin de la paginacion
?>
    </td></tr>
    </table>
</body>
</html>
<?php
    mysql_close();
?>