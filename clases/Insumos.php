
<?php
   require_once "Gonexion.php";

   class insumos{

      public function guardaInsumo($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlInsumo = "INSERT into insumo (
                                   insumo_codigo,
                                   insumo_nombre,
                                   insumo_imagen,
                                   insumo_marca,
                                   insumo_familia,
                                   insumo_fecha,
                                   insumo_persona)
                           values ('$datos[0]',
                                   '$datos[1]',
                                   '1',
                                   '$datos[2]',
                                   '$datos[3]',
                                   '$datos[4]',
                                   '$datos[5]')";
         return mysqli_query($conexion, $sqlInsumo);
      }
   }


?>
