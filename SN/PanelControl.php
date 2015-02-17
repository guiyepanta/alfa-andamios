<?PHP
header("Cache-Control: no-store, no-cache, must-revalidate");
session_start();
if ($_SESSION["autorizacion_LoginSN"]==0)
    Header("Location: fuera.htm");
	
$NombreUsuario=$_COOKIE["Nombre_Usuario"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<HEAD>
		<TITLE>:: Stream NET :: By Studio Quatro ::</TITLE>
		<META http-equiv=Content-Type content="text/html; charset=utf-8">
		<LINK href="Estilos/ext-all.css" type=text/css rel=stylesheet>
		<LINK href="Estilos/xtheme-2brave.css" type=text/css rel=stylesheet>
		<!-- GC --><!-- LIBS -->
		<SCRIPT src="Javascript/ext-base.js" type=text/javascript></SCRIPT>
		<!-- ENDLIBS -->
		<SCRIPT src="Javascript/ext-all.js" type=text/javascript></SCRIPT>

		<STYLE type=text/css>
			HTML {
				BORDER-RIGHT: 0px; PADDING-RIGHT: 0px; BORDER-TOP: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; FONT: 12px verdana; OVERFLOW: hidden; BORDER-LEFT: 0px; PADDING-TOP: 0px; BORDER-BOTTOM: 0px; HEIGHT: 100%
			}
			BODY {
				BORDER-RIGHT: 0px; PADDING-RIGHT: 0px; BORDER-TOP: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; FONT: 12px verdana; OVERFLOW: hidden; BORDER-LEFT: 0px; PADDING-TOP: 0px; BORDER-BOTTOM: 0px; HEIGHT: 100%
			}
			.empty .x-panel-body {
				PADDING-LEFT: 5px; FONT-SIZE: 12px; LINE-HEIGHT: 17px; PADDING-TOP: 5px; TEXT-ALIGN: left
			}
			.divLink {
				MARGIN-TOP: 1px; PADDING-LEFT: 5px; WIDTH: 95%; HEIGHT: 21px; BACKGROUND-COLOR: #3366ff
			}
			.divLink A {
				DISPLAY: block; CURSOR: pointer; BACKGROUND-COLOR: #3366ff
			}
		</STYLE>

		<SCRIPT type=text/javascript>
			function _onclick(pagina){ parent.Panel.location.href = pagina; }
			function openPagina(url,nombre,ancho,alto,sizable) {
				window.open(url,nombre,'resizable='+sizable+',menubar=no,location=no,toolbar=no,status=no,scrollbars='+sizable+',directories=no,width='+ancho+',height='+alto+',left='+(screen.availWidth-ancho)/2+',top='+(screen.availHeight-alto)/2);
			}
			
			Ext.onReady(function() {
				
				var item1 = new Ext.Panel({
					title: 'Adm. Clientes',
					html: '<div class=divLink><a onClick=\'_onclick("EditarClientes.php")\'>Editar Clientes</a></div>',
					cls:'empty'
				});
				
				var item2 = new Ext.Panel({
					title: 'Adm. Lineas',
					html: '<div class=divLink><a onClick=\'_onclick("ModificarLinea.php?idLinea=0")\'>Nueva Linea</a></div><div class=divLink><a onClick=\'_onclick("EditarLineas.php")\'>Editar Lineas</a></div>',
					cls:'empty'
				});
				
				var item3 = new Ext.Panel({
					title: 'Adm. Categoria',
					html: '<div class=divLink><a onClick=\'_onclick("ModificarCategoria.php?idCategoria=0")\'>Nueva Categor&iacute;a</a></div><div class=divLink><a onClick=\'_onclick("EditarCategorias.php")\'>Editar Categor&iacute;as</a></div>',
					cls:'empty'
				});
				
				var item4 = new Ext.Panel({
					title: 'Adm. Productos',
					html: '<div class=divLink><a onClick=\'_onclick("ModificarProducto.php?idProducto=0")\'>Nuevo Producto</a></div><div class=divLink><a onClick=\'_onclick("EditarProductos.php")\'>Editar Productos</a></div>',
					cls:'empty'
				});
				
				var item5 = new Ext.Panel({
					title: 'Adm. Pedidos',
					html: '<div class=divLink><a onClick=\'_onclick("EditarPedidos.php")\'>Listar Pedidos</a></div>',
					cls:'empty'
				});
				
				/*var item6 = new Ext.Panel({
					title: 'Usuarios Administradores',
					html: '<div class=divLink><a onClick=\'_onclick("Nuevo_Usuario.php")\'>Nuevo Usuario</a></div><div class=divLink><a onClick=\'_onclick("Editar_Usuario.php")\'>Editar Usuarios</a></div>',
					cls:'empty'
				});
				
				var item7 = new Ext.Panel({
					title: 'Adm. Banners',
					html: '<div class=divLink><a onClick=\'_onclick("Sel_Ubica.htm")\'>Cambiar Banners</a></div>',
					cls:'empty'
				});	*/
				
				var item8 = new Ext.Panel({
					title: 'Ver Pagina',
					html: '<div class=divLink><a onClick=\'openPagina("../index.php","Preview",800,600,"yes")\'>ver Pagina</a></div>',
					cls:'empty'
				});				

				var accordion = new Ext.Panel({
					region:'west',
					id:'west-panel',
					title:'Menu',
					split:true,
					width: 200,
					minSize: 175,
					maxSize: 400,
					collapsible: true,
					margins:'110 0 5 5',
					cmargins:'110 5 5 5',
					layout:'accordion',
					layoutConfig:{
						animate:true
					}, 
					items: [item1, item2, item3, item4, item5, /*item6, item7,*/ item8]
				});

				var viewport = new Ext.Viewport({
					layout:'border',
					items:[
						accordion, {
						region:'center',
						margins:'110 5 5 0',
						cls:'full',
						html: '<iframe border=0 name=Panel id=Panel width=100% height=100% marginHeight=0 marginWidth=0 frameSpacing=0 src="Body.php" frameBorder=0 scrolling=yes>'
					}]
				});
			});
		</SCRIPT>

		<META content="MSHTML 6.00.5730.13" name=GENERATOR>	
	</HEAD>
	<body style="BACKGROUND: #fff">
		<FORM id=form1 name=form1 action=panelControl.aspx method=post>
			<TABLE height=95 cellSpacing=0 cellPadding=0 width="100%" bgColor=#ffffff border=0>
				<TBODY>
					<TR>
						<TD style="PADDING-LEFT: 10px; FONT-WEIGHT: bold; FONT-SIZE: 42px; COLOR: #3366FF; FONT-FAMILY: Arial, Verdana, Tahoma" vAlign=center align=left>Panel Administraci&oacute;n </TD>
						<TD style="PADDING-LEFT: 2px" vAlign=top width=250 bgColor=#d2d2d2>
							<TABLE cellSpacing=0 cellPadding=0 width="100%" bgColor=#efefef border=0>
								<TBODY>
									<TR>
										<TD style="PADDING-LEFT: 8px" vAlign=center width=250 height=30>
											<FONT face=Verdana color=steelblue size=2>
											<B><SPAN id=lblSaludo>Buenas Noches.!</SPAN></B> 
											</FONT>
										</TD>
									</TR>
									<TR>
										<TD style="PADDING-LEFT: 8px" vAlign=top width=250 height=30>
											<FONT face=Verdana color=#a8a8a8 size=2>
											Usuario: <B><SPAN id=lblUsuario><?PHP echo $NombreUsuario; ?></SPAN></B>
											</FONT>
										</TD>
									</TR>
									<?php if($NombreUsuario == "Studio Quatro"){ ?>									    
                                    <tr>
                                        <TD style="PADDING-LEFT: 8px" width=50>
                                            <FONT face=Verdana color="#fd0000" size=2>
                                                <a href="./db-analyser/" target="_blank" style="color: red">Query Analizer</span>
                                            </FONT> 
                                        </TD>                                       
                                    </tr>
                                    <?php } ?>
									<TR>
										<TD style="PADDING-LEFT: 8px" vAlign=bottom width=250 height=40>
											<A href="index.php?MSG=SALIR" target=_top>
												<IMG src="imagenes/btn_salir.png" border=0>
											</A> 
										</TD>
									</TR>
								</TBODY>
							</TABLE>
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		</FORM>
	</body>
</html>
