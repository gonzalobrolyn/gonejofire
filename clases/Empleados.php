
<?php
   require_once "Gonexion.php";

   class empleados{

      public function agragaEmpleado($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlEmpleado = "INSERT into persona (
                                     persona_dni,
                                     persona_nombre,
                                     persona_apellido,
                                     persona_celular,
                                     persona_foto,
                                     persona_fecha)
                             values ('$datos[0]',
                                     '$datos[1]',
                                     '$datos[2]',
                                     '$datos[3]',
                                     '1',
                                     '$datos[10]')";
         $queryEmpleado = mysqli_query($conexion, $sqlEmpleado);
         $resultPersona = mysqli_insert_id($conexion);
         if ($resultPersona > 0) {
            $sqlUsuario = "INSERT into usuario (
                                       usuario_usuario,
                                       usuario_clave,
                                       usuario_tipo,
                                       usuario_empresa,
                                       usuario_caja,
                                       usuario_cargo,
                                       usuario_sueldo,
                                       usuario_diapago,
                                       usuario_fecha,
                                       usuario_persona)
                               values ('$datos[4]',
                                       '$datos[5]',
                                       'Empleado',
                                       '$datos[6]',
                                       '$datos[11]',
                                       '$datos[7]',
                                       '$datos[8]',
                                       '$datos[9]',
                                       '$datos[10]',
                                       '$resultPersona')";
            return mysqli_query($conexion, $sqlUsuario);
         }
      }

      public function asignaCaja($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $_SESSION['caja'] = $datos[1];
         $sqlAsigna = "UPDATE usuario
                          set usuario_caja = '$datos[1]'
                        where usuario_id = '$datos[0]'
                          and usuario_empresa = '$datos[2]'";
         return mysqli_query($conexion, $sqlAsigna);
      }
   }
?>
