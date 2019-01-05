
<?php
	session_start();
	require_once "../clases/Acceso.php";

	$obj = new acceso();
	$datos = array(
		$_POST['codigo']);
	echo $obj->validarCodigo($datos);
?>
