
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
   <meta charset="utf-8">
   <title>GonejoFire</title>
   <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
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
               <br><br><br>
               <div class="panel panel-primary">
     					<div class="panel panel-heading" style="text-align: center">
                     <span data-toggle="modal" data-target="#modalCodigo">
                        <span class="btn btn-primary btn-lg" id="registrar">
                           <span class="glyphicon glyphicon-fire" style="color: #22d0ff"></span> GonejoFire</span>
                     </span>
                  </div>
     					<div class="panel panel-body" style="text-align: center">
     						<p><img src="imagenes/monitor.png" height="222"></p>
     						<form id="frmEntrar">
     					      <input type="text" class="form-control" name="usuario" id="usuario" title="Usuario" placeholder="Usuario"><p></p>
                        <input type="password" class="form-control" name="clave" id="clave" title="Contraseña" placeholder="Contraseña"><p></p>
                        <input type="reset" class="btn btn-info" name="limpiar" value="Limpiar" >
   					      <span class="btn btn-primary" id="entrarSoftware">Entrar</span>
                     </form>
     					</div>
     				</div>
            </div>
            <div class="col-sm-4"></div>
         </div>
         <div class="modal fade" id="modalCodigo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
               <div class="panel panel-danger">
                  <div class="panel panel-heading">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                     <p>¡! Vinculo en desarrollo.</p>
                  </div>
                  <div class="panel panel-body">
                     <form id="frmCodigo">
                        <input type="password" name="codigo" id="codigo" class="form-control">
                        <span class="btn btn-danger" id="entrarRegistro"></span>
                     </form>
                  </div>
               </div>
            </div>
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
		$('#entrarSoftware').click(function(){
  		vacios=validarFrmVacio('frmEntrar');
  			if(vacios > 0){
  				alert("Debes llenar todos los datos.");
  				return false;
  			}
  		datos=$('#frmEntrar').serialize();
  		$.ajax({
  			type:"POST",
  			data:datos,
  			url:"procesos/entrar.php",
  			success:function(r){
  				if(r==1){
            $('#frmEntrar')[0].reset();
            window.location="vistas/inicio.php";
  				}else{
  					alert("Acceso denegado.");
  				}
  			}
  		});
	  });

     $('#entrarRegistro').click(function(){
  		vacios=validarFrmVacio('frmCodigo');
  			if(vacios > 0){
  				window.location="index.php";
  			}
  		datos=$('#frmCodigo').serialize();
  		$.ajax({
  			type:"POST",
  			data:datos,
  			url:"procesos/validar.php",
  			success:function(r){
  				if(r==1){
               $('#frmCodigo')[0].reset();
               window.location="registro.php";
  				}else{
  					window.location="index.php";
  				}
  			}
  		});
	  });
	});
</script>
