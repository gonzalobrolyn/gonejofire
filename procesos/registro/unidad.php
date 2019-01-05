
<?php
   session_start();
   require_once "../../clases/Unidades.php";

   $objUnidad = new unidades();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];

   $datosUnidad = array(
      $_POST['nombre'],
      $fechaHora,
      $idPersona);

   echo $objUnidad->guardaUnidad($datosUnidad);

?>
