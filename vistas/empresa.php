
<?php
   session_start();
   if(isset($_SESSION['usuario']) && $_SESSION['tipo']=="Empresario"){
      require_once "menu.php";
      require_once "../clases/Gonexion.php";
      $c = new conectar();
      $conexion = $c->conexion();

      $idEmpresa = $_SESSION['empresa'];
      $idCaja = $_SESSION['caja'];

      $sqlCaja = "SELECT caja_id,
                         caja_nombre
                    from caja
                   where caja_empresa = '$idEmpresa'";
      $queryCaja = mysqli_query($conexion, $sqlCaja);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
   <meta charset="utf-8">
   <title></title>

</head>
<body>

   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-5" style="text-align: center">
            <div class="col-sm-6" style="text-align: right">
               <h3>EMPRESA</h3>
            </div>
            <?php if ($idEmpresa == 0) : ?>
               <div class="col-sm-6" style="text-align: left"> <br>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalEmpresa">
                     <span class="glyphicon glyphicon-plus"></span>
                  </button>
               </div>
            <?php else : ?>
               <div id="cargaTablaEmpresas"></div>
            <?php endif; ?>
         </div>
         <div class="col-sm-7" style="text-align: center">
            <div class="col-sm-6" style="text-align: right">
               <h3>CAJA</h3>
            </div>
            <?php if ($idCaja == 0): ?>
               <div class="col-sm-6" style="text-align: left"> <br>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalCaja">
                     <span class="glyphicon glyphicon-plus"></span>
                  </button>
               </div>
            <?php endif; ?>
            <div id="cargaTablaCajas"></div>
         </div>
         <div class="modal fade" id="modalEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                     <h4 class="modal-title" id="myModalLabel">AGREGAR EMPRESA</h4>
                  </div>
                  <div class="modal-body">
                     <form id="frmEmpresa" enctype="multipart/form-data">
                        <input type="text" name="ruc" id="ruc" class="form-control" placeholder="RUC" title="RUC"><p></p>
                        <input type="text" name="razon" id="razon" class="form-control" placeholder="Razon" title="Razon"><p></p>
                        <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion" title="Direccion"><p></p>
                        <label for="logo">Selecciona una imagen para el Logo.</label>
                        <input type="file" name="logo" id="logo" class="form-control-file"><p></p>
                        <input type="reset" id="borrarEmpresa" class="btn btn-default" value="Borrar">
                        <button type="button" id="guardarEmpresa" class="btn btn-primary">Guardar</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="modalSocio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                     <h4 class="modal-title" id="myModalLabel">AGREGAR SOCIO</h4>
                  </div>
                  <div class="modal-body">
                     <form id="frmRegistro">
                 			<input type="text" class="form-control" name="dni" id="dni" title="DNI" placeholder="DNI"><p></p>
                 			<input type="text" class="form-control" name="nombre" id="nombre" title="Nombre" placeholder="Nombre"><p></p>
   							<input type="text" class="form-control" name="apellido" id="apellido" title="Apellido" placeholder="Apellido"><p></p>
   							<input type="text" class="form-control" name="usuario" id="usuario" title="Usuario" placeholder="Usuario"><p></p>
                 			<input type="password" class="form-control" name="clave" id="clave" title="Contraseña" placeholder="Contraseña"><p></p>
                        <input hidden type="text" name="empresa" id="empresa" value="<?php echo $idEmpresa; ?>">
                     	<input type="text" class="form-control" name="celular" id="celular" title="Celular" placeholder="Celular"><p></p>
   							<input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
   							<span class="btn btn-primary" id="registroSocio">Registrar</span>
   						</form>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="modalCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                     <h4 class="modal-title" id="myModalLabel">REGISTRAR CAJA</h4>
                  </div>
                  <div class="modal-body">
                     <form id="frmCaja">
                 			<input type="text" class="form-control" name="nombre" id="nombre" title="Nombre de Local" placeholder="Nombre de Local"><p></p>
   							<input type="text" class="form-control" name="direccion" id="direccion" title="Dirección" placeholder="Dirección"><p></p>
   							<input type="text" class="form-control" name="telefono" id="telefono" title="Telefono" placeholder="Telefono"><p></p>
                 			<input type="text" class="form-control" name="llave" id="llave" title="Llave" placeholder="Llave"><p></p>
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
   							<span class="btn btn-primary" id="guardarCaja">Registrar</span>
   						</form>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="modalEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                     <h4 class="modal-title" id="myModalLabel">AGREGAR USUARIO</h4>
                  </div>
                  <div class="modal-body">
                     <form id="frmEmpleado">
                        <input type="text" hidden name="idCaja" id="idCaja">
                 			<input type="text" class="form-control" name="dni" id="dni" title="DNI" placeholder="DNI"><p></p>
                 			<input type="text" class="form-control" name="nombre" id="nombre" title="Nombre" placeholder="Nombre"><p></p>
   							<input type="text" class="form-control" name="apellido" id="apellido" title="Apellido" placeholder="Apellido"><p></p>
   							<input type="text" class="form-control" name="usuario" id="usuario" title="Usuario" placeholder="Usuario"><p></p>
                 			<input type="text" class="form-control" name="clave" id="clave" title="Contraseña" placeholder="Contraseña"><p></p>
                        <select class="form-control" name="cargo" id="cargo" title="Selecciona Cargo">
                           <option value="A">Selecciona Cargo</option>
                           <option value="Administrador">Administrador</option>
                           <option value="Cajero">Cajero</option>
                           <option value="Barman-Cheff">Barmar-Cheff</option>
                           <option value="Mesero">Mesero</option>
                        </select><p></p>
                        <input type="text" class="form-control" name="sueldo" id="sueldo" title="Sueldo" placeholder="Sueldo"><p></p>
                     	<input type="text" class="form-control" name="diaPago" id="diaPago" title="Dia d Pago" placeholder="Dia d Pago"><p></p>
                     	<input type="text" class="form-control" name="celular" id="celular" title="Celular" placeholder="Celular"><p></p>
   							<input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
   							<span class="btn btn-primary" id="registroEmpleado">Registrar</span>
   						</form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modalAsignaCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">ASIGNAR CAJA</h4>
            </div>
            <div class="modal-body">
               <form id="frmAsignaCaja">
                  <input type="text" hidden name="idUsuario" id="idUsuario">
                  <input type="text" readonly name="nombreUser" id="nombreUser" class="form-control"><p></p>
                  <select class="form-control" name="caja" id="caja">
                     <option value="A">Seleccione caja</option>
                     <?php while ($verCaja = mysqli_fetch_row($queryCaja)): ?>
                        <option value="<?php echo $verCaja[0]; ?>">
                           <?php echo $verCaja[1]; ?>
                        </option>
                     <?php endwhile; ?>
                  </select><p></p>
                  <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
                  <span class="btn btn-primary" id="btnAsignaCaja">Asignar</span>
               </form>
            </div>
         </div>
      </div>
   </div>
</body>
</html>

<script type="text/javascript">
   $(document).ready(function(){
      $('#cargaTablaEmpresas').load('tablas/tablaEmpresas.php');
      $('#cargaTablaCajas').load('tablas/tablaCajas.php');

      $('#guardarEmpresa').click(function(){
         vacios = validarFrmVacio('frmEmpresa');
         if (vacios > 0) {
            alertify.alert("Debes llenar todos los datos.");
            return false;
         }
         var formData = new FormData(document.getElementById("frmEmpresa"));
         $.ajax({
            url: "../procesos/registro/empresas.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(r){
               if (r == 1) {
                  window.location="empresa.php";
               } else {
                  alertify.error("Fallo al agregar.");
               }
            }
         });
      });

      $('#registroSocio').click(function(){
			vacios = validarFrmVacio('frmRegistro');
			if(vacios > 0){
				alertify.alert("Debes llenar todos los datos.");
				return false;
			}
			datos = $('#frmRegistro').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/directorio.php",
				success:function(r){
					if(r==1) {
                  window.location="empresa.php";
					} else {
						alertify.error("Registro denegado.");
					}
				}
			});
		});

      $('#guardarCaja').click(function(){
			vacios = validarFrmVacio('frmCaja');
			if(vacios > 0){
				alertify.alert("Debes llenar todos los datos.");
				return false;
			}
			datos = $('#frmCaja').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/cajas.php",
				success:function(r){
					if(r==1) {
                  window.location="empresa.php";
					} else {
						alertify.error("Registro denegado.");
					}
				}
			});
		});

      $('#registroEmpleado').click(function(){
			vacios = validarFrmVacio('frmEmpleado');
			if(vacios > 0){
				alertify.alert("Debes llenar todos los datos.");
				return false;
			}
			datos = $('#frmEmpleado').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/empleados.php",
				success:function(r){
					if(r==1) {
                  window.location="empresa.php";
					} else {
						alertify.error("Registro denegado.");
					}
				}
			});
		});

      $('#btnAsignaCaja').click(function(){
			vacios = validarFrmVacio('frmAsignaCaja');
			if(vacios > 0){
				alertify.alert("Debes seleccionar una caja.");
				return false;
			}
			datos = $('#frmAsignaCaja').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/asignaCaja.php",
				success:function(r){
					if(r==1) {
                  $('#frmAsignaCaja')[0].reset();
                  $('#cargaTablaCajas').load('tablas/tablaCajas.php');
                  alertify.success("Asignación exitosa.");
					} else {
						alertify.error("Registro denegado.");
					}
				}
			});
		});
   });
</script>

<script type="text/javascript">
   function agregaDato(idUsuario,nombre){
      $('#idUsuario').val(idUsuario);
      $('#nombreUser').val(nombre);
   }

   function agregaDato2(idcaja){
      $('#idCaja').val(idcaja);
   }
</script>

<?php
} else {
  header("location:inicio.php");
}
?>
