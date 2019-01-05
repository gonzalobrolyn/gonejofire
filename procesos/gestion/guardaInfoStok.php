
<?php
   session_start();
	require_once "../../clases/Almacen.php";

	$objAlmacen = new almacen();

   $idCaja = $_SESSION['caja'];

   $datosAlmacen = array(
      $idCaja,
      $_POST['idAlmacen'],
      $_POST['medidaDunidad'],
      $_POST['medidaDcontrol'],
      $_POST['cantidadXunidad'],
      $_POST['cantidadMinima'],
      $_POST['cantidadActual']);
	echo $objAlmacen->actualizaInfoStok($datosAlmacen);
 ?>
