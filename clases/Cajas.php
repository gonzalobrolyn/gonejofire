
<?php
   require_once "Gonexion.php";

   class cajas{

      public function guardaCaja($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlCaja = "INSERT into caja (
                                 caja_nombre,
                                 caja_empresa,
                                 caja_direccion,
                                 caja_telefono,
                                 caja_llave,
                                 caja_fecha,
                                 caja_persona)
                         values ('$datos[0]',
                                 '$datos[1]',
                                 '$datos[2]',
                                 '$datos[3]',
                                 '$datos[4]',
                                 '$datos[5]',
                                 '$datos[6]')";
         $queryCaja = mysqli_query($conexion, $sqlCaja);
         $idCaja = mysqli_insert_id($conexion);
         if ($idCaja > 0) {
            $_SESSION['caja'] = $idCaja;
            return 1;
         } else {
            return 0;
         }
      }

      public function restaSoles($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlcaja = "SELECT caja_soles
                       from caja
                      where caja_id = '$datos[1]'";
         $queryCaja = mysqli_query($conexion, $sqlcaja);
         $resultCaja = mysqli_fetch_row($queryCaja)[0];

         $efectivo = $resultCaja - $datos[0];

         $sqlSoles = "UPDATE caja
                         set caja_soles = '$efectivo'
                       where caja_id = '$datos[1]'";
         return mysqli_query($conexion, $sqlSoles);
      }
   }
?>
