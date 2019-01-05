
<?php
   require_once "Gonexion.php";

   class mesas{

      public function guardaMesa($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlMesa = "INSERT into mesa (
                                 mesa_numero,
                                 mesa_fila,
                                 mesa_columna,
                                 mesa_fecha,
                                 mesa_persona,
                                 mesa_caja)
                        values ('$datos[0]',
                                '$datos[1]',
                                '$datos[2]',
                                '$datos[3]',
                                '$datos[4]',
                                '$datos[5]')";
         return mysqli_query($conexion, $sqlMesa);
      }
   }
?>
