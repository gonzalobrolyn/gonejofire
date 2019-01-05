
<?php
   session_start();
   require_once "../../clases/Mesas.php";

   $objMesa = new mesas();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);

   $idPersona = $_SESSION['persona'];
   $idCaja = $_SESSION['caja'];

   $datosMesa = array(
      $_POST['numero'],
      $_POST['fila'],
      $_POST['columna'],
      $fechaHora,
      $idPersona,
      $idCaja);

   echo $objMesa->guardaMesa($datosMesa);

?>
