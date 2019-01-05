
<?php
   require_once "Gonexion.php";

   class cartas{

      public function guardaCarta($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlCarta = "INSERT into carta (
                                  carta_nombre,
                                  carta_fecha,
                                  carta_persona,
                                  carta_caja)
                          values ('$datos[0]',
                                  '$datos[1]',
                                  '$datos[2]',
                                  '$datos[3]')";
         return mysqli_query($conexion, $sqlCarta);
      }
   }
?>
