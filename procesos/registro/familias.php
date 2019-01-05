
<?php
   session_start();
   require_once "../../clases/Familias.php";

   $objFamilia = new familias();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];

   $datosFamilia = array(
      $_POST['nombre'],
      $fechaHora,
      $idPersona);

   echo $objFamilia->guardaFamilia($datosFamilia);

?>
