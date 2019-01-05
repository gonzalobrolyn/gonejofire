
<?php
   require_once "Gonexion.php";

   class directorio{
      public function registroDirectorio($datos){
         $c = new conectar();
         $conexion = $c->conexion();
         $sqlPersona = "INSERT into persona (
                                    persona_dni,
                                    persona_nombre,
                                    persona_apellido,
                                    persona_celular,
                                    persona_foto,
                                    persona_fecha)
                            values ('$datos[0]',
                                    '$datos[1]',
                                    '$datos[2]',
                                    '$datos[6]',
                                    '1',
                                    '$datos[7]')";
         $queryPersona = mysqli_query($conexion, $sqlPersona);
         $resultPersona = mysqli_insert_id($conexion);
         if ($resultPersona > 0) {
            $sqlUsuario = "INSERT into usuario (
                                       usuario_usuario,
                                       usuario_clave,
                                       usuario_tipo,
                                       usuario_empresa,
                                       usuario_fecha,
                                       usuario_persona)
                               values ('$datos[3]',
                                       '$datos[4]',
                                       'Empresario',
                                       '$datos[5]',
                                       '$datos[7]',
                                       '$resultPersona')";
            return mysqli_query($conexion, $sqlUsuario);
         }
      }
   }
?>
