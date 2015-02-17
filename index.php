<?php 
	session_start();
	$linea = $_GET["linea"];
	$action=$_GET["action"];
	if($action=="logout")
	{
		unset($_COOKIE['idUsuario']);
		unset($_COOKIE['nombreUsuario']);
		$_SESSION["autorizacion_Login"] = "";
        $_SESSION["idPedido"] = "";
		header("location: index.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Alfa Andamios</title>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!--[if IE 6]>
        <link rel="stylesheet" type="text/css" href="css/iecss.css" />
        <![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://malsup.github.io/jquery.blockUI.js"></script>
		<script src="js/jquery.zoom.js"></script>			
        <script type="text/javascript" src="js/boxOver.js"></script>
        <script src="js/index.js"></script> 
        <script src="js/utils.js"></script>              
    </head>
    <body>
        <div id="main_container">
            <div id="header">
                <?php include_once 'header.php'; ?>	
            </div>
            <div id="main_content">
                <div id="menu_tab">
                    <?PHP include_once 'menu.php'; ?>
                </div>
                <!-- end of menu tab -->
                <div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
                <div class="left_content">
                    
                    <?php include_once 'menu-left.php'; ?>
                                        
                </div>
                <!-- end of left content -->
                <div class="center_content">
                    <!--
                    <div class="oferta">
                        <img src="images/p1.png" width="165" height="113" border="0" class="oferta_img" alt="" />
                        <div class="oferta_details">
                            <div class="oferta_title">Power Tools BST18XN Cordless</div>
                            <div class="oferta_text"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco </div>
                            <a href="http://www.free-css.com/" class="prod_buy">details</a> 
                        </div>
                    </div>
                    -->
                    <?php 
                    	$attrDisable="";
						
                    	$criterio = "";
						if ($linea!="")
							$criterio = " AND c.idlinea=" . $linea;
						
						if($_POST["inputSearch"]!="")
						  $criterio = " AND p.titulo LIKE '%" . $_POST["inputSearch"] . "%'";
						
						$sql="SELECT DISTINCT c.idCategoria, c.titulo 'tituloCategoria', p.idProducto, p.titulo, p.imagen1, p.precio, p.disponible FROM categoria c, productos p, lineas l  WHERE c.idCategoria = p.idCategoria AND l.idLinea=c.idLinea AND c.estado = 1 AND p.idEstado = 1 AND l.idEstado=1 ".$criterio." ORDER BY c.orden ASC, c.titulo ASC, p.titulo ASC";
                        
                        $resPrd=mysql_query($sql);
						$tituloCate = "";
						if(mysql_num_rows($resPrd)!=0) {
							while($prd=mysql_fetch_array($resPrd))
							{
						        if ($tituloCate != $prd["tituloCategoria"])
						        	echo "<div class='center_title_bar'>".$prd["tituloCategoria"]."</div>";
	
								echo "<div class='prod_box'>";
	                    		echo "		<div class='center_prod_box'>";
	                        	echo "			<div class='product_title'><a href='#' class='prod_details_link' data-id-prd='".$prd["idProducto"]."'>".$prd["titulo"]."</a></div>";
	                        	
	                        	if ($prd["imagen1"]!="")
	                        		echo "			<div class='product_img'><img src='".$prd["imagen1"]."' class='prod_details' data-id-prd='".$prd["idProducto"]."' style='border:none; cursor: pointer;' title='Ver detalle' /></div>";
								else 
									echo "			<div class='product_img'><img src='images/img_no_disp.png' class='prod_details' data-id-prd='".$prd["idProducto"]."' style='border:none; cursor: pointer;' title='Ver detalle' /></div>";
	                        	
	                        	if($prd["disponible"]==1){
	                        		$attrDisable = "";
	                        		echo "			<div class='prod_price'><span class='price'>$ ". number_format(round($prd["precio"], 2),2,',', '.') ." + IVA</span></div>";
								} else {
									$attrDisable = "disabled='disabled'";
									echo "			<div class='prod_price'><span class='price'>&nbsp;</span></div>";
								}
								if ($_SESSION["autorizacion_Login"]!=1) {
									$attrDisable = "disabled='disabled'";						
								}
	                    		echo "		</div>";
	                    		echo "		<div class='prod_details_tab'> <button class='prod_buy' data-id-prd='".$prd["idProducto"]."' $attrDisable>Agregar</button> <button class='prod_details' data-id-prd='".$prd["idProducto"]."'>Detalles</button> </div>";
	                			echo "</div>";
								$tituloCate = $prd["tituloCategoria"];						     
						    }
						} else{
							// Compruebo si estan todas las lineas cortadas	
							$sql="SELECT * FROM  lineas WHERE idEstado=1";
							$resVerify=mysql_query($sql);
							
							if(mysql_num_rows($resVerify)!=0) {
								echo "<div class='center_title_bar'>No hay registros para mostrar.</div>";
							}else{
								echo "<div class='center_title_bar'>No hay registros para mostrar.</div><br>Disculpe las molestias. Estamos trabajando en el Sitio.";
							}
						}
                    ?>
                    
                </div>
                <!-- end of center content -->
                <div class="right_content">
                	
                    <?php include_once 'menu-right.php'; ?>
                    
                </div>
                <!-- end of right content -->
            </div>
            <!-- end of main content -->
            
            <?php include_once 'footer.php'; ?>
            
        </div>
        <!-- end of main_container -->
        <script language="Javascript">
            document.oncontextmenu = function(){return false}
        </script>
    </body>
</html>