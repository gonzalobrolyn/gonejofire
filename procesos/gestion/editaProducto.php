
<?php
   session_start();
   require_once "../../clases/Productos.php";

   $objProducto = new productos();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];
   $idCaja = $_SESSION['caja'];

   $datosProducto = array(
      $_POST['producto'],
      $_POST['codigo'],
      $_POST['nombre'],
      $_POST['resumen'],
      $_POST['carta'],
      $_POST['grupo'],
      $_POST['precio'],
      $fechaHora,
      $idPersona,
      $idCaja);

   echo $objProducto->editaProducto($datosProducto);

?>
