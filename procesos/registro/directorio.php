
<?php
	require_once "../../clases/Directorio.php";

	$objDirectorio = new directorio();
   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);

   $datos = array(
      $_POST['dni'],
      $_POST['nombre'],
      $_POST['apellido'],
      $_POST['usuario'],
      $_POST['clave'],
		$_POST['empresa'],
      $_POST['celular'],
      $fechaHora);
	echo $objDirectorio->registroDirectorio($datos);
 ?>
