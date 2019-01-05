
<?php
   require_once "Gonexion.php";

   class familias{

      public function guardaFamilia($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlFamilia = "INSERT into familia (
                                    familia_nombre,
                                    familia_fecha,
                                    familia_persona)
                            values ('$datos[0]',
                                    '$datos[1]',
                                    '$datos[2]')";
         return mysqli_query($conexion, $sqlFamilia);
      }
   }
?>
