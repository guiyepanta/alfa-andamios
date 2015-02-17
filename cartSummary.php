<?php
    header("Content-type: application/json");
    session_start();    
    include_once("conexion.php");
    $summary = "";
    $idPedido = $_SESSION["idPedido"];
    $sql = "SELECT 
                count(pd.idProducto) items
                , sum(pd.cantidad * pd.precio) amount
                , pd.idPedido 
            FROM pedidos p 
            inner join pedidosdetalles pd ON p.idPedido = pd.idPedido
            WHERE p.idPedido = $idPedido
            GROUP BY pd.idPedido";
            
    if($idPedido!=''){
        $resSummary = mysql_query($sql, $link); 
        if(mysql_num_rows($resSummary)!=0) {       
            $array=mysql_fetch_array($resSummary);            
            $summary = array('items' => $array["items"], 'amount' => number_format(round($array["amount"],2),2, ',','.'));                
        }
        else {
            // Sin Items
            $summary = array('items' => 0, 'amount' => number_format(round(0,2),2, ',','.'));
        } 
    } 
    else {
        $summary = array('items' => 0, 'amount' => number_format(round(0,2),2, ',','.'));
    }
    echo json_encode($summary);
?>