
<?php
   require_once "Gonexion.php";

   class marcas{

      public function guardaMarca($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlMarca = "INSERT into marca (
                                  marca_nombre,
                                  marca_fecha,
                                  marca_persona)
                          values ('$datos[0]',
                                  '$datos[1]',
                                  '$datos[2]')";
         return mysqli_query($conexion, $sqlMarca);
      }
   }
?>
