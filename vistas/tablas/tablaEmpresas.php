
<?php
   session_start();
   require_once "../../clases/Gonexion.php";
   $c = new conectar();
   $conexion = $c->conexion();
   $idEmpresa = $_SESSION['empresa'];
   $idPersona = $_SESSION['persona'];

   $sqlEmpresa = "SELECT emp.empresa_id,
                         emp.empresa_ruc,
                         emp.empresa_razon,
                         emp.empresa_direccion,
                         ima.imagen_ruta
                    from empresa as emp
              inner join imagen as ima
                      on emp.empresa_logo = ima.imagen_id
              inner join usuario as usu
                      on usu.usuario_empresa = emp.empresa_id
                   where usu.usuario_empresa = '$idEmpresa'
                     and usu.usuario_tipo = 'Empresario'
                     and usu.usuario_persona = '$idPersona'";
   $queryEmpresa = mysqli_query($conexion, $sqlEmpresa);
?>

<div class="container-fluid">
   <div class="row">
      <?php while ($verEmp = mysqli_fetch_row($queryEmpresa)): ?>
      <table class="table table-hover table-condensed table-bordered" style="text-align: center">
         <tr>
            <td><b>RUC</b></td>
            <td><?php echo $verEmp[1]; ?></td>
            <td rowspan="4">
               <?php
               $img = explode("/",$verEmp[4]);
               $ruta = $img[1]."/".$img[2]."/".$img[3];
               ?>
               <img src="<?php echo $ruta; ?>" class="img-responsive" alt="Responsive image" height="120">
            </td>
         </tr>
         <tr>
            <td><b>RAZON</b></td>
            <td><?php echo $verEmp[2]; ?></td>
         </tr>
         <tr>
            <td><b>DIRECCION</b></td>
            <td><?php echo $verEmp[3]; ?></td>
         </tr>
         <tr>
            <td><b>EDITAR</b></td>
            <td>
               <span class="btn btn-default btn-sm">
                  <span class="glyphicon glyphicon-pencil"></span>
               </span>
            </td>
         </tr>
      </table>

      <table class="table table-hover table-condensed table-bordered" style="text-align: center">
         <tr>
            <td colspan="6">
               <div class="col-sm-6" style="text-align: right">
                  <h4>SOCIOS</h4>
               </div>
               <div class="col-sm-6" style="text-align: left"> <p></p>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalSocio">
                     <span class="glyphicon glyphicon-plus"></span>
                  </button>
               </div>
            </td>
         </tr>
         <tr>
            <td><b>DNI</b></td>
            <td><b>USUARIO</b></td>
            <td><b>NOMBRE</b></td>
            <td><b>CELULAR</b></td>
            <td><b>FOTO</b></td>
            <td><b>EDITAR</b></td>
         </tr>
         <?php
            $sqlSocio = "SELECT usu.usuario_id,
                                usu.usuario_usuario,
                                per.persona_dni,
                                per.persona_nombre,
                                per.persona_apellido,
                                per.persona_celular,
                                ima.imagen_ruta
                           from usuario as usu
                     inner join persona as per
                             on usu.usuario_persona = per.persona_id
                     inner join imagen as ima
                             on per.persona_foto = ima.imagen_id
                          where usu.usuario_tipo = 'Empresario'
                            and usu.usuario_empresa = '$verEmp[0]'";
            $querySocio = mysqli_query($conexion, $sqlSocio);

            while ($verSocio = mysqli_fetch_row($querySocio)): ?>
               <?php $nombre = $verSocio[3].' '.$verSocio[4]; ?>
            <tr>
               <td><?php echo $verSocio[2]; ?></td>
               <td><?php echo $verSocio[1]; ?></td>
               <td><?php echo $nombre; ?></td>
               <td><?php echo $verSocio[5]; ?></td>
               <td>
                  <?php
                  $img = explode("/",$verSocio[6]);
                  $ruta = $img[1]."/".$img[2]."/".$img[3];
                  ?>
                  <img src="<?php echo $ruta; ?>" class="img-responsive" alt="Responsive image" height="120">
               </td>
               <td>
                  <span class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalAsignaCaja" onclick="agregaDato('<?php echo $verSocio[0]; ?>','<?php echo $nombre; ?>')">
                     <span class="glyphicon glyphicon-pencil"></span>
                  </span>
               </td>
            </tr>

         <?php endwhile; ?>

      </table>
      <?php endwhile; ?>
   </div>
</div>
