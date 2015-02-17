<?php
include_once 'conexion.php';
$idProducto = $_POST["idProducto"];
$showAddToCart = $_POST["showAddToCart"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Details</title>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
        <style type="text/css">
            .btn_add {
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
                font-family:arial;
                font-size:16px;
                font-weight:bold;
                font-style:normal;
                height:26px;
                line-height:26px;
                margin-bottom: 5px;
                text-decoration:none;
                text-align:center;
                text-shadow:1px 1px 0px #ffffff;               
                width: 80px;
                color: #0054A3; 
            }
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
            }
            .btn_add:hover, .btn_close:hover {
            	background-color:#dfdfdf;
            }
            .btn_add:active, .btn_close:active {
            	position:relative;
            	top:1px;
            }
            
            #galeria, #galeria * {
            	box-sizing:border-box,-moz-box-sizing:border-box
            }
			#galeria {
				border: 1px solid #EAEAEA;  /* Borde de la galería */
				padding: 5px;
				background: white;  /* Fondo de la galería */
				width: 190px;  /* Ancho de la galería */
			}
			#galeria_miniaturas {
				display: table;
				margin: 0 auto;
			}
			#imgGaleria {
				height: 140px;
			}
			.miniatura {
			    border: 1px solid #ddd;
			    cursor: pointer;
			    float: left;
			    height: 50px;
			    margin: 3px;
			    padding: 2px;
			    width: 50px;
			}
			.miniatura:hover {
				opacity:.8;   /* Opacidad */
				-moz-opacity:.8;
				-khtml-opacity:.8;
				filter:alpha(opacity=80);
			}
			.miniatura:active {
				opacity:1;
				-moz-opacity:1;
				-khtml-opacity:1;
				filter:alpha(opacity=80);
			}
			
			/* styles unrelated to zoom */
		p.hover { position:absolute; top:3px; right:28px; color:#555; font:bold 13px/1 sans-serif;}

		/* these styles are for the demo, but are not required for the plugin */
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

		.zoom img::selection { background-color: transparent; }

		#ex2 img:hover { cursor: url(grab.cur), default; }
		#ex2 img:active { cursor: url(grabbed.cur), default; }			            
        </style>
        
        <script>
        	$(document).ready(function() { 
        		$('#btnAdd.prod_buy').click(function(event) { 
        			var cant = $('#txtCantidad.details').val();
        			var idPrdt = $('#hdnIdProducto').val();
        			var postData = {
				        "idProducto" : idPrdt,
				        "cantidad" : cant,
				    };
				    addToCart(postData);
				    getCartSummary();
        		});
        		$('#ex1').zoom();
        	});
        </script>
    </head>
    <body>
        <div id="main_container" style="width: 735px;">
	        <div id="main_content">
	            <div class="center_content">
	            	<input type="hidden" id="hdnIdProducto" name="hdnIdProducto" value="<?php echo $idProducto; ?>" />
	            	<?php
	            	$sql = "SELECT p.*, c.titulo 'tituloCategoria' FROM productos p, categoria c WHERE c.idcategoria = p.idcategoria AND idproducto=" . $idProducto;
	            	$prdResult = mysql_query($sql, $link);
					$disponible=0;
					$precio=0;
					
					if(mysql_num_rows($prdResult) != 0)
					{
						$prd=mysql_fetch_array($prdResult);
						$disponible=$prd["disponible"];
						$precio=$prd["precio"];
					?>				
					<div class="center_title_bar"><?php echo $prd["titulo"]; ?></div>
	                <div class="prod_box_big">
	                    <div class="center_prod_box_big">
	                        <div class="product_img_big">
	                            <div id="galeria">
									<div id="galeria_imagen">
										<?php
											$img1 = "images/img_no_disp.png.png";
											if ($prd["imagen1"] != "")
												$img1 = $prd["imagen1"];										
										?>
										<span class='zoom' id='ex1'>
											<img id="imgGaleria" src="<?php echo $img1 ?>"/>
											<p class="hover">Hover</p>
										</span>										
										
									</div>
									<div id="galeria_miniaturas">
										<img class="miniatura" onclick="javascript:document.getElementById('imgGaleria').src=this.src;" src="<?php echo $prd["imagen1"]; ?>" onerror="imageError(this)"/>
									<?php
										if ($prd["imagen2"] != "")
										 	echo "<img class=\"miniatura\" onclick=\"javascript:document.getElementById('imgGaleria').src=this.src;\" src=\"".$prd["imagen2"]."\" />";
										if ($prd["imagen3"] != "")
										 	echo "<img class=\"miniatura\" onclick=\"javascript:document.getElementById('imgGaleria').src=this.src;\" src=\"".$prd["imagen3"]."\" />";
									?>																				
									</div>
								</div> 
							</div>
	                        <div class="details_big_box">
	                            <div class="specifications"> 
	                            	Description: <span class="blue"><?php echo $prd["detalle"]; ?></span><br />                                
	                            </div>
	                            	                            	                            
	                        </div>
	                    </div>
	                </div>
					
					<?php			
					}
	            	?>            	
	                
	            </div>
	            <?php
                if($disponible==1)	
                	echo '<div class="prod_price_big">Precio: <span class="price">$ ' . number_format(round($precio, 2),2,',', '.') . '</span> <span style="color: grey;">+ IVA</span></div>';
				else
					echo '<div class="prod_price_big"><span class="price">&nbsp;</span></div>';
				
				if ($showAddToCart=="true") {
                ?>
                    <div class="prod_add_to_cart">
                        <form>
                            <label>Cantidad:</label>
                            &nbsp;<input style='width:50px' id='txtCantidad' name='txtCantidad' type='text' class="details"/>&nbsp;
                            <a href="#" class="prod_buy btn_add" id="btnAdd">Agregar</a>
                        </form>
                    </div>
                    <div style="float: left; padding-right: 10px; text-align: right; width: 95px; margin-top: 4px;"><a href="#" class="btn_close">Cerrar</a></div>
                <?php
                } else {
                ?>
                    <div style="float: left; padding-right: 10px; text-align: right; width: 320px; margin-top: 4px;"><a href="#" class="btn_close">Cerrar</a></div>
                <?php
                }
                ?>	            
	        </div>
        </div>
        <!-- end of main_container -->
        <script language="Javascript">
            document.oncontextmenu = function(){return false}
        </script>
    </body>
</html>