
<?php
   session_start();
   require_once "../../clases/Insumos.php";

   $objInsumo = new insumos();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];

   $datosInsumo = array(
      $_POST['idInsumoEditar'],
      $_POST['codigoInsumoEditar'],
      $_POST['nombreInsumoEditar'],
      $fechaHora,
      $idPersona);

   echo $objInsumo->editaInsumo($datosInsumo);

?>
