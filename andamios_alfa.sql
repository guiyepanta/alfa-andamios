-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-02-2015 a las 16:46:25
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `andamios_alfa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `idLinea` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idCategoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `idLinea`, `titulo`, `orden`, `estado`) VALUES
(1, 1, 'Andamios Tubulares', 0, 1),
(2, 1, 'Barandas de protección', 1, 1),
(3, 4, 'Prueba categoria', 5, 1),
(4, 5, 'Accesorios para Andamios', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientesportal`
--

CREATE TABLE IF NOT EXISTS `clientesportal` (
  `idCliente` varchar(50) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codigoPostal` varchar(15) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `pais` varchar(30) NOT NULL,
  `telefonos` varchar(30) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `empresa` varchar(50) DEFAULT NULL,
  `identificacion` varchar(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`idCliente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `clientesportal`
--

INSERT INTO `clientesportal` (`idCliente`, `nombre`, `apellido`, `direccion`, `codigoPostal`, `ciudad`, `pais`, `telefonos`, `clave`, `empresa`, `identificacion`, `estado`) VALUES
('panta23@gmail.com', 'Gisela Beatriz', 'Mansilla', 'Solano Lopez 2162 4to A', '1419', 'Cap Fed - Buenos Aires', 'Argentina', '6545-5545', 'VwDtPpw+R7yC3rjJ7jMxzbN3LFDKahb1eI/CaRBK9ns=', 'Dist. SuCosmeticos', '26530472', 1),
('panta51@hotmail.com', 'Guillermo Maxi', 'Pantanetti', 'Solano Lopez 2162 4to A', '1419', 'Cap Fed - Buenos Aires', 'Argentina', '4573-5118', 'VwDtPpw+R7yC3rjJ7jMxzbN3LFDKahb1eI/CaRBK9ns=', 'Studio Quatro', '27022506', 1),
('usuario.portal@hotmail.com', 'Usuario', 'Prueba', 'fgddfg 454', '1419', 'CABA', 'Argentina', '11-254545', 'VwDtPpw+R7yC3rjJ7jMxzbN3LFDKahb1eI/CaRBK9ns=', 'Nombre Empresa', '22111111113', 1),
('luna@mucho.com', 'Luna', 'Pantanetti', 'Habana 2556', '1419', 'CABA', 'Argentina', '4573-5118', 'aI4TEE+hxGesgFmo2gf2v5dK90tpGzXd+TvDL96GFvk=', 'Luna Roba', '46211001', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopedidos`
--

CREATE TABLE IF NOT EXISTS `estadopedidos` (
  `idEstado` int(11) NOT NULL,
  `Detalle` varchar(25) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `estadopedidos`
--

INSERT INTO `estadopedidos` (`idEstado`, `Detalle`) VALUES
(1, 'En confeccion'),
(2, 'Esperando Acreditacion'),
(3, 'Acreditado'),
(4, 'Paga al retirar'),
(5, 'Facturado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `esta_id` int(11) NOT NULL AUTO_INCREMENT,
  `esta_desc` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`esta_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `estados`
--

INSERT INTO `estados` (`esta_id`, `esta_desc`) VALUES
(1, 'ACTIVO'),
(0, 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE IF NOT EXISTS `lineas` (
  `idLinea` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `orden` int(10) DEFAULT '0',
  `idEstado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idLinea`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`idLinea`, `titulo`, `orden`, `idEstado`) VALUES
(1, 'Andamios Tubulares', 0, 1),
(2, 'Andamios Multidireccionales', 1, 1),
(3, 'Escaleras de aluminio', 2, 1),
(4, 'Puntales telescopicos', 5, 1),
(5, 'Accesorios p/ andamios', 4, 1),
(6, 'Carros portabultos', 3, 1),
(7, 'Maquinas', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_portada`
--

CREATE TABLE IF NOT EXISTS `notas_portada` (
  `nopo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nopo_titu` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nopo_fecha` date NOT NULL DEFAULT '0000-00-00',
  `nopo_intro` varchar(125) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nopo_desa` longtext COLLATE latin1_general_ci NOT NULL,
  `nopo_img` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nopo_esta_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nopo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `notas_portada`
--

INSERT INTO `notas_portada` (`nopo_id`, `nopo_titu`, `nopo_fecha`, `nopo_intro`, `nopo_desa`, `nopo_img`, `nopo_esta_id`) VALUES
(1, 'Quienes Somos?', '2011-06-07', 'Quienes Somos?', 'Hugo Daizo Cosmética es una distribuidora de cosméticos y productos integrales para el negocio de la cosmética y la estética profesional, siendo su área de influencia el norte y el oeste del Gran Buenos Aires e inclusive algunas zonas del interior del país.<BR>A lo largo de sus 13 años de trayectoria en el mercado, se ha caracterizado por ofrecer un servicio de entrega sin cargo, rápido y seguro debido a que cuenta con un stock completo y permanente en todas las marcas que comercializa.<BR>Las mismas pertenecen a prestigiosas empresas y laboratorios del sector quienes le han confiado su distribución: Lidherma, Exel, Icono, Idraet, Zine, Mila Marzi, Andrea Pellegrino, Alambique, Fundar, Pharmatrix. Asimismo, Hugo Daizo Cosmética ha desarrollado una serie de líneas de productos en el rubro de los descartables y las ceras para depilación. <BR>A la brevedad, Hugo Daizo Cosmética estará ampliando su local de ventas en el cual contará con un completo showroom y confortables espacios destinados a dar cursos de capacitación, charlas y presentación de productos. <BR>Ello significará un paso más en el crecimiento de este importante distribuidor de cosméticos en que se ha transformado Hugo Daizo Cosmética y le permitirá optimizar los servicios de distribución e información para los profesionales del gremio. ', 'Pera.PNG', 1),
(2, 'Como comprar', '2011-06-07', 'como comprar', '<P>A partir de ahora Ud. podrá disponer mejor de su tiempo labo- ral, sin gastar en llamados telefónicos desde el Interior, sin pérdidas de tiempo. Teniendo a la vista y de manera organiza- da todos los productos y precios, a medida que va armando su pedido. Y mediante un simple click, su pedido se recibe de ma- nera inmediata en nuestras oficinas y Ud. recibe un mail de confirmación del mismo. A continuación, le explicamos de qué manera tan simple se lleva a cabo este proceso de pedido de mercadería:<BR><STRONG>Paso 1</STRONG><BR>En la botonera del margen izquierdo aparecen los productos ordenados.<BR>Ud. hace click en el rubro de su interés y se despliegan en el centro de la pagina los productos correspondientes a dicho rubro.<BR><STRONG>Paso 2</STRONG><BR>Los productos se muestran de a 3 por cada página y están ordenados de manera alfabética para mayor comodidad. Para ver más productos del rubro, hay que hacer click en la parte inferior donde dice "siguiente".<BR><STRONG>Paso 3<BR></STRONG>Si desea obtener mayor información acerca de un producto, debe hacer click en la frase "ver más &gt;&gt;"<BR><STRONG>Paso 4<BR></STRONG>Si directamente desea hacer el pedido, se debe hacer click sobre el carrito que aparece en la parte inferior derecha de cada producto.<BR><STRONG>Paso 5</STRONG><BR>Una vez que hacemos click sobre el carrito se muestra una nueva página en la cual en la parte inferior izquierda dice "cantidad de unidades" y a su derecha hay una ventana en blanco.<BR><STRONG>Paso 6</STRONG><BR>En dicha ventana se escribe la cantidad de unidades que se desea pedir. Acto seguido, se hace click en el boton "agregar" que está ubicado en la parte inferior derecha.<BR><STRONG>Paso 7</STRONG><BR>Al hacer ésto, se muestra una nueva página en la cual aparece la confirmación del nombre del producto y de la cantidad solicitada. <BR><STRONG>Paso 8</STRONG><BR>En esta misma pagina a la derecha del producto aparece una cruz en color rojo. Esta cruz es para anular el pedido de dicho producto en caso de que hubiera un error en el pedido, tanto en la cantidad solicitada como en el producto en si mismo.<BR><STRONG>Paso 9<BR></STRONG>Asimismo, en esta misma página en la parte inferior aparece un boton "Seguir Pidiendo". Se hace click allí si se desea pedir más productos.<BR><STRONG>Paso 10</STRONG><BR>Cuando ya se han solicitado todos los productos, se debe hacer click en el boton "Finalizar Pedido". Acto seguido aparece una nueva ventana en la cual aparece un formulario que debe completarse de manera muy simple, una vez hecho lo cual, se hace click en enviar, dando por finalizado el pedido. A la brevedad, nos comunicaremos con Ud. para coordinar las formas de pago y de envío.</P>', 'Guitar-Fire.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `fecha` varchar(15) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcar la base de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `usuario`, `fecha`, `estado`) VALUES
(10, 'panta51@hotmail.com', '2014-09-14', 3),
(13, 'panta23@gmail.com', '15-09-2014', 5),
(14, 'panta23@gmail.com', '15-09-2014', 5),
(15, 'panta23@gmail.com', '15-09-2014', 2),
(17, 'panta51@hotmail.com', '21-09-2014', 4),
(18, 'panta51@hotmail.com', '21-09-2014', 4),
(19, 'usuario.portal@hotmail.com', '23-09-2014', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosdetalles`
--

CREATE TABLE IF NOT EXISTS `pedidosdetalles` (
  `idDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `precio` decimal(10,4) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`idDetalle`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

--
-- Volcar la base de datos para la tabla `pedidosdetalles`
--

INSERT INTO `pedidosdetalles` (`idDetalle`, `idPedido`, `idProducto`, `precio`, `cantidad`) VALUES
(120, 10, 4, '5.4900', 30),
(119, 10, 7, '111.9900', 15),
(118, 11, 2, '25.4900', 270),
(117, 11, 8, '220.0000', 10),
(116, 11, 6, '111.2200', 110),
(115, 10, 3, '15.4900', 40),
(121, 10, 1, '15.0000', 2),
(122, 12, 5, '7.4900', 25),
(123, 12, 8, '220.0000', 3),
(124, 12, 6, '111.2200', 50),
(125, 12, 9, '0.9900', 1000),
(126, 12, 7, '111.9900', 20),
(127, 13, 3, '15.4900', 10),
(128, 13, 2, '25.4900', 2),
(129, 14, 5, '7.4900', 4),
(130, 14, 9, '0.9900', 100),
(132, 15, 7, '111.9900', 20),
(133, 15, 8, '220.0000', 2),
(135, 17, 1, '15.0000', 2),
(136, 18, 2, '25.4900', 45),
(137, 19, 3, '15.4900', 245),
(138, 16, 2, '25.4900', 2),
(139, 16, 11, '100.0000', 25),
(140, 16, 8, '220.0000', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `detalle` varchar(1000) NOT NULL,
  `imagen1` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `imagen2` varchar(500) DEFAULT NULL,
  `imagen3` varchar(500) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `idEstado` int(11) NOT NULL DEFAULT '0',
  `disponible` int(11) NOT NULL DEFAULT '1',
  `iva` decimal(10,2) NOT NULL DEFAULT '21.00',
  PRIMARY KEY (`idProducto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `idCategoria`, `titulo`, `detalle`, `imagen1`, `imagen2`, `imagen3`, `precio`, `idEstado`, `disponible`, `iva`) VALUES
(1, 1, 'Standard', '1.30 X 1.95 X 2.00 Mts.', 'imagenesProductos/1397335822-img1-prueba-2014-02-26.png', '', '', '15.00', 1, 1, '21.00'),
(2, 1, 'Standard', '1.30 X 1.95 X 2.50 Mts.', 'imagenesProductos/1397335133-img1-logo.png', '', '', '25.49', 1, 1, '21.00'),
(3, 1, 'Pasillo', '0.95 X 1.95 X 2.00 Mts.', 'imagenesProductos/1397335112-img1-av-grey.jpg', '', '', '15.49', 1, 1, '21.00'),
(4, 2, 'Standard', '1.30 X 0.90 X 2.00 Mts.', '', '', '', '5.49', 1, 1, '21.00'),
(5, 2, 'Standard', '1.30 X 0.90 X 2.50 Mts.', 'imagenesProductos/1410716640-img1-grupo-b.jpg', 'imagenesProductos/1410716640-img2-brasil-croacia.jpg', '', '7.49', 1, 1, '21.00'),
(9, 3, 'Prueba con nuevo Editor', '<p>Esto es un <font color="#cc66cc">texto </font>desde el <font color="#00cccc">editor</font></p>', 'imagenesProductos/1410716188-img1-brasil-croacia.jpg', '', '', '0.99', 1, 1, '21.00'),
(7, 3, 'Prueba Producto 02', '(Valor con 2 decimales ejemp: ####,##)', 'imagenesProductos/1397336154-img1-conejoMatrix.png', '', '', '111.99', 1, 1, '21.00'),
(8, 4, 'Escaleras Internas con barandas', '(Valor con 2 decimales ejemp: ####,##)', 'imagenesProductos/1397761272-img1-escalera01.png', 'imagenesProductos/1397761272-img2-escalera02.png', 'imagenesProductos/1397761272-img3-escalera03.png', '220.00', 1, 1, '21.00'),
(10, 3, 'Nueva Prueba', '<font color="#ff0000"><u><i>Holaaaaa</i></u></font><div><i>Esto es un <font color="#cc66cc">texto </font>desde el <font color="#00cccc">editor</font></i></div><div><i><font color="#666666">Otro Renglon...</font></i></div><div><i><font color="#330099"><b>Otro más...</b></font></i></div>', 'imagenesProductos/1410716016-img1-grupo-d.jpg', 'imagenesProductos/1410716016-img2-grupos-g.jpg', 'imagenesProductos/1410716016-img3-grupos-f.jpg', '0.99', 1, 1, '21.00'),
(11, 1, 'Prueba Producto 0002', 'Prueba Producto 0002<div>Prueba Producto 0002</div>', 'imagenesProductos/1412211803-img1-prueba-2014-02-26.png', '', '', '100.00', 1, 1, '10.50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(10) NOT NULL DEFAULT '',
  `CLAVE` varchar(10) DEFAULT NULL,
  `NOMBRE_APELLIDO` varchar(25) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `ID_ESTADO` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_USUARIO`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `USUARIO`, `CLAVE`, `NOMBRE_APELLIDO`, `EMAIL`, `ID_ESTADO`) VALUES
(1, 'admin', 'admin', 'Andamios Alfa', 'panta51@hotmail.com', 1),
(5, 'admin', 'Semana01', 'Studio Quatro', 'panta51@hotmail.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
