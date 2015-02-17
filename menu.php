<?php
$nombreUsuario=$_COOKIE["nombreUsuario"];
$idUsuario=$_COOKIE["idUsuario"];

function getLocation() {
    
  return "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
} 


?>
				   <ul class="menu">
                        <li><a href="<?php echo getLocation(); ?>/index.php" class="nav"> Inicio </a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo getLocation(); ?>/carritoCompras.php" class="nav"> Su compra </a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo getLocation(); ?>/contacto.php" class="nav"> Contacto </a></li>
                        <?php
						if ($_SESSION["autorizacion_Login"]==1) {
							echo "<li class='divider'></li>";
							echo "<li><a href='".getLocation()."/crearUsuario.php?user=$idUsuario&editMode=true' class='nav'> Configurar cuenta </a></li>";
							echo "<li class='divider'></li>";
							echo "<li><a class='nav' href='".getLocation()."/index.php?action=logout'> Cerrar Sesi&oacute;n </a></li>";
						}
						else {
							echo "<li class='divider'></li>";
							echo "<li><a href='".getLocation()."/login.php' class='nav'> Ingresar </a></li>";
						}
						?>
                    </ul>