
<?php
   session_start();
   require_once "../../clases/Orden.php";

   $objEntregado = new orden();

   $idCaja = $_SESSION['caja'];

   $datosEntregado = array(
      $_POST['idOrden'],
      'Entregado',
      $idCaja);

   echo $objEntregado->cambiaEstadoOrden($datosEntregado);
?>
