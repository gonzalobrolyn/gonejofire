
<?php
   require_once "Gonexion.php";

   class productos{

      public function guardaProducto($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlProducto = "INSERT into producto (
                                     producto_codigo,
                                     producto_nombre,
                                     producto_resumen,
                                     producto_carta,
                                     producto_grupo,
                                     producto_precio,
                                     producto_fecha,
                                     producto_persona,
                                     producto_caja)
                             values ('$datos[0]',
                                     '$datos[1]',
                                     '$datos[2]',
                                     '$datos[3]',
                                     '$datos[4]',
                                     '$datos[5]',
                                     '$datos[6]',
                                     '$datos[7]',
                                     '$datos[8]')";
         return mysqli_query($conexion, $sqlProducto);
      }

      public function editaImgProd($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlImgProd = "UPDATE producto
                           set producto_imagen = '$datos[0]'
                         where producto_id = '$datos[1]'";
         return mysqli_query($conexion, $sqlImgProd);
      }

      public function editaProducto($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlProducto = "UPDATE producto
                            set producto_codigo = '$datos[1]',
                                producto_nombre = '$datos[2]',
                                producto_resumen = '$datos[3]',
                                producto_carta = '$datos[4]',
                                producto_grupo = '$datos[5]',
                                producto_precio = '$datos[6]',
                                producto_fecha = '$datos[7]',
                                producto_persona = '$datos[8]'
                          where producto_id = '$datos[0]'
                            and producto_caja = '$datos[9]'";
         return mysqli_query($conexion, $sqlProducto);
      }
   }
?>
