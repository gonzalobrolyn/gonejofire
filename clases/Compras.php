
<?php
   require_once "Gonexion.php";

   class compras{

      public function guardaCompra($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlcaja = "SELECT caja_soles
                       from caja
                      where caja_id = '$datos[3]'";
         $queryCaja = mysqli_query($conexion, $sqlcaja);
         $resultCaja = mysqli_fetch_row($queryCaja)[0];

         $efectivo = $resultCaja - $datos[0];

         $sqlMovi = "INSERT into movimiento(
                                 movimiento_nombre,
                                 movimiento_monto,
                                 movimiento_dinero,
                                 movimiento_efectivo,
                                 movimiento_fecha,
                                 movimiento_persona,
                                 movimiento_caja)
                         values ('Compra',
                                 '$resultCaja',
                                 '$datos[0]',
                                 '$efectivo',
                                 '$datos[1]',
                                 '$datos[2]',
                                 '$datos[3]')";
         $queryMovi = mysqli_query($conexion, $sqlMovi);
         return mysqli_insert_id($conexion);
      }
   }

?>
