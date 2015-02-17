<?php
include_once('conexion.inc.php');

class productoAdmin {
/* variables*/
var $_productoList;
var $_Id;

//----------------------------------------------------------------------------------------------------------------------------------------

	function productoAdmin() {
	}
	
//----------------------------------------------------------------------------------------------------------------------------------------

	function consulta($id){
		$miconexion = new DB_mysql ;
		$miconexion->conectar("", "", "", "");
		
		$sql="SELECT DISTINCT c.idCategoria, 
					c.titulo 'tituloCategoria', 
					p.idProducto, 
					p.titulo, 
					p.imagen1,
					p.imagen2,
					p.imagen3, 
					p.precio,
					p.detalle,
					p.disponible 
				FROM categoria c, 
					productos p, 
					lineas l 
				WHERE c.idCategoria = p.idCategoria 
					AND l.idLinea=c.idLinea 
					AND c.estado = 1 
					AND p.idEstado = 1 
					AND l.idEstado=1 
					AND p.idProducto=$id
				ORDER BY c.orden ASC, 
					c.titulo ASC, 
					p.titulo ASC";
                	
		$result=$miconexion->executeQuery($sql);
		while ($rowEquipo=mysql_fetch_array($result)){
		   $list[] = $rowEquipo;
		}
		$this->_productoList = $list;

		$miconexion->desconectar();
	}

//----------------------------------------------------------------------------------------------------------------------------------------

	function listar($linea, $textSearch){
		$miconexion = new DB_mysql ;
		$miconexion->conectar("", "", "", "");
				
 		$criterio = "";
		if ($linea!="")
			$criterio = " AND c.idlinea=" . $linea;
		
		if($textSearch!="")
		  $criterio = " AND p.titulo LIKE '%" . $textSearch . "%'";
		
		$sql="SELECT DISTINCT c.idCategoria, 
					c.titulo 'tituloCategoria', 
					p.idProducto, 
					p.titulo, 
					p.imagen1, 
					p.precio, 
					p.disponible 
				FROM categoria c, 
					productos p, 
					lineas l 
				WHERE c.idCategoria = p.idCategoria 
					AND l.idLinea=c.idLinea 
					AND c.estado = 1 
					AND p.idEstado = 1 
					AND l.idEstado=1" . $criterio . " 
				ORDER BY c.orden ASC, 
					c.titulo ASC, 
					p.titulo ASC";
		
		$result=$miconexion->executeQuery($sql);		
		while ($rowProducto=mysql_fetch_array($result)){
		   $list[] = $rowProducto;
		}
		$this->_productoList = $list;

		$miconexion->desconectar();
	}
}
?>