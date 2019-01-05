
<?php
   require_once "Gonexion.php";

   class almacen{

      public function actualizaInfoStok($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $cantidadControl = $datos[4]*$datos[6];

         $sqlAlmacen = "UPDATE almacen
                           set almacen_unidad = '$datos[2]',
                               almacen_medida = '$datos[3]',
                               almacen_cantidad = '$datos[4]',
                               almacen_minimo = '$datos[5]',
                               almacen_control = '$cantidadControl'
                         where almacen_id = '$datos[1]'
                           and almacen_caja = '$datos[0]'";
         return mysqli_query($conexion, $sqlAlmacen);
      }
   }
?>
