					<?php
                    if ($_SESSION["autorizacion_Login"]==1) { 
                    ?>
                        <div class="shopping_cart">
                            <div class="title_box">Resumen compra</div>
                            <div class="cart_details"><span id="items"></span>
                                <br /><span class="border_cart"></span> 
                                Total: <span class="price" id="amount"></span> 
                            </div>
                            <div class="cart_icon"><a href="./carritoCompras.php"><img src="images/shoppingcart.png" alt="" width="35" height="35" border="0" /></a></div>
                        </div>
                        <script>
                            var getCartSummary = function(){
                                $.get( "cartSummary.php", function( data ) {
                                    $("#items").html(data.items + " items");
                                    $("#amount").html( "$" + data.amount + " + IVA");
                                });
                            };
                            getCartSummary();
                        </script>
                    <?php 
                    } 
                    ?>
                    
					<div class="title_box">Busqueda</div>
                    <div class="border_box">
                        <form action="./index.php" name="searchProduct" method="post">
                            <input type="text" id="inputSearch" name="inputSearch" class="newsletter_input" placeholder="Ejem: Andamios"/>
                            <button class='prod_details searchProduct'>Buscar</button>
                        </form>
                    </div>
                    
                    <!-- 
                    <div class="title_box">What�s new</div>
                    <div class="border_box">
                        <div class="product_title"><a href="http://www.free-css.com/">Motorola 156 MX-VL</a></div>
                        <div class="product_img"><a href="http://www.free-css.com/"><img src="images/p2.jpg" alt="" border="0" /></a></div>
                        <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
                    </div>
                    <div class="title_box">Manufacturers</div>
                    <ul class="left_menu">
                        <li class="odd"><a href="http://www.free-css.com/">Bosch</a></li>
                        <li class="even"><a href="http://www.free-css.com/">Samsung</a></li>
                        <li class="odd"><a href="http://www.free-css.com/">Makita</a></li>
                        <li class="even"><a href="http://www.free-css.com/">LG</a></li>
                        <li class="odd"><a href="http://www.free-css.com/">Fujitsu Siemens</a></li>
                        <li class="even"><a href="http://www.free-css.com/">Motorola</a></li>
                        <li class="odd"><a href="http://www.free-css.com/">Phillips</a></li>
                        <li class="even"><a href="http://www.free-css.com/">Beko</a></li>
                    </ul>
                    -->
                    <div class="banner_adds"> <a href="#"><img src="images/bann2.jpg" alt="" border="0" /></a> </div>