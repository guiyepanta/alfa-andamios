<?php
include_once('conexion.inc.php');

class lineaAdmin {
/* variables*/
var $_lineaList;
var $_Id;

//----------------------------------------------------------------------------------------------------------------------------------------

	function lineaAdmin() {
	}
	
//----------------------------------------------------------------------------------------------------------------------------------------

	function consulta($id){
		$miconexion = new DB_mysql ;
		$miconexion->conectar("", "", "", "");
		
		$sql="	SELECT * 
			    FROM lineas l
			    WHERE l.idLinea = $id";                      
		
		$result=$miconexion->executeQuery($sql);
		while ($rowEquipo=mysql_fetch_array($result)){
		   $list[] = $rowEquipo;
		}
		$this->_lineaList = $list;

		$miconexion->desconectar();
	}

//----------------------------------------------------------------------------------------------------------------------------------------

	function listar(){
		$miconexion = new DB_mysql ;
		$miconexion->conectar("", "", "", "");
				
 		$sql="	SELECT * 
			    FROM lineas l
			    WHERE l.idEstado = 1 
					AND EXISTS(SELECT 1 FROM categoria c 
								WHERE estado = 1 
									AND c.idLinea = l.idLinea
									AND EXISTS(SELECT 1 FROM productos p
												WHERE p.idCategoria = c.idCategoria 
													AND idEstado = 1
											   LIMIT 1) 
								LIMIT 1) 
				ORDER BY l.orden";
		
		$result=$miconexion->executeQuery($sql);
		while ($rowLinea=mysql_fetch_array($result)){
		   $list[] = $rowLinea;
		}
		$this->_lineaList = $list;

		$miconexion->desconectar();
	}
}
?>