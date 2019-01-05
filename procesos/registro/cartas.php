
<?php
   session_start();
   require_once "../../clases/Cartas.php";

   $objCarta = new cartas();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];
   $idCaja = $_SESSION['caja'];

   $datosCarta = array(
      $_POST['nombre'],
      $fechaHora,
      $idPersona,
      $idCaja);

   echo $objCarta->guardaCarta($datosCarta);

?>
