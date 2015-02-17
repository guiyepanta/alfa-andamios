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
	
    include_once('classes/productoAdmin.php');
?>

<!DOCTYPE html>
<!-- saved from url=(0057)http://livedemo00.template-help.com/wt_48140/index-3.html -->
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Alfa Andamios</title>
		<meta charset="utf-8">
		<meta name = "format-detection" content = "telephone=no" />
		<link rel="icon" type="image/png" href="images/icon.png">
		<link rel="shortcut icon" href="images/icon.png" />
		<link rel="stylesheet" href="css/style.css">
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/jquery-migrate-1.1.1.js"></script>
		<script src="js/script.js"></script>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0"> 
		<script src="js/superfish.js"></script>
		<script src="js/jquery.ui.totop.js"></script>
		<script src="js/jquery.equalheights.js"></script>
		<script src="js/jquery.mobilemenu.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/jquery.zoom.js"></script>	

		<script>

		$(document).ready(function(){            
			/*Back to Top*/
			$().UItoTop({ easingType: 'easeOutQuart' });
        	$('#ex1').zoom();
		}); 
		</script>

		<!--[if lt IE 8]>
			<div style=' clear: both; text-align:center; position: relative;'>
				<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
					<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
				</a>
			</div>
		<![endif]-->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<link rel="stylesheet" media="screen" href="css/ie.css">
		<![endif]-->
		<style>
			.zoom {
				display:inline-block;
				position: relative;
			}
			
			/* magnifying glass icon */
			.zoom:after {
				content:'';
				display:block; 
				width:33px; 
				height:33px; 
				position:absolute; 
				top:0;
				right:0;
				background:url(icon.png);
			}

			.zoom img {
				display: block;
			}
		</style>
	</head>
	<body id="top">
		<header> 
			<div class="main">
				<!--==============================header=================================-->
				<div class="container_12">
                    <div class="grid_12">
                        <h1>
                            <a href="index.php">
                            <img src="images/logo.png" alt="Your Happy Family">
                            </a>
                        </h1>
                        <div class="links">
                            <a href="#">Acceso Clientes</a>|<a href="sitemap.html">sitemap</a>| &nbsp;&nbsp;&nbsp;<span>tel: 011 4203 3005</span>
                        </div>
                        <div class="clear" />
                    </div>
                </div>    
			</div>
			<div class="menu_block">
				<div class="container_12">
					<div class="grid_12">
					
						<?php include_once("menu-top.php"); ?>
                        
                        <div class="socials">
                            <!--<a href="#"><i class="fa  fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-twitter "></i></a>
                            <a href="#"><i class="fa fa-pinterest "></i></a> 
                            <a href="#"><i class="fa  fa-linkedin"></i></a>-->
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </div>
                        <div class="clear"></div>
					</div>
				</div>
			</div>
		</header>
		<div class="page_bg">
			<div class="main">
				<!--==============================Content=================================-->
				<div class="content">
				  <div class="container_12 ">
					<div class="grid_8">
						<?php
							$idPrd = $_GET["id"];
							$detallePrd = new productoAdmin();
							$detallePrd->consulta($idPrd);
							$attrDisable="";
							
							foreach($detallePrd->_productoList as $prd) {
								if ($prd["imagen1"]!="")
									$urlImagen = $prd["imagen1"];
								else 
									$urlImagen = 'images/img_no_disp.png';

								if($prd["disponible"]==1){
									$attrDisable = "";
									$price = "$ ". number_format(round($prd["precio"], 2),2,',', '.') ." + IVA";
								} else {
									$attrDisable = "disabled='disabled'";
									$price = "";
								}
								
								if ($_SESSION["autorizacion_Login"]!=1) {
									$attrDisable = "disabled='disabled'";						
								}	
								echo '<h2 class="head1">'.$prd["tituloCategoria"].'</h2>';
								echo '<div id="galeria" style="float: left;">';
								echo '    <div>';
								echo '        <span class="zoom" id="ex1">';
								echo '            <img src="'.$urlImagen.'" id="imgGaleria" class="img_inner fleft" width="286" height="217">';								
								echo '        </span>';
								echo '    </div>';
								echo '    <div>';
								echo '        <img class="miniatura" onclick="javascript:document.getElementById(\'imgGaleria\').src=this.src; $(\'#ex1\').zoom();" src="'.$prd["imagen1"].'" onerror="imageError(this)" width="78"/>';
								if ($prd["imagen2"] != "")
									echo "        <img class=\"miniatura\" onclick=\"javascript:document.getElementById('imgGaleria').src=this.src; $('#ex1').zoom();\" src=\"".$prd["imagen2"]."\" width='78' />";
								if ($prd["imagen3"] != "")
									echo "        <img class=\"miniatura\" onclick=\"javascript:document.getElementById('imgGaleria').src=this.src; $('#ex1').zoom();\" src=\"".$prd["imagen3"]."\" width='78' />";
								echo '    </div>';
								echo '</div>';
								
								echo '<div class="extra_wrapper">';
								echo '    <div class="text1">'.$prd["titulo"].'</div>';
								echo $prd["detalle"];
								echo '<br><span class="price">'.$price.'</span>';
								echo '<br><button onclick="window.location.href=\'comprar-producto.php?id='.$prd["idProducto"].'\'" class="btn" '.$attrDisable.'>Comprar<i class="fa fa-arrow-right"></i></button>';
								echo '</div>';
								
								
							}
						?>
						
					</div>
					<div class="grid_4">
						<h2>Productos relacionados</h2>
						<div class="grid_3">
							<img src="images/page4_img2.jpg" alt="" class="img_inner">
							<div class="text1"><a href="#">Natus error sit volm accusan</a></div>
							<button class="btn">Ver detalle<i class="fa fa-arrow-right"></i></button>
						</div> 
					</div>
				  </div>
				</div>
				<!--==============================footer=================================-->
	        </div>
        </div>
        <footer>
            <div class="container_12">
                <div class="grid_3 ">
                    <div class="maxheight">
                        <a href="#" class="f_logo"><img src="images/logo.png" alt="" style="max-width: 75%;"></a>
                    </div>
                </div>
                <div class="grid_3 ver">
                    <div class="maxheight">
                        <h4>Tel&eacute;fonos</h4>
                        <ul>
                            <li><a href="#">(011) 4203-3005</a></li>
                            <li><a href="#">(011) 4214-4101</a></li>
                            <li><a href="#">(011) 4293-3769</a></li>
                        </ul>
                    </div>
                </div>
                <div class="none"></div>
                <div class="grid_3 ver">
                    <div class="maxheight">
                        <h4>E-mails</h4>
                        <ul class="mb0">
                            <li><a href="mailto:info@andamiosalfa.com.ar?subject=Contacto Web">info@andamiosalfa.com.ar</a></li>
                        </ul>
                    </div>
                </div>
                <div class="grid_3 ver">
                    <div class="maxheight">
                        <div class="copy">
                            <p>Andamios Alfa, es una empresa nacional con amplia trayectoria en el Mercado, especializada en la Fabricación e Importación de Andamios tubulares y sus accesorios como Tablones metálicos, Escaleras internas, Ruedas para andamio giratorias con freno, Nudos fijos y Móviles, Espigas de unión, Tornillones regulables, Puntales telescópicos, entre otros. Nuestros productos son utilizados en todo tipo de obras, actividades industriales, eventos, etc. Están disponibles tanto para el alquiler como para la venta.</p>
                            <div class="f_phone">011 4203 3005</div>
                            <span>
                                &copy; <span id="copyright-year"></span>  Alfa Andamios. <a href="index-6.html">Politicas de privacidad</a> <!--{%FOOTER_LINK} -->
                            </span>
                        </div>
                    </div>
                </div>
                <span class="clear"></span>
                <ul class="footer_menu">
                    <li class="current "><a href="index.html">Sobre Nosotros</a></li>
                    <li><a href="index-1.html">Productos</a></li>
                    <li><a href="index-2.html">Su Compra</a></li>
                    <li><a href="index-4.html">Servicios</a></li>
                    <li><a href="index-5.html">Contactos</a></li>
                </ul>
            </div>
        </footer>
    </body>
</html>