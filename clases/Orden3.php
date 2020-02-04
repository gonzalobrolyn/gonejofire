
<?php
   require_once "Gonexion.php";

   class orden3{

      public function cobraMesa($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $suma = 0;

         $sqlOrden = "SELECT orden_id,
                             orden_cantidad,
                             orden_precioventa
                        from orden
                       where orden_mesa = '$datos[1]'
                         and orden_estado = 'Entregado'
                         and orden_caja = '$datos[2]'";
         $queryOrden = mysqli_query($conexion, $sqlOrden);

         while ($orden = mysqli_fetch_row($queryOrden)) {
            $sqlCobro = "UPDATE orden
                            set orden_movimiento = '$datos[0]',
                                orden_estado = 'Cobrado'
                          where orden_id = '$orden[0]'";
            $queryCobro = mysqli_query($conexion, $sqlCobro);
            $suma = $suma + $orden[1] * $orden[2];
         }
         return $suma;
      }
   }
?>
