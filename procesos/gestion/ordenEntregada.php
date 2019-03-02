
<?php
   session_start();
   require_once "../../clases/Orden2.php";

   $objEntregado = new orden2();

   $idCaja = $_SESSION['caja'];

   $datosEntregado = array(
      $_POST['idOrden'],
      'Entregado',
      $idCaja);

   echo $objEntregado->cambiaEstadoOrden($datosEntregado);
?>
