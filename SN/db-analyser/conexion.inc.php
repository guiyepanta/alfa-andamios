<?php

class DB_mysql {
/* Variables de conexi�n */
var $BaseDatos;
var $Servidor;
var $Usuario;
var $clave;
/* identificador de conexi�n y consulta */

var $Selec_BD;
var $resultado;
var $Conexion_ID = 0;
var $consulta_ID = 0;
/* n�mero de error y texto error */
var $Errno = 0;
var $Error = "";
//----------------------------------------------------------------------------------------------------------------------------------------
/* M�todo Constructor: Cada vez que creemos una variable de esta clase, se ejecutar� esta funci�n */
// Configura tu base de datos mysql

function DB_mysql($bd = "andamioa_store", $host = "localhost", $user = "andamioa_admin", $pass = "Ingr3so01") {
	$this->BaseDatos = $bd;
	$this->Servidor = $host;
	$this->Usuario = $user;
	$this->clave = $pass;
}
//----------------------------------------------------------------------------------------------------------------------------------------
	/*Conexi�n a la base de datos*/
	function conectar($bd, $host, $user, $pass){
		if ($bd != "") $this->BaseDatos = $bd;
		if ($host != "") $this->Servidor = $host;
		if ($user != "") $this->Usuario = $user;
		if ($pass != "") $this->clave = $pass;
// Conectamos al servidor

	    $this->Conexion_ID = @mysql_connect($this->Servidor , $this->Usuario , $this->clave) or $this->err();
		$this->Selec_BD = @mysql_select_db ($this->BaseDatos , $this->Conexion_ID) or $this->err();
/* Si hemos tenido �xito conectando devuelve el identificador de la conexi�n, sino devuelve 0 */
		return $this->Conexion_ID;
	}
//----------------------------------------------------------------------------------------------------------------------------------------
	function err ()
	{
		$this-> testeando = true;
		$this-> email_admin = true;
		if ($this-> testeando )
		{
			 echo "<b><font color='red'>ERROR:</b> --> </b>" .
			 mysql_errno ()."</b> - <i>" .mysql_error ()."</i></font>";
			exit ();
		} 
		else
		{
			echo "<b><font color='red'>Ha habido un error</font></b>";
			if ($this-> email_admin )
			{
				echo ", el administrador ha sido informado por email";
				mail ($this-> email_admin ,
				"Error mysql en" .$_SERVER ['PHP_SELF'] ,
				"Error-> " .mysql_error ().
				"\n en->" .$_SERVER ['PHP_SELF'].$_SERVER ['QUERY_STRING'].
				"\n a las-> " .date ('H:i:s - D-d-m-Y'));
			}
			exit ();
		}
	}
//----------------------------------------------------------------------------------------------------------------------------------------
/* Ejecuta un consulta */
	function executeQuery($sql = ""){
		// ejecuta consulta Mysql
		$this-> resultado = mysql_query ($sql , $this-> Conexion_ID ) or $this-> err ($this-> resultado ) or $this-> err ();
		return ($this-> resultado );
/*	
function ejecutar_consulta($sql = ""){
	if ($sql == "") {
	    echo 'consulta:'.$sql;
		$this->Error = "No ha especificado una consulta SQL";
		return 0;
	}
//ejecutamos la consulta
	$this->consulta_ID = @mysql_query($sql, $this->Conexion_ID);
	echo 'Resultado: '.$this->consulta_id;
	if (!$this->consulta_ID) {
		$this->Errno = mysql_errno();
		$this->Error = mysql_error();
	}

/* Si hemos tenido �xito en la consulta devuelve el identificador de la conexi�n, sino devuelve 0 */
//	return $this->consulta_id;
	}

//----------------------------------------------------------------------------------------------------------------------------------------
	function desconectar(){
		mysql_close($this->Conexion_ID);
	}
//----------------------------------------------------------------------------------------------------------------------------------------
	function ultimoID(){
		return mysql_insert_id($this->Conexion_ID);
	}
//----------------------------------------------------------------------------------------------------------------------------------------
	function numeroFilas($sql){
		$i=mysql_num_rows($sql);
		return $i;
	}
//----------------------------------------------------------------------------------------------------------------------------------------
}//fin de la clase DB_mysql
?>
