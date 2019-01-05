
<?php
   require_once "Gonexion.php";

   class entradas{

      public function registraEntrada($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlAlmacen = "SELECT almacen_id,
                               almacen_precio,
                               almacen_existe
                          from almacen
                         where almacen_insumo = '$datos[1]'
                           and almacen_caja = '$datos[6]'";
         $queryAlmacen = mysqli_query($conexion, $sqlAlmacen);
         $rAlmacen = mysqli_fetch_row($queryAlmacen);
         $nuevaCan = $rAlmacen[2] + $datos[2];

         $sqlEntra = "INSERT into entrada(
                                  entrada_movimiento,
                                  entrada_insumo,
                                  entrada_cantidad,
                                  entrada_entracan,
                                  entrada_nuevacan,
                                  entrada_precio,
                                  entrada_preciocompra,
                                  entrada_fecha,
                                  entrada_persona,
                                  entrada_caja)
                          values ('$datos[0]',
                                  '$datos[1]',
                                  '$rAlmacen[2]',
                                  '$datos[2]',
                                  '$nuevaCan',
                                  '$rAlmacen[1]',
                                  '$datos[3]',
                                  '$datos[4]',
                                  '$datos[5]',
                                  '$datos[6]')";
         $queryEntra = mysqli_query($conexion, $sqlEntra);

         if ($rAlmacen[0] == NULL) {
            $sqlAlmacena = "INSERT into almacen(
                                        almacen_insumo,
                                        almacen_precio,
                                        almacen_actual,
                                        almacen_caja)
                                values ('$datos[1]',
                                        '$datos[3]',
                                        '$datos[2]',
                                        '$datos[6]')";
            return mysqli_query($conexion, $sqlAlmacena);
         }
         // falta codigo para cuando ya existe el insumo

      }
   }
?>
