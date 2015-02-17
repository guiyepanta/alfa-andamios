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
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alfa Andamios</title>
        <meta charset="utf-8">
        <meta name = "format-detection" content = "telephone=no" />
        <link rel="icon" type="image/png" href="images/icon.png">
        <link rel="shortcut icon" href="images/icon.png" />
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="css/style.css">	    
	    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0"> 
	    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="js/jquery-migrate-1.1.1.js"></script>
	    <script src="js/script.js"></script>
	    <script src="js/superfish.js"></script>
	    <script src="js/jquery.ui.totop.js"></script>
	    <script src="js/jquery.equalheights.js"></script>
	    <script src="js/jquery.mobilemenu.js"></script>
	    <script src="js/jquery.easing.1.3.js"></script>
	    <script src="js/TMForm.js"></script>
        <!--[if (gt IE 9)|!(IE)]><!-->
        <script src="js/jquery.mobile.customized.min.js"></script>
        <!--<![endif]-->
        <script>
            $(document).ready(function(){
            	/*Back to Top*/
            	$().UItoTop({ easingType: 'easeOutQuart' });             
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
    </head>
    <body id="top" class="page2">
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
                            <a href="login.php">Acceso Clientes</a>|<a href="sitemap.html">sitemap</a>| &nbsp;&nbsp;&nbsp;<span>tel: 011 4203 3005</span>
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
	                    <div class="grid_5">
	                        <h2>Contactos</h2>
	                        <address>
                                <dl>
                                	<dt class="text1">Tel&eacute;fonos</dt>
                                    <dd><span style="font-size: 24px;">(011) 4203-3005</span></dd>
                                    <dd><span style="font-size: 24px;">(011) 4214-4101</span></dd>
                                    <dd><span style="font-size: 24px;">(011) 4293-3769</span></dd>
                                    
                                    <dt class="text1">E-mails</dt>
                                    <dd><span style="font-size: 24px;">info@andamiosalfa.com.ar</span></dd>
                                    <!--<dt class="text1">
                                        Av Hipólito Yrigoyen 13551.
                                        <br />Adrogué - Pcia. de Buenos Aires
                                    </dt>
                                    <dd><span>Telephone:</span>+1 959  603 6035</dd>
                                    <dd><span>FAX:</span>+1 504  889 9898</dd>
                                    <dd>E-mail: <a href="http://livedemo00.template-help.com/wt_48140/index-5.html#" class="">mail@demolink.org</a></dd>
                                  -->
                                </dl>
                            </address>
	                    </div>
	                    <div class="grid_7">	                        
                            <h2>Dirección</h2>
	                        <div class="map">
	                            <figure class="">
	                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3275.7352118486288!2d-58.3991474!3d-34.812602999999996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcd366140aa3d7%3A0x866d8577d7a9173!2sAv+Hip%C3%B3lito+Yrigoyen+13551%2C+Malvinas+Argentinas%2C+Buenos+Aires!5e0!3m2!1sen!2sar!4v1410621263634"></iframe>
	                            </figure>
	                            <address>
	                                <dl>
	                                    <dt class="text1">
	                                        Av Hipólito Yrigoyen 13551.
	                                        <br />Adrogué - Pcia. de Buenos Aires
	                                    </dt>	                                    
	                                </dl>
	                            </address>
	                        </div>
	                    </div>
	                </div>
					<div class="logos">
                        <div class="container_12">
                            <div class="grid_12">
                                <h2>Medios de pago:</h2>
                                <ul>
                                    <li><a href="#"><img src="images/logo-mercadopago.png" alt=""></a></li>
                                    <li><a href="#"><img src="images/logo-visa.png" alt=""></a></li>
                                    <li><a href="#"><img src="images/logo-mastercard.png" alt=""></a></li>
                                    <li><a href="#"><img src="images/logo-amex.png" alt=""></a></li>
                                    <li><a href="#"><img src="images/logo-pagofacil.png" alt=""></a></li>
                                    <li><a href="#"><img src="images/logo-banelco.png" alt=""></a></li>
                                </ul>
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