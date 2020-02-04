
<?php
   require_once "Gonexion.php";

   class orden2{

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
                                 '$datos[3]',
                                 'Registrado',
                                 '$datos[2]',
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

   }
?>
