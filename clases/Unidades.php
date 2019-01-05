
<?php
   require_once "Gonexion.php";

   class unidades{

      public function guardaUnidad($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlUnidad = "INSERT into unidad (
                                   unidad_medida,
                                   unidad_fecha,
                                   unidad_persona)
                           values ('$datos[0]',
                                   '$datos[1]',
                                   '$datos[2]')";
         return mysqli_query($conexion, $sqlUnidad);
      }
   }
?>
