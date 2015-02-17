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
        <link rel="stylesheet" href="css/camera.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/style.css">
		<script src="js/jquery-1.11.1.min.js"></script>
        <!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
        <script src="js/jquery-migrate-1.1.1.js"></script>
        <script src="js/script.js"></script> 
        <script src="js/superfish.js"></script>
        <script src="js/jquery.ui.totop.js"></script>
        <script src="js/jquery.equalheights.js"></script>
        <script src="js/jquery.mobilemenu.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="js/owl.carousel.js"></script> 
        <script src="js/camera.js"></script>
        <!--[if (gt IE 9)|!(IE)]><!-->
        <script src="js/jquery.mobile.customized.min.js"></script>
        <!--<![endif]-->
        <script>
            $(document).ready(function(){
            
            
            /////////////////////// camera with owl carousel //////////////////////////
            
             var $owl = $("#owl"),
                 $camera = $('#camera_wrap');
            /* carousel */
             $owl.owlCarousel({
                 items : 3, //10 items above 1000px browser width
                 itemsDesktop : [995,3], //5 items between 1000px and 901px
                 itemsDesktopSmall : [767, 2], // betweem 900px and 601px
                 itemsTablet: [700, 2], //2 items between 600 and 0
                 itemsMobile : [479, 1], // itemsMobile disabled - inherit from itemsTablet option
                 navigation : true,
                 pagination :  false
             });
            
            $camera.camera({
                 loader: false,
                 pagination: true,
                 minHeight: '300',
                 thumbnails: false,
                 height: '53.54077253218884%',
                 caption: true,
                 navigation: false,
                 fx: 'mosaic',
                 time: 4000,
                 onStartTransition:function(){
                   var ind = $camera.find('.camera_pag_ul>li.cameracurrent').index();
                   (ind < 0)&&(ind = 0);
            
                   $('.item', $owl)
                     .removeClass('active')
                     .eq(ind).addClass('active');
            
                   $owl
                     .data('owlCarousel')
                     .goTo(ind);
                 }
               });
               
             $owl.find('.item a').click(function(){
               var $this = $(this),
                   ind = $this.parents('.owl-item').index();
               $('.camera_pag_ul>li').eq(ind).click();
               return false;
             })
            
             /////////////////////// end of camera with owl carousel //////////////////////////
                 
            
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
    <body class="page1" id="top">
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
                <div class="container_12">
                    <div class="grid_12">
                        <div class="slider_wrapper">
                            <div id="camera_wrap" class="">
                                <div data-src="images/slide.jpg"></div>
                                <div data-src="images/slide1.jpg"></div>
                                <div data-src="images/slide2.jpg"></div>
                                <div data-src="images/slide3.jpg"></div>
                            </div>
                            <div class="car_div">
                                <div id="owl">
                                    <div class="item active" ><a href="#"><img src="images/thumb.jpg" alt=""></a></div>
                                    <div class="item"><a href="#"><img src="images/thumb1.jpg" alt=""></a></div>
                                    <div class="item"><a href="#"><img src="images/thumb2.jpg" alt=""></a></div>
                                    <div class="item"><a href="#"><img src="images/thumb3.jpg" alt=""></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--==============================Content=================================-->
                <div class="content">
                    <div class="container_12 center">
                        <div class="grid_12">
                            <h2>Excelencia en Andamios por más de XX años!<span>En constante búsqueda de la excelencia.</span></h2>
                        </div>
                        <div class="grid_3 margin-left-9">
                            <a class="icn nuestra-empresa" href="#"><!--<i class="fa fa-clock-o"></i>--></a>
                            <div class="title"><a href="#">Nuestra Empresa</a></div>
                            Andamios Alfa es una empresa nacional de larga trayectoria, en la que nos especializamos en la fabricación, 
                            venta y alquiler de Andamios tubulares y sus accesorios para su utilización en todo tipo de obras, actividades industriales, eventos, etc.
                            <br>El lugar que ocupamos en el sector, como fabricantes, nos posiciona muy ventajosamente en el mercado ya que contamos con 
                            permanente stock, entrega inmediata y los precios más bajos.
                        </div>
                        <div class="grid_3">
                            <a class="icn nuestros-productos" href="#"><!--<i class="fa  fa-star"></i>--></a>
                            <div class="title"><a href="#">Nuestros Productos</a></div>
                            Nuestros productos están disponibles tanto para el alquiler como para la venta: Andamios tubulares, Andamios Multidireccionales, 
                            Tablones metálicos, Escaleras internas, Ruedas fijas y giratorias, Nudos fijos y giratorios, Espigas de unión, Tornillones regulables, 
                            Vallas de contención, Caballetes regulables en altura, Puntales telescópicos y también otros elementos para las obras, tales como carretillas, 
                            carros transportadores, etc.
                        </div>
                        <div class="grid_3">
                            <a class="icn nuestros-servicios" href="#"><!--<i class="fa fa-globe"></i>--></a>
                            <div class="title"><a href="#">Nuestros Servicios</a></div>
                            Nuestro eficiente departamento de logística, la utilización de vehículos propios y una estratégica ubicación, nos permite realizar a diario 
                            un gran número de entregas y retiros de material en diferentes puntos del Gran Buenos Aires y Capital Federal. En Andamios Alfa estamos en la 
                            búsqueda constante de la excelencia, lo cual se hace posible, además, gracias al grupo de colaboradores que forman parte de nuestra empresa.
                        </div>
                    </div>
                    <!--
                    <div class="container_12">
                        <div class="grid_12">
                            <h2 class="head1 center">Providing asphalt paving solution for any demand<span>We are capable of all types of asphalt paving</span></h2>
                        </div>
                        <div class="grid_3">
                            <img src="images/page1_img1.jpg" alt="" class="img_inner">
                            <div class="text1">Vestibulum liorta vel, scelerisque</div>
                            Vestibululis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, constetuer adipiscing elit. Pelleesque sed dolor. Aliquam congue.
                            <br>
                            <a href="#" class="btn">learn more<i class="fa  fa-arrow-right"></i></a>
                        </div>
                        <div class="grid_3">
                            <img src="images/page1_img2.jpg" alt="" class="img_inner">
                            <div class="text1">Malesuada at, neque vivamus eget</div>
                            Vestibululis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, constetuer adipiscing elit. Pelleesque sed dolor. Aliquam congue.
                            <br>
                            <a href="#" class="btn">learn more<i class="fa  fa-arrow-right"></i></a>
                        </div>
                        <div class="grid_3">
                            <img src="images/page1_img3.jpg" alt="" class="img_inner">
                            <div class="text1">Vivamus eget nibhiam cursus leo vel</div>
                            Vestibululis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, constetuer adipiscing elit. Pelleesque sed dolor. Aliquam congue.
                            <br>
                            <a href="#" class="btn">learn more<i class="fa  fa-arrow-right"></i></a>
                        </div>
                        <div class="grid_3">
                            <img src="images/page1_img4.jpg" alt="" class="img_inner">
                            <div class="text1">Aenean necibulum ante ipsum primis in</div>
                            Vestibululis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, constetuer adipiscing elit. Pelleesque sed dolor. Aliquam congue.
                            <br>
                            <a href="#" class="btn">learn more<i class="fa  fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="feedback">
                        <div class="container_12">
                            <div class="grid_8">
                                <div class="f_title">We are interested in hearing from you. </div>
                                <span>Write about your primary interest right now! </span>
                            </div>
                            <div class="grid_4"><a href="#">Submit the form</a></div>
                        </div>
                    </div>
                    <div class="container_12">
                        <div class="grid_12">
                            <figure class="vimeo">
                                <iframe class="js-resize" src="http://player.vimeo.com/video/25924530?title=0&amp;byline=0&amp;portrait=0"></iframe>
                            </figure>
                            <div class="extra_wrapper">
                                <div class="new">
                                    <img src="images/page1_img5.jpg" alt="" class="img_inner fleft noresize">
                                    <div class="extra_wrapper">
                                        <time datetime="2013-01-01">12/10/2013<span><a href="#">Liorta vel, scelerisque</a></span></time>Fusce euismod c ante. Lorem ipsum dolor sit amet, conser adipcing elit. Pelleesque sed dolor. 
                                    </div>
                                </div>
                                <div class="new">
                                    <img src="images/page1_img6.jpg" alt="" class="img_inner fleft noresize">
                                    <div class="extra_wrapper">
                                        <time datetime="2013-01-01">12/10/2013<span><a href="#">Liorta vel, scelerisque</a></span></time>Fusce euismod c ante. Lorem ipsum dolor sit amet, conser adipcing elit. Pelleesque sed dolor. <br><a href="#" class="btn">view all <i  class="fa  fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="alright">
                                </div>
                            </div>
                        </div>
                        <div class="grid_3">
                            <em class="st1">
                            <span class="upp">Concrete Services: </span><a href="#">Roads</a>, <a href="#">parking lots</a>, <a href="#">sidewalks</a>, <a href="#">curbs</a>, and <a href="#">gutters</a>
                            </em>
                        </div>
                        <div class="grid_3">
                            <h3>Quisque nulla</h3>
                            <ul class="list">
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Sed ut perspicia omnis iste </a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Natus error sit voluptatem </a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Accusantium doloremque </a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Kaudantium, totam rem aperiam </a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Eaque ipsa quae ab illo inventore </a></div>
                                </li>
                            </ul>
                        </div>
                        <div class="grid_3">
                            <h3>Proin ullamcorper urna</h3>
                            <ul class="list">
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Quisque nulla  stibulum</a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Nisl, porta vel, scesque eget</a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Malesuada at, neque</a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Vivamus eget nibh</a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Etiam cursus leo vel</a></div>
                                </li>
                            </ul>
                        </div>
                        <div class="grid_3">
                            <h3>Voluptas nulla pariatur</h3>
                            <ul class="list">
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Vestibulum iaculis</a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Proin dictum elementum</a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Fusce euismod consequat</a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Lorem ipsum dolor</a></div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <div><a href="#">Consectetuer adipiscing </a></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    -->                    
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