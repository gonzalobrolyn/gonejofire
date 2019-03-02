
<?php
   require_once "Gonexion.php";

   class ventas2{

      public function dineroVenta($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlCuenta = "SELECT caja_cuenta
                       from caja
                      where caja_id = '$datos[2]'";
         $queryCuenta = mysqli_query($conexion, $sqlCuenta);
         $cuentaCaja = mysqli_fetch_row($queryCuenta)[0];

         $efectivo = $cuentaCaja + $datos[1];

         $sqlVenta = "UPDATE movimiento
                         set movimiento_monto = '$cuentaCaja',
                             movimiento_dinero = '$datos[1]',
                             movimiento_efectivo = '$efectivo'
                       where movimiento_id = '$datos[0]'
                         and movimiento_caja = '$datos[2]'";
         $queryVenta = mysqli_query($conexion, $sqlVenta);

         if ($queryVenta == 1) {
            $sqlCaja = "UPDATE caja
                           set caja_cuenta = '$efectivo'
                         where caja_id = '$datos[2]'";
            return mysqli_query($conexion, $sqlCaja);
         }
      }

   }
?>
