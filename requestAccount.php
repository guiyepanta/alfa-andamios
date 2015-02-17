<?php
	header("Cache-Control: no-store, no-cache, must-revalidate");
    include_once("conexion.php");
    include_once("clases/Utils.php");
	
	$email = $_POST["email"];
	$ident = $_POST["ident"];
	$idCliente="";
    $clave="";
    $ok = false;
    $msjError="";
	// me fijo si existe el usuario con los datos ingresados
	if ($email!="" && $ident!="") {
    	$sql="SELECT idCliente, clave FROM clientesportal WHERE idCliente='$email' AND identificacion='$ident' AND estado=1 LIMIT 1";
    	$reg=mysql_query($sql);
        if(mysql_num_rows($reg) != 0)
    	{
    		$array=mysql_fetch_array($reg);	  
            $idCliente= $array["idCliente"];    
            $clave= mc_decrypt($array["clave"], "Optimus");
    	}	
    	//echo "idCliente : -$idCliente-";
    	if($idCliente!="")
    	{
    	    $dest = $idCliente;
            $head = "From: info@andamiosalfa.com.ar\r\nContent-type: text/html\r\n";
            
            $msg = "<html><head><style type='text/css'>";
            $msg.= ".titu {FONT-WEIGHT: bold; FONT-SIZE: 12px; BACKGROUND: #023977; COLOR: #FFFFFF; FONT-FAMILY: verdana}";
            $msg.= ".row1 {FONT-WEIGHT: normal; FONT-SIZE: 10px; BACKGROUND: #e3f1ff;  FONT-FAMILY: verdana; HEIGHT: 15px}";
            $msg.= ".row2 {FONT-WEIGHT: normal; FONT-SIZE: 10px; BACKGROUND: #EAEAEA; FONT-FAMILY: verdana; HEIGHT: 15px}";
            $msg.= ".titupagina {FONT-WEIGHT: bold; FONT-SIZE: 12px; BACKGROUND: #8f8f8f; COLOR: #ffffff; FONT-FAMILY: verdana}";
            $msg.= ".titupaginasolapa {FONT-WEIGHT: bold; FONT-SIZE: 12px; BACKGROUND: #e6e6e6; COLOR: #ffffff; FONT-FAMILY: verdana}";
            $msg.= "</style></head><body>";
            $msg.= "<BR><table height='22' width='460' border='0' cellspacing='0' cellpadding='0'>";
            $msg.= "<tr><td height='22' width='350' valign='middle' class='titupagina'>&nbsp;Solicitud de datos de acceso</td>";
            $msg.= "<td width='46' valign='top' class='titupaginasolapa'>&nbsp;</td><td>&nbsp;</td></tr></Table><br>";
            $msg.= "<table width='460' border='0' cellspacing='1' cellpadding='1' bgcolor='#ffffff'>";
            $msg.= "<tr><td width='460'>Le estamos enviando los datos de acceso para ingresar al sitio de compras de Alfa Andamios.</td></TR></Table>";
            
            $msg.= "<BR><table height='22' width='460' border='0' cellspacing='0' cellpadding='0'>";
            $msg.= "<tr><td height='22' width='350' valign='middle' class='titupagina'>&nbsp;Datos de acceso</td>";
            $msg.= "<td width='46' valign='top' class='titupaginasolapa'>&nbsp;</td><td>&nbsp;</td></tr></Table><BR>";          
            $msg.= "<table width='300' border='0' cellspacing='1' cellpadding='1' bgcolor='#ffffff'>";
            $msg.= "<tr><td width='100'>E-mail:</td><td>".$idCliente."</td></TR>";
            $msg.= "<tr><td width='100'>Clave:</td><td>".$clave."</td></TR></Table>";
    
            $ok = mail($dest, "Solicitud de datos de acceso", $msg, $head);		
    	}
        else{
            $msjError = "Los datos ingresados no son correctos o no pertenecen a una cuenta activa.";
        }	
	}
	
	if ($ok){
	   echo "TRUE";   
	}	   
    else {
        if ($msjError == "")
        {
            echo "FALSE-ERROR-SEND";
        } else {
            echo $msjError;
        }
    }
        
?>