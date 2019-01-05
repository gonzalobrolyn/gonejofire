
<?php
   session_start();
	require_once "../../clases/Cajas.php";

	$obj = new cajas();
   $idEmpresa = $_SESSION['empresa'];
   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];

	$datos = array(
      $_POST['nombre'],
      $idEmpresa,
      $_POST['direccion'],
      $_POST['telefono'],
      $_POST['llave'],
      $fechaHora,
      $idPersona);
	echo $obj->guardaCaja($datos);
?>
