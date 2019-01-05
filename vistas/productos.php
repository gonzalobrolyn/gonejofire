
<?php
   session_start();
   if(isset($_SESSION['caja']) && ($_SESSION['cargo']=="Administrador" || $_SESSION['tipo']=="Empresario")){
      require_once "menu.php";
      require_once "../clases/Gonexion.php";

      $c = new conectar();
      $conexion = $c->conexion();

      $sqlCarta = "SELECT carta_id,
                          carta_nombre
                     from carta";
      $queryCarta = mysqli_query($conexion, $sqlCarta);

      $sqlGrupo = "SELECT grupo_id,
                          grupo_nombre
                     from grupo";
      $queryGrupo = mysqli_query($conexion, $sqlGrupo);
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
   <meta charset="utf-8">
   <title></title>
</head>
<body>
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-2" style="text-align: center">
            <p></p>
            <p>
               <span data-toggle="modal" data-target="#modalNuevaCarta" class="btn btn-info">
                  <span class="glyphicon glyphicon-plus"></span> Carta
               </span>
               <span data-toggle="modal" data-target="#modalNuevoGrupo" class="btn btn-info">
                  <span class="glyphicon glyphicon-plus"></span> Grupo
               </span>
            </p>
            <form id="frmNuevoProducto">
               <label>Nuevo Producto</label>
               <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Codigo d Producto" title="Codigo d Producto"> <p></p>
               <input type="text" name="producto" id="producto" class="form-control" placeholder="Nombre d Producto" title="Nombre d Producto"> <p></p>
               <textarea class="form-control" rows="6" name="resumen" id="resumen" title="Ingredientes a mostrar" placeholder="Ingredientes a mostrar"></textarea><p></p>
               <select class="form-control" name="carta" id="carta" title="Selecciona Carta">
                  <option value="A">Selecciona Carta</option>
                  <?php while ($verCarta=mysqli_fetch_row($queryCarta)): ?>
                     <option value="<?php echo $verCarta[0]; ?>">
                        <?php echo $verCarta[1]; ?>
                     </option>
                  <?php endwhile; ?>
               </select> <p></p>
               <select class="form-control" name="grupo" id="grupo" title="Selecciona Grupo">
                  <option value="A">Selecciona Grupo</option>
                  <?php while ($verGrupo=mysqli_fetch_row($queryGrupo)): ?>
                     <option value="<?php echo $verGrupo[0]; ?>">
                        <?php echo $verGrupo[1]; ?>
                     </option>
                  <?php endwhile; ?>
               </select> <p></p>
               <input type="text" class="form-control" name="precio" id="precio" title="Precio del producto" placeholder="Precio del producto"><p></p>
               <input type="reset" class="btn btn-default" name="limpiar" value="Limpiar">
               <button type="button" id="guardarProducto" class="btn btn-info">
                  Registrar
               </button>
            </form>
         </div>
         <div class="col-sm-10">
            <div class="col-sm-9" style="text-align: center">
               <h3>PRODUCTOS</h3>
            </div>
            <div class="col-sm-3" style="text-align: right">
               <p></p>
               <form id="frmBuscaProducto" class="form-inline">
                  <div class="form-group">
                     <div class="input-group">
                        <div class="input-group-addon">Buscar</div>
                        <input type="text" class="form-control" id="buscaProducto" placeholder="...">
                     </div>
                  </div>
               </form>
            </div>
            <div id="cargaTablaProductos"></div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modalNuevaCarta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">NUEVA CARTA</h4>
            </div>
            <div class="modal-body">
               <form id="frmCarta">
                  <input type="text" class="form-control" name="nombre" id="nombre" title="Nombre de Carta" placeholder="Nombre de Carta"><p></p>
                  <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
                  <span class="btn btn-primary" id="guardarCarta">Registrar</span>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="modalNuevoGrupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">NUEVO GRUPO</h4>
            </div>
            <div class="modal-body">
               <form id="frmGrupo">
                  <input type="text" class="form-control" name="nombre" id="nombre" title="Nombre de Grupo" placeholder="Nombre de Grupo"><p></p>
                  <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
                  <span class="btn btn-primary" id="guardarGrupo">Registrar</span>
               </form>
            </div>
         </div>
      </div>
   </div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){

      $('#cargaTablaProductos').load('tablas/tablaProductos.php');

      $('#guardarCarta').click(function(){
			vacios = validarFrmVacio('frmCarta');
			if(vacios > 0){
				alertify.alert("Debes llenar el nombre de la carta.");
				return false;
			}
			datos = $('#frmCarta').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/cartas.php",
				success:function(r){
					if(r==1){
                  window.location="productos.php";
					}else{
						alertify.error("Fallo al agregar.");
					}
				}
			});
		});

      $('#guardarGrupo').click(function(){
			vacios = validarFrmVacio('frmGrupo');
			if(vacios > 0){
				alertify.alert("Debes llenar el nombre del grupo.");
				return false;
			}
			datos = $('#frmGrupo').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/grupos.php",
				success:function(r){
					if(r==1){
                  window.location="productos.php";
					}else{
						alertify.error("Fallo al agregar.");
					}
				}
			});
		});

      $('#guardarProducto').click(function(){
			vacios = validarFrmVacio('frmNuevoProducto');
			if(vacios > 0){
				alertify.alert("Debes llenar todos los datos.");
				return false;
			}
			datos = $('#frmNuevoProducto').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/gestion/nuevoProducto.php",
				success:function(r){
					if(r==1){
                  $('#frmNuevoProducto')[0].reset();
                  $('#cargaTablaProductos').load('tablas/tablaProductos.php');
						alertify.success("Agregado con exito.");
					}else{
						alertify.error("Fallo al agregar.");
					}
				}
			});
		});

   });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#carta').select2();
    $('#grupo').select2();
  });
</script>

<?php
   } else {
      header("location:inicio.php");
   }
?>
