
<?php
   session_start();
   require_once "../../clases/Compras.php";
   require_once "../../clases/Entradas.php";
   require_once "../../clases/Cajas.php";

   $objCompra = new compras();
   $objEntrada = new entradas();
   $objCaja = new cajas();

   $total = $_POST['total'];

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);

   $idPersona = $_SESSION['persona'];
   $idCaja = $_SESSION['caja'];
   $lista = $_SESSION['listaCompraTmp'];

   $datosCompra = array(
      $total,
      $fechaHora,
      $idPersona,
      $idCaja);
   $idMovimiento = $objCompra->guardaCompra($datosCompra);

   if ($idMovimiento > 0) {
      $r = 0;
      foreach (@$lista as $key ) {
         $item = explode("||", @$key);

         $datosEntrada = array(
            $idMovimiento,
            $item[0],
            $item[3],
            $item[4],
            $fechaHora,
            $idPersona,
            $idCaja);
         $resultMovi = $objEntrada->registraEntrada($datosEntrada);
         $r = $r + $resultMovi;
      }

      $datosCaja = array(
         $total,
         $idCaja);
      $result = $objCaja->restaSoles($datosCaja);
      unset($_SESSION['listaCompraTmp']);
      echo $result;
   } else {
      echo 0;
   }
?>
