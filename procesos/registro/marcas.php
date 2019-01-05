
<?php
   session_start();
   require_once "../../clases/Marcas.php";

   $objMarca = new marcas();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];

   $datosMarca = array(
      $_POST['nombre'],
      $fechaHora,
      $idPersona);

   echo $objMarca->guardaMarca($datosMarca);

?>
