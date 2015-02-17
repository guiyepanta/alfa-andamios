<?php
function indexOf($string, $find) {
    $pos = strpos($string, $find);
    if ($pos === false) {
        return false;
    } else {
        return true;
    }
}

function lastIndexOf($string,$item) {

	$index=strpos(strrev($string),strrev($item));
	if ($index)
	{
		$index=strlen($string)-strlen($item)-$index;
		return $index;
	}
	else
		return -1;
}

function obtenerUri($uri) {
	$aux = "/PHP/Site_HugoDaizo";
	$ini = 0;
	$fin=lastIndexOf($uri,"/");
	if ($fin < 0)
		return $aux;
	else {
	$uri =  substr($uri, $ini, $fin);
		return $uri;
	}
}
function mc_encrypt($encrypt, $mc_key) {
    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
    $passcrypt = trim(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $mc_key, trim($encrypt), MCRYPT_MODE_ECB, $iv));
    $encode = base64_encode($passcrypt);
    return $encode;
}

// Decrypt Function
function mc_decrypt($decrypt, $mc_key) {
    $decoded = base64_decode($decrypt);
    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $mc_key, trim($decoded), MCRYPT_MODE_ECB, $iv));
    return $decrypted;
}

function obtenerIdProducto($nombre_campo) {

	if (indexOf($nombre_campo, "txtProdId_"))
		return str_replace("txtProdId_", "", $nombre_campo);	
}
?>
