
<?php
   session_start();
   require_once "../../clases/Gonexion.php";
   $c = new conectar();
   $conexion = $c->conexion();

   $idEmpresa = $_SESSION['empresa'];

   $sqlCaja = "SELECT caja_id,
                      caja_nombre,
                      caja_direccion,
                      caja_telefono,
                      caja_llave
                 from caja
                where caja_empresa = '$idEmpresa'";
   $queryCaja = mysqli_query($conexion, $sqlCaja);
?>

<div class="container-fluid">
   <div class="row">
      <?php while ($verCaja = mysqli_fetch_row($queryCaja)): ?>
      <table class="table table-hover table-condensed table-bordered" style="text-align: center">
         <tr>
            <td><b>CAJA</b></td>
            <td><b>DIRECCION</b></td>
            <td><b>TELEFONO</b></td>
            <td><b>LLAVE</b></td>
            <td><b>EDITAR</b></td>
         </tr>
         <tr>
            <td><?php echo $verCaja[1]; ?></td>
            <td><?php echo $verCaja[2]; ?></td>
            <td><?php echo $verCaja[3]; ?></td>
            <td><?php echo $verCaja[4]; ?></td>
            <td>
               <span class="btn btn-default btn-sm">
                  <span class="glyphicon glyphicon-pencil"></span>
               </span>
            </td>
         </tr>
      </table>

      <div class="table-responsive">
      <table class="table table-hover table-condensed table-bordered table-responsive" style="text-align: center">
         <tr>
            <td colspan="9">
               <div class="col-sm-6" style="text-align: right">
                  <h4>USUARIOS</h4>
               </div>
               <div class="col-sm-6" style="text-align: left"> <p></p>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalEmpleado" onclick="agregaDato2('<?php echo $verCaja[0]; ?>')">
                     <span class="glyphicon glyphicon-plus"></span>
                  </button>
               </div>
            </td>
         </tr>
         <tr>
            <td><b>DNI</b></td>
            <td><b>NOMBRE</b></td>
            <td><b>CELULAR</b></td>
            <td><b>USUARIO</b></td>
            <td><b>CARGO</b></td>
            <td><b>SUELDO</b></td>
            <td><b>DIA D PAGO</b></td>
            <td><b>FOTO</b></td>
            <td><b>EDITAR</b></td>
         </tr>
         <?php
         $sqlEmpleado = "SELECT usu.usuario_id,
                             usu.usuario_usuario,
                             usu.usuario_cargo,
                             usu.usuario_sueldo,
                             usu.usuario_diapago,
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
                       where usu.usuario_caja = '$verCaja[0]'";
         $queryEmpleado = mysqli_query($conexion, $sqlEmpleado);

         while ($verEmpl = mysqli_fetch_row($queryEmpleado)): ?>
            <?php $nombre = $verEmpl[6].' '.$verEmpl[7]; ?>
            <tr>
               <td><?php echo $verEmpl[5]; ?></td>
               <td><?php echo $nombre; ?></td>
               <td><?php echo $verEmpl[8]; ?></td>
               <td><?php echo $verEmpl[1]; ?></td>
               <td><?php echo $verEmpl[2]; ?></td>
               <td><?php echo $verEmpl[3]; ?></td>
               <td><?php echo $verEmpl[4]; ?></td>
               <td>
                  <?php
                  $img = explode("/",$verEmpl[9]);
                  $ruta = $img[1]."/".$img[2]."/".$img[3];
                  ?>
                  <img src="<?php echo $ruta; ?>" class="img-responsive" alt="Responsive image" height="120">
               </td>
               <td>
                  <span class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalAsignaCaja" onclick="agregaDato('<?php echo $verEmpl[0]; ?>','<?php echo $nombre; ?>')">
                     <span class="glyphicon glyphicon-pencil"></span>
                  </span>
               </td>
            </tr>
         <?php endwhile; ?>

      </table>
      </div>
      <?php endwhile; ?>
   </div>
</div>
