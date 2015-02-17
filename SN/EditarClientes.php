<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");

if ($_SESSION["autorizacion_LoginSN"]==0)
    Header("Location: fuera.htm");

    include ("conexion.php");

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
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://malsup.github.io/jquery.blockUI.js"></script>   
        <SCRIPT src="Javascript/funciones.js"></SCRIPT>
        <script>
        $(document).ready(function() { 
            $('.cliente_details').click(function(event) { 
                var target = $(event.target);
                var idCliente = target.attr('data-id-cliente');
                $.blockUI({
                        message: '<h1>cargando...</h1>',
                        css: { border: '1px solid #555' }
                });
                var postData = {
                    "idCliente" : idCliente
                };
                $.ajax({
                    url: 'detalleCliente.php',
                    type: 'POST',
                    data: postData,
                    success: function (data) {
                        $.blockUI({
                            message: data ,
                            css: { border: '2px solid #333', left: '25%', top: '25%', width: '504px', padding: '20px', '-moz-box-shadow': '0 20px 35px rgba(0,0,0,0.75)', '-webkit-box-shadow': '0 20px 35px rgba(0,0,0,0.75)', 'box-shadow': '0 20px 35px rgba(0,0,0,0.75)' }
                        });
                    },
                    complete: function() {
                        $('.btn_close').click(function() {
                            $.unblockUI();
                        });
                    },
                    error: function () {
                        $.unblockUI();
                    }
                });
            });
        }); 
        </script>
        
    </head>
<body bgcolor="#FFFFFF">
<?php

//inicializo el criterio y recibo cualquier cadena que se desee buscar
$ID = $_GET["id"];
$criterio = "";
$txt_criterio = "";

if ($_GET["cantRegistro"] == "")
    $cantRegistro = 10;
else 
    $cantRegistro = $_GET["cantRegistro"];

if ($_GET["criterio"]!=""){
   $txt_criterio = $_GET["criterio"];
   $criterio = " AND (nombre like '%" . $txt_criterio . "%' or apellido like '%" . $txt_criterio . "%' or empresa like '%" . $txt_criterio . "%')";
}

if ($_GET["filEstado"]!=""){
	$filEstado = $_GET["filEstado"];
	$criterio .= " AND estado=" . $filEstado;
}


$sql="SELECT idCliente, CONCAT(apellido, ', ', nombre) clie_nyap, empresa, estado, esta_desc FROM clientesportal, estados WHERE estado = esta_id" . $criterio;

$res=mysql_query($sql);
$numeroRegistros=mysql_num_rows($res);

    echo "<div align='center'>";
    echo "<form action=EditarClientes.php method='get'><div align='left'>";
?>
<TABLE width="100%" cellspacing='1' cellpadding='0'bgcolor='#ffffff' align=Center>
	<TR>
	<TD align=left width="30%">
	<?php
	echo "<font face='verdana' size='-2'>Clientes encontrados: <B>".$numeroRegistros;
	echo "</B>&nbsp;&nbsp;ordenados por <b>Nombre Cliente</b><div align='left'>";
	?>
	
	</TD>
	<td align="right" width="15%">
        <font face='verdana' size='-2'>Mostrar: </font>
        <?php
            if ($cantRegistro=="10")
            {
                echo "<SELECT id=cantRegistro name=cantRegistro style='WIDTH: 100px'>";
                echo "<option value='10' selected>10 Reg.</option><option value='25'>25 Reg.</option><option value='50'>50 Reg.</option>";
                echo "</SELECT>";
            } else if ($cantRegistro=="25"){
                echo "<SELECT id=cantRegistro name=cantRegistro style='WIDTH: 100px'>";
                echo "<option value='10'>10 Reg.</option><option value='25' selected>25 Reg.</option><option value='50'>50 Reg.</option>";
                echo "</SELECT>";
            } else if ($cantRegistro=="50"){
                echo "<SELECT id=cantRegistro name=cantRegistro style='WIDTH: 100px'>";
                echo "<option value='10'>10 Reg.</option><option value='25'>25 Reg.</option><option value='50' selected>50 Reg.</option>";
                echo "</SELECT>";
            }
        ?>
    </td>
    <td align="right" width="28%">
        <font face='verdana' size='-2'>[Busqueda]&nbsp;&nbsp;&nbsp;Estado: </font>
        <?php
            if ($filEstado=="")
            {
                echo "<SELECT id=filEstado name=filEstado style='WIDTH: 150px'>";
                echo "<option value='' selected>Todos</option><option value='1'>ACTIVO</option><option value='0'>INACTIVO</option>";
                echo "</SELECT>";
            } else if ($filEstado=="1"){
                echo "<SELECT id=filEstado name=filEstado style='WIDTH: 150px'>";
                echo "<option value=''>Todos</option><option value='1' selected>ACTIVO</option><option value='0'>INACTIVO</option>";
                echo "</SELECT>";
            } else if ($filEstado=="0"){
                echo "<SELECT id=filEstado name=filEstado style='WIDTH: 150px'>";
                echo "<option value=''>Todos</option><option value='1'>ACTIVO</option><option value='0' selected>INACTIVO</option>";
                echo "</SELECT>";
            }
        ?>
    </td>
    <TD align=Right width="27%">
    	<font face='verdana' size='-2'>Texto: </font>	
    	<input type="text" name="criterio" size="22" maxlength="150" value='<?php echo $txt_criterio; ?>' class="inputText">
    	<input type="hidden" name="id" value='<?php echo $ID; ?>'>
    	<input type="submit" value="Buscar" class="botones">
	</TD>
	</TR></TABLE>
	<?php
	echo "</font></form>";
	echo "<hr noshade style='color:023977; height:1px'>";    
    echo "</div>";


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

//////////fin de dicho calculo
?>
<TABLE width="750" cellspacing='1' cellpadding='3' bgcolor='#c3c3c3' align=Center>
  <TBODY>
  <TR>
		<TD align=left width="150" bgcolor="#c8e4ff">Mail</TD>
		<TD align=left bgcolor="#c8e4ff">Cliente</TD>
        <TD align=left bgcolor="#c8e4ff">Empresa</TD>
        <TD align=center bgcolor="#c8e4ff" width=100>Estado</TD>
        <TD align=center bgcolor="#c8e4ff" width=40>&nbsp;</TD>
        <TD align=center bgcolor="#c8e4ff" width=40>&nbsp;</TD>
  </TR>
<?php
$sql="SELECT idCliente, CONCAT(apellido, ', ', nombre) clie_nyap, empresa, estado, esta_desc FROM clientesportal, estados WHERE estado = esta_id" . $criterio . " ORDER BY clie_nyap LIMIT ".$limitInf.",".$tamPag;
$res=mysql_query($sql);

while($registro=mysql_fetch_array($res))
{
    $c++; 
    echo "<TR><TD bgcolor=#eAeAeA align=left><FONT size=2>". $registro["idCliente"] ."</FONT></TD>";
    echo "<TD bgcolor=#eAeAeA><FONT size=2><FONT size=2 color='#969594'>&nbsp;<B>". $registro["clie_nyap"] . "</B></FONT></FONT></TD>";
    echo "<TD bgcolor=#eAeAeA><FONT size=2><FONT size=2 color='#969594'>&nbsp;<B>". $registro["empresa"] . "</B></FONT></FONT></TD>";
    $div='divClie_' . $c;
    if ($registro["estado"]==1)
    	echo "<td bgcolor=#eAeAeA id='divClie_" . $c . "' align=center><img src='imagenes/on.png' onclick='activarCliente(\"". $registro["idCliente"] ."\",\"" . $div . "\", 0)' border=0 style='cursor: pointer;' /></td>";   
    else
    	echo "<td bgcolor=#eAeAeA id='divClie_" . $c . "' align=center><img src='imagenes/off.png' onclick='activarCliente(\"". $registro["idCliente"] ."\",\"" . $div . "\", 1)' border=0 style='cursor: pointer;' /></td>";
	
	echo "<TD bgcolor=#eAeAeA align=center valign=middle width=25><input type='image' class='cliente_details' data-id-cliente='". $registro["idCliente"] ."' src='imagenes/boton-ver.png' border='0' /></TD>";
    echo "<TD bgcolor=#eAeAeA align=center valign=middle width=25><A HREF='Delete_Generico.php?ID=". $registro["idCliente"] ."&tabla=clientesportal&Campo=idCliente&pag=EditarClientes'><img src='imagenes/delete.gif' border=0 alt='Eliminar Cliente'></A></TD></TR>";
       
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