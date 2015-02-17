<div class="footer">
                <div class="left_footer"><a href="http://www.studioquatro.com.ar" alt="Studio Quatro"><img src="images/powered-by-studio-quatro.gif" border="0"></a> </div>
                <div class="center_footer"> Alfa Andamios. Todos los derechos reservados 2014<br />
                    <br /><img src="images/metodos-pagos.png" alt="Metodos de Pago" height="20" /> 
                </div>
                <div class="right_footer"> 
                    <a href="<?php echo getLocation(); ?>/index.php">Inicio</a> 
                    <a href="<?php echo getLocation(); ?>/carritoCompras.php">Su compra</a>
                    <a href="<?php echo getLocation(); ?>/contacto.php">contacto</a>
                    <?php
                    if ($_SESSION["autorizacion_Login"]!=1) {
                        echo "<a href='".getLocation()."/login.php'> Ingresar </a>";
                    }
                    ?>
                    <a href="<?php echo getLocation(); ?>/sitemap.html">sitemap</a>
                </div>
            </div>