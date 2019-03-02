
<?php
   session_start();
   require_once "../../clases/Orden2.php";

   $objOrden = new orden2();

   $mesa = $_POST['mesaOr'];
   $producto = $_POST['productoOr'];
   $nombre = $_POST['nombreOr'];
   $precio = $_POST['precioOr'];
   $cantidad = $_POST['cantidadOr'];

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (6*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);

   $idPersona = $_SESSION['persona'];
   $idCaja = $_SESSION['caja'];

   $datosOrden = array(
      $mesa,
      $producto,
      $precio,
      $cantidad,
      $fechaHora,
      $idPersona,
      $idCaja);

   echo $objOrden->guardaOrden($datosOrden);

?>
