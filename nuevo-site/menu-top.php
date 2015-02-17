<?php

    include_once('classes/lineaAdmin.php');
						
	$listarLineas = new lineaAdmin();
	$listarLineas->listar();
?>
						<nav class="horizontal-nav full-width horizontalNav-notprocessed">
                            <ul class="sf-menu">
                                <li <?php if( strpos($_SERVER['REQUEST_URI'],'index.php') !== false) { echo "class='current'";}?> ><a href="index.php">Sobre Nosotros</a></li>
                                <li <?php if( strpos($_SERVER['REQUEST_URI'],'productos.php') !== false) { echo "class='current'";}?>>
									<a href="productos.php">Productos</a>
									<?php
									if ($listarLineas->_lineaList > 0) {		
										echo '<ul>';
										
										foreach($listarLineas->_lineaList as $ln)
											echo '    <li><a href="productos.php?linea='.$ln['idLinea'].'">'.$ln['titulo'].'</a></li>';
										
										echo '</ul>';
									}
									?>
								</li>
                                <!--<li>
                                    <a href="index-3.html">Employment</a>
                                    <ul>
                                        <li><a href="#">Vestibulum iaculis</a></li>
                                        <li><a href="#"> Fusce euismod conuat</a></li>
                                        <li>
                                            <a href="#">Pellentesque</a>
                                            <ul>
                                                <li><a href="#">Pellentesque sed</a></li>
                                                <li><a href="#">Aliquam congue ferm</a></li>
                                                <li><a href="#">Mauris accum</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>-->
                                <li><a href="index-4.html">Su Compra</a></li>
                                <li><a href="index-1.html"> Servicios </a></li>
                                <li <?php if( strpos($_SERVER['REQUEST_URI'],'contacto.php') !== false) { echo "class='current'";}?>><a href="contacto.php">Contactos </a></li>
                            </ul>
                        </nav>