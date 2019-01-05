
<?php
   require_once "Gonexion.php";

   class grupos{

      public function guardaGrupo($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlGrupo = "INSERT into grupo (
                                  grupo_nombre,
                                  grupo_fecha,
                                  grupo_persona,
                                  grupo_caja)
                          values ('$datos[0]',
                                  '$datos[1]',
                                  '$datos[2]',
                                  '$datos[3]')";
         return mysqli_query($conexion, $sqlGrupo);
      }
   }
?>
