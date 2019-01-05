
<?php
	session_start();
	require_once "../clases/Acceso.php";

	$obj = new acceso();

	$datos = array(
		$_POST['usuario'],
		$_POST['clave']);
	echo $obj->entrarUsuario($datos);
?>
