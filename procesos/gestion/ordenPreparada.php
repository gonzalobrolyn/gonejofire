
<?php
   session_start();
   require_once "../../clases/Orden2.php";

   $objPreparado = new orden2();

   $idOrden = $_POST['idOrden'];
   $idCaja = $_SESSION['caja'];

   $datosPreparado = array(
      $idOrden,
      'Preparado',
      $idCaja);

   echo $objPreparado->cambiaEstadoOrden($datosPreparado);
?>
