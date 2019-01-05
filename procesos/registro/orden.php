
<?php
   session_start();
   require_once "../../clases/Orden.php";

   $objOrden = new orden();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);

   $idPersona = $_SESSION['persona'];
   $idCaja = $_SESSION['caja'];

   $datosOrden = array(
      $_POST['mesa'],
      $_POST['producto'],
      $_POST['cantidad'],
      $_POST['precio'],
      $fechaHora,
      $idPersona,
      $idCaja);

   echo $objOrden->guardaOrden($datosOrden);

?>
