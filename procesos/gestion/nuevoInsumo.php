
<?php
   session_start();
   require_once "../../clases/Insumos.php";

   $objInsumo = new insumos();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];

   $datosInsumo = array(
      $_POST['codigo'],
      $_POST['insumo'],
      $_POST['marca'],
      $_POST['familia'],
      $fechaHora,
      $idPersona);

   echo $objInsumo->guardaInsumo($datosInsumo);

?>
