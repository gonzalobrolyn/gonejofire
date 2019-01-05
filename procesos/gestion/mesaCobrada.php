
<?php
   session_start();
   require_once "../../clases/Ventas.php";
   require_once "../../clases/Orden.php";

   $objVenta = new ventas();
   $objCobro = new orden();
   $objDinero = new ventas();

   $idMesa = $_POST['idMesa'];

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];
   $idCaja = $_SESSION['caja'];

   $datosMovi = array(
      $fechaHora,
      $idPersona,
      $idCaja);
   $idMovi = $objVenta->guardaVenta($datosMovi);

   if ($idMovi > 0) {
      $datosCobro = array(
         $idMovi,
         $idMesa,
         $idCaja);
      $dinero = $objCobro->cobraMesa($datosCobro);

      if ($dinero > 0) {
         $datosDinero = array(
            $idMovi,
            $dinero,
            $idCaja);
         echo = $objDinero->dineroVenta($datosDinero);

      } else {
         echo 0;
      }
   } else {
      echo 0;
   }
?>
