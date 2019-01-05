
<?php
   require_once "Gonexion.php";

   class imagenes{

      public function guardaImagen($datos){
      $c = new conectar();
      $conexion = $c->conexion();

      $sql = "INSERT into imagen (
                          imagen_ruta,
                          imagen_fecha,
                          imagen_persona)
                  values ('$datos[0]',
                          '$datos[1]',
                          '$datos[2]')";
      $query = mysqli_query($conexion, $sql);
      return mysqli_insert_id($conexion);
    }

   }
?>
