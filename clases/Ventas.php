
<?php
   require_once "Gonexion.php";

   class ventas{

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
   }

?>
