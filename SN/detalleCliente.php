<html>
<head>
	<style>
		
		body {FONT-WEIGHT: normal; FONT-SIZE: 10px; COLOR: #555555; FONT-FAMILY: verdana}
		.titu {FONT-WEIGHT: bold; FONT-SIZE: 11px; BACKGROUND: #023977; COLOR: #FFFFFF; FONT-FAMILY: verdana}
		.row1 {FONT-WEIGHT: normal; FONT-SIZE: 12px; BACKGROUND: #e3f1ff;  FONT-FAMILY: verdana; HEIGHT: 15px}
		.row2 {FONT-WEIGHT: normal; FONT-SIZE: 12px; BACKGROUND: #EAEAEA; FONT-FAMILY: verdana; HEIGHT: 15px}
		.row {FONT-WEIGHT: normal; FONT-SIZE: 10px; BACKGROUND: #ffffff; FONT-FAMILY: verdana; HEIGHT: 15px}
		.titupagina {FONT-WEIGHT: bold; FONT-SIZE: 11px; BACKGROUND: #8f8f8f; COLOR: #ffffff; FONT-FAMILY: verdana}
		.titupaginasolapa {FONT-WEIGHT: bold; FONT-SIZE: 11px; BACKGROUND: #e6e6e6; COLOR: #ffffff; FONT-FAMILY: verdana}
		.btn_close {
                -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
                -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
                box-shadow:inset 0px 1px 0px 0px #ffffff;
                background-color:#ededed;
                -webkit-border-top-left-radius:6px;
                -moz-border-radius-topleft:6px;
                border-top-left-radius:6px;
                -webkit-border-top-right-radius:6px;
                -moz-border-radius-topright:6px;
                border-top-right-radius:6px;
                -webkit-border-bottom-right-radius:6px;
                -moz-border-radius-bottomright:6px;
                border-bottom-right-radius:6px;
                -webkit-border-bottom-left-radius:6px;
                -moz-border-radius-bottomleft:6px;
                border-bottom-left-radius:6px;
                text-indent:0;
                border:1px solid #dcdcdc;
                display:inline-block;
                color:#777777;
                font-family:arial;
                font-size:16px;
                font-weight:bold;
                font-style:normal;
                height:26px;
                line-height:26px;
                margin-bottom: 5px;
                width:70px;
                text-decoration:none;
                text-align:center;
                text-shadow:1px 1px 0px #ffffff;
                margin-top: 15px;
                float: right;
            }
            .btn_close:hover {
                background-color:#dfdfdf;
            }
	</style>
</head>
<body>

<?php
	include ("conexion.php");
    
    $idCliente = $_POST["idCliente"];
	$htmlMsj .= "#USUARIO#";
    
    $sql="SELECT idCliente, nombre, apellido, direccion, codigoPostal, ciudad, pais, telefonos, empresa, identificacion FROM clientesportal WHERE idCliente = '". $idCliente ."'";
	$datosUser = mysql_query($sql, $link);	
	$error = mysql_errno($link) . ":" . mysql_error($link);
		
	if(mysql_num_rows($datosUser)!=0) {
		$user=mysql_fetch_array($datosUser);			
		
		$htmlUser = "<table height='22' width='460' border='0' cellspacing='0' cellpadding='0'>";
		$htmlUser .= "<tr><td height='22' width='350' valign='middle' class='titupagina'>&nbsp;Datos Personales</td>";
		$htmlUser .= "<td width='46' valign='top' class='titupaginasolapa'>&nbsp;</td><td>&nbsp;</td></tr></Table><BR>";			
		$htmlUser .= "<table width='500' border='0' cellspacing='1' cellpadding='1' bgcolor='#ffffff'>";
		$htmlUser .= "<tr><td width='150' class='row1'>Apellido, Nombre:</td><td class='row2'>".$user["apellido"].", ".$user["nombre"]."</td></TR>";
		$htmlUser .= "<tr><td width='150' class='row1'>E-mail:</td><td class='row2'>".$user["idCliente"]."</td></TR>";
        $htmlUser .= "<tr><td width='150' class='row1'>Identificacion:</td><td class='row2'>".$user["identificacion"]."</td></TR>";
        $htmlUser .= "<tr><td width='150' class='row1'>Empresa:</td><td class='row2'>".$user["empresa"]."</td></TR>";
		$htmlUser .= "<tr><td width='150' class='row1'>Direccion:</td><td class='row2'>".$user["direccion"]." CP:".$user["codigoPostal"]."</td></TR>";
		$htmlUser .= "<tr><td width='150' class='row1'>Ciudad:</td><td class='row2'>".$user["ciudad"]."</td></TR>";
		$htmlUser .= "<tr><td width='150' class='row1'>Pais:</td><td class='row2'>".$user["pais"]."</td></TR>";
		$htmlUser .= "<tr><td width='150' class='row1'>Telefono:</td><td class='row2'>".$user["telefonos"]."</td></TR></Table>";

		$htmlMsj =  str_replace("#USUARIO#", $htmlUser, $htmlMsj);					
	}	
	echo $htmlMsj;
?>
<a href="#" class="btn_close">Cerrar</a>
</body>
</html>
