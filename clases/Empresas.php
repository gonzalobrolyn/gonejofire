
<?php
   require_once "Gonexion.php";

   class empresas{

      public function guardaEmpresa($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlEmpresa = "INSERT into empresa (
                                    empresa_ruc,
                                    empresa_razon,
                                    empresa_direccion,
                                    empresa_logo,
                                    empresa_fecha,
                                    empresa_persona)
                            values ('$datos[0]',
                                    '$datos[1]',
                                    '$datos[2]',
                                    '$datos[3]',
                                    '$datos[4]',
                                    '$datos[5]')";
         $queryEmpresa = mysqli_query($conexion, $sqlEmpresa);
         $idEmpresa = mysqli_insert_id($conexion);

         if ($idEmpresa > 0) {
            $_SESSION['empresa'] = $idEmpresa;
            $sqlEmpresario = "UPDATE usuario
                                 set usuario_empresa = '$idEmpresa'
                               where usuario_persona = '$datos[5]'";
            return mysqli_query($conexion, $sqlEmpresario);
         } else {
            return 0;
         }
      }
   }
?>
