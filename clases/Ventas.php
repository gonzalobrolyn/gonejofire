
<?php
   require_once "Gonexion.php";

   class ventas{

      public function prueba($dato){
         if ($datos > 0) {
            return 1;
         }
      }

      public function guardaVenta($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlMovi = "INSERT into movimiento(
                                 movimiento_nombre,
                                 movimiento_fecha,
                                 movimiento_persona,
                                 movimiento_caja)
                         values ('VentaHoy',
                                 '$datos[0]',
                                 '$datos[1]',
                                 '$datos[2]')";
         $queryMovi = mysqli_query($conexion, $sqlMovi);
         return mysqli_insert_id($conexion);
      }

      public function dineroVenta($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlcaja = "SELECT caja_cuenta
                       from caja
                      where caja_id = '$datos[2]'";
         $queryCaja = mysqli_query($conexion, $sqlcaja);
         $resultCaja = mysqli_fetch_row($queryCaja)[0];

         $efectivo = $resultCaja + $datos[1];

         $sqlVenta = "UPDATE movimiento
                         set movimiento_monto = '$resultCaja',
                             movimiento_dinero = '$datos[1]',
                             movimiento_efectivo = '$efectivo'
                       where movimiento_id = '$datos[0]'
                         and movimiento_caja = '$datos[2]'";
         $queryVenta = mysqli_query($conexion, $sqlVenta);

         if ($queryVenta == 1) {
            $sqlCaja = "UPDATE caja
                           set caja_cuenta = '$efectivo'
                         where caja_id = '$datos[2]'";
            return mysqli_query($conexion, $sqlcaja);
         }
      }
   }

?>
