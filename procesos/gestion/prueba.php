
<?php
   session_start();
   require_once "../../clases/Ventas.php";

   $objVenta = new ventas();

   $idMesa = $_POST['idMesa'];

   echo $objVenta->prueba($idMesa);

?>
