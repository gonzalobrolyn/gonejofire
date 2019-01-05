
<?php
  session_start();
  if(isset($_SESSION['unidad']) && $_SESSION['unidad'] == "GonejoFire"){
?>

<!DOCTYPE html>
<html>
<head>
	<title>GonejoFire</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.min.css">
	<link rel="icon" type="image/png" href="imagenes/favicon.png" />
	<script src="librerias/jquery-3.2.1.min.js"></script>
   <script src="librerias/bootstrap/js/bootstrap.js"></script>
	<script src="js/funciones.js"></script>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="grid-block" style="background-image: url('imagenes/fondo.jpg'); width: 100%; height: 95vh; ">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<br>
				<div class="panel panel-primary" style="text-align: center">
					<div class="panel panel-heading">GonejoFire - Nuevo Usuario.</div>
					<div class="panel panel-body">
						<form id="frmRegistro">
              			<input type="text" class="form-control" name="dni" id="dni" title="DNI" placeholder="DNI"><p></p>
              			<input type="text" class="form-control" name="nombre" id="nombre" title="Nombre" placeholder="Nombre"><p></p>
							<input type="text" class="form-control" name="apellido" id="apellido" title="Apellido" placeholder="Apellido"><p></p>
							<input type="text" class="form-control" name="usuario" id="usuario" title="Usuario" placeholder="Usuario"><p></p>
              			<input type="password" class="form-control" name="clave" id="clave" title="Contraseña" placeholder="Contraseña"><p></p>
                     <input hidden type="text" name="empresa" id="empresa" value="0">
                  	<input type="text" class="form-control" name="celular" id="celular" title="Celular" placeholder="Celular"><p></p>
							<div class="panel panel-footer">Al hacer click en Registrar, aceptas nuestras <a href="#">condiciones de servicio y politica de datos.</a></div>
							<input type="reset" name="limpiar" value="Limpiar" class="btn btn-default">
							<a href="procesos/salir.php" class="btn btn-info">Regresar</a>
							<span class="btn btn-primary" id="registro">Registrar</span>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
		</div>
	</div>
</body>
<footer style="background-color: black">
	<div class="container-fluid">
		<div class="col-sm-12" style="text-align: center">
			<p></p>
			<p style="color: gray">
				Todos los derechos reservados
				<span class="glyphicon glyphicon-copyright-mark"></span>
				Gonzalo Brolyn -
				<?php echo date('Y'); ?>
			</p>
		</div>
	</div>
</footer>

</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#registro').click(function(){

			vacios=validarFrmVacio('frmRegistro');
			if(vacios > 0){
				alert("Debes llenar todos los datos.");
				return false;
			}
			datos=$('#frmRegistro').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/registro/directorio.php",
				success:function(r){
					if(r==1) {
						window.location = "procesos/salir.php";
					} else {
						alert("Registro denegado.");
					}
				}
			});
		});
	});
</script>

<?php
} else {
  header("location:index.php");
}
?>
