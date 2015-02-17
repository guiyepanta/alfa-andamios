<div class="title_box"><a href="index.php">Productos</a></div>

<?php
include_once 'conexion.php';
$sql="SELECT DISTINCT idLinea, titulo FROM lineas, estados WHERE idEstado = 1 ORDER BY orden ASC, titulo ASC";

$res=mysql_query($sql,$link) or die("Error en: $sql: " . mysql_error());
echo "<ul class='left_menu'>";
$ban=0;
	while($registro=mysql_fetch_array($res))
	{				    
        if ($ban == 0){
        	$ban = 1;	
        	echo "<li class='even'><a href='index.php?linea=".$registro["idLinea"]."'>".$registro["titulo"]."</a></li>";	
        } else {
            $ban = 0;
            echo "<li class='odd'><a href='index.php?linea=".$registro["idLinea"]."'>".$registro["titulo"]."</a></li>";
        }        
    }
echo "</ul>";
?>

<div class="banner_adds"> <a href="#"><img src="images/bann2.jpg" alt="" border="0" /></a> </div>