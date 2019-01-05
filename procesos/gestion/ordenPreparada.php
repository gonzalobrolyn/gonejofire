
<?php
   session_start();
   require_once "../../clases/Orden.php";

   $objPreparado = new ordenes();

   $idOrden = $_POST['idOrden'];
   $idCaja = $_SESSION['caja'];

   $datosPreparado = array(
      $idOrden,
      'Preparado',
      $idCaja);

   echo $objPreparado->cambiaEstadoOrden($datosPreparado);
?>
