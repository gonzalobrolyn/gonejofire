
<?php
   session_start();
   require_once "../../clases/Grupos.php";

   $objGrupo = new grupos();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];
   $idCaja = $_SESSION['caja'];

   $datosGrupo = array(
      $_POST['nombre'],
      $fechaHora,
      $idPersona,
      $idCaja);

   echo $objGrupo->guardaGrupo($datosGrupo);

?>
