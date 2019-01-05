
<?php
   session_start();
	require_once "../../clases/Empleados.php";

	$objUser = new empleados();

   $idEmpresa = $_SESSION['empresa'];

	$datosUser = array(
      $_POST['idUsuario'],
      $_POST['caja'],
      $idEmpresa);
	echo $objUser->asignaCaja($datosUser);
?>
