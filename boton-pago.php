<?php
require_once "lib/mercadopago.php";

$mp = new MP("4400641879757311", "W1X08QAJEfVhnNrCGIgCxForE7Y9AL35");

$preference_data = array(
    "items" => array(
        array(
            "id" => "id_pedido",
            "title" => "Nombre del cliente (Nro. Pedido: id_pedido)",
            "currency_id" => "ARS",
            "picture_url" =>"https://www.mercadopago.com/org-img/MP3/home/logomp3.gif",
            "category_id" => "Category",
            "quantity" => 1,
            "unit_price" => 1000.50
        )
    ),
    "back_urls" => array(
        "success" => "http://www.andamiosalfa.com.ar/Store/confirmarCarrito.php?data=id_pedido|success",
        "failure" => "http://www.andamiosalfa.com.ar/Store/confirmarCarrito.php?data=id_pedido|failure",
        "pending" => "http://www.andamiosalfa.com.ar/Store/confirmarCarrito.php?data=id_pedido|pending"
    )
);

$preference = $mp->create_preference($preference_data);
?>

<!doctype html>
<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
        <style>
            .wrapper-MP{
                border-radius:5px; 
                -moz-border-radius:5px; /* Firefox */ 
                -webkit-border-radius:5px; /* Safari y Chrome */ 
                
                /* Otros estilos */ 
                border:2px solid #4082AD;
                width:295px;
                padding:5px;
            }            
            .wrapper-MP a {
                width: 230px;
            }            
            .wrapper-MP span {
                margin-top: 2px;
            }
        </style>
    </head>
    <body>
        <div class="wrapper-MP">
            <a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout" class="blue-L-Rn-Tr-ArOn">Pagar con Mercado Pago</a>
            <script type="text/javascript" src="http://mp-tools.mlstatic.com/buttons/render.js"></script>
        </div>
    </body>
</html>