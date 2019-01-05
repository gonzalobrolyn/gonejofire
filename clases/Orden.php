
<?php
   require_once "Gonexion.php";

   class ordenes{

      public function guardaOrden($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlOrden = "INSERT into orden (
                                  orden_mesa,
                                  orden_producto,
                                  orden_cantidad,
                                  orden_estado,
                                  orden_precioventa,
                                  orden_fecha,
                                  orden_persona,
                                  orden_caja)
                         values ('$datos[0]',
                                 '$datos[1]',
                                 '$datos[2]',
                                 'Registrado',
                                 '$datos[3]',
                                 '$datos[4]',
                                 '$datos[5]',
                                 '$datos[6]')";
         return mysqli_query($conexion, $sqlOrden);
      }

      public function cambiaEstadoOrden($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlEstado = "UPDATE orden
                          set orden_estado = '$datos[1]'
                        where orden_id = '$datos[0]'
                          and orden_caja = '$datos[2]'";
         return mysqli_query($conexion, $sqlEstado);
      }

      public function cobraMesa($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $suma = 0;

         $sqlOrden = "SELECT orden_id,
                             orden_precioventa
                        from orden
                       where orden_estado = 'Entregado'
                         and orden_mesa = '$datos[1]'
                         and orden_caja = '$datos[2]'";
         $queryOrden = mysqli_query($conexion, $sqlOrden);

         while ($orden = mysqli_fetch_row($queryOrden)) {
            $sqlCobro = "UPDATE orden
                            set orden_movimiento = '$datos[0]',
                                orden_estado = 'cobrado'
                          where orden_id = '$orden[0]'
                            and orden_mesa = '$datos[1]'
                            and orden_caja = '$datos[2]'";
            $queryCobro = mysqli_query($conexion, $sqlCobro);
            $suma = $suma + $orden[1];
         }
         return = $suma;
      }
   }
?>
