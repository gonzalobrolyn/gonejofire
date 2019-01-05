
<?php
   require_once "Gonexion.php";

   class acceso{

      public function validarCodigo($datos){
         $codigo = $datos[0];
         if ($codigo == 'unidadb470') {
            $_SESSION['unidad'] = 'GonejoFire';
            return 1;
         } else {
            return 0;
         }
      }

      public function entrarUsuario($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlUsuario = "SELECT usu.usuario_tipo,
                               usu.usuario_empresa,
                               usu.usuario_caja,
                               usu.usuario_cargo,
                               usu.usuario_persona,
                               per.persona_nombre,
                               per.persona_apellido
                          from usuario as usu
                    inner join persona as per
                            on usu.usuario_persona = per.persona_id
                         where usu.usuario_usuario = '$datos[0]'
                           and usu.usuario_clave = '$datos[1]'";
         $queryUsuario = mysqli_query($conexion, $sqlUsuario);
         $resultUsuario = mysqli_fetch_row($queryUsuario);
         if ($resultUsuario[0] == ('Empleado'||'Empresario')) {
            $_SESSION['tipo'] = $resultUsuario[0];
            $_SESSION['empresa'] = $resultUsuario[1];
            $_SESSION['caja'] = $resultUsuario[2];
            $_SESSION['cargo'] = $resultUsuario[3];
            $_SESSION['persona'] = $resultUsuario[4];
            $_SESSION['usuario'] = $resultUsuario[5].' '.$resultUsuario[6];
            return 1;
         } else {
            return 0;
         }
      }

   }
?>
