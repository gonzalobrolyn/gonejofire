
<?php
   session_start();
   require_once "../../clases/Ventas.php";
   require_once "../../clases/Orden3.php";
   require_once "../../clases/Ventas2.php";

   $objVenta = new ventas();
   $objCobro = new orden3();
   $objDinero = new ventas2();

   $idMesa = $_POST['idMesa'];

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (6*60*60);
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
         echo $objDinero->dineroVenta($datosDinero);

      } else {
         echo 0;
      }
   } else {
      echo 0;
   }
?>
