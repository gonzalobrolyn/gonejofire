
<?php
   session_start();
   if(isset($_SESSION['caja']) && ($_SESSION['cargo']=="Administrador" || $_SESSION['tipo']=="Empresario")){
      require_once "menu.php";
      require_once "../clases/Gonexion.php";

      $c = new conectar();
      $conexion = $c->conexion();

      $sqlMuno = "SELECT unidad_id,
                         unidad_medida
                    from unidad";
      $queryMuno = mysqli_query($conexion, $sqlMuno);

      $sqlMcon = "SELECT unidad_id,
                         unidad_medida
                    from unidad";
      $queryMcon = mysqli_query($conexion, $sqlMcon);
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
         <div class="col-sm-4">
            <p></p>
            <p>
               <span data-toggle="modal" data-target="#modalNuevaMedida" class="btn btn-info">Registrar Medida</span>
            </p>
         </div>
         <div class="col-sm-4" style="text-align: center">
            <h3>ALMACEN</h3>
         </div>
         <div class="col-sm-4" style="text-align: right">
            <p></p>
            <form id="frmBuscaAlmacen" class="form-inline">
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-addon">Buscar</div>
                     <input type="text" class="form-control" id="buscaAlmacen" placeholder="...">
                  </div>
               </div>
            </form>
         </div>
         <div id="cargaTablaAlmacen"></div>
      </div>
   </div>
   <div class="modal fade" id="modalNuevaMedida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">NUEVA MEDIDA</h4>
            </div>
            <div class="modal-body">
               <form id="frmMedida">
                  <input type="text" class="form-control" name="nombre" id="nombre" title="Nombre de Medida" placeholder="Nombre de Medida"><p></p>
                  <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
                  <span class="btn btn-primary" id="guardarMedida">Registrar</span>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="modalCompletarInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">COMPLETAR INFORMACION</h4>
            </div>
            <div class="modal-body">
               <form id="frmInformacion">
                  <input type="text" hidden name="idAlmacen" id="idAlmacen">
                  <select class="form-control" name="medidaDunidad" id="medidaDunidad" title="Medida de Uno">
                     <option value="A">Medida de uno.</option>
                     <?php while ($verMuno = mysqli_fetch_row($queryMuno)): ?>
                        <option value="<?php echo $verMuno[0]; ?>">
                           <?php echo $verMuno[1]; ?>
                        </option>
                     <?php endwhile; ?>
                  </select><p></p>
                  <select class="form-control" name="medidaDcontrol" id="medidaDcontrol" title="Medida de Control">
                     <option value="A">Medida de control.</option>
                     <?php while ($verMcon = mysqli_fetch_row($queryMcon)): ?>
                        <option value="<?php echo $verMcon[0]; ?>">
                           <?php echo $verMcon[1]; ?>
                        </option>
                     <?php endwhile; ?>
                  </select><p></p>
                  <input type="text" class="form-control" name="cantidadXunidad" id="cantidadXunidad" title="Cantidad por Uno" placeholder="Cantidad por Uno"><p></p>
                  <input type="text" class="form-control" name="cantidadMinima" id="cantidadMinima" title="Cantidad Minima" placeholder="Cantidad Minima"><p></p>
                  <input type="text" hidden name="cantidadActual" id="cantidadActual">
                  <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
                  <span class="btn btn-primary" id="guardarInformacion">Registrar</span>
               </form>
            </div>
         </div>
      </div>
   </div>
</body>
</html>

<script type="text/javascript">
   $(document).ready(function(){
      $('#cargaTablaAlmacen').load('tablas/tablaAlmacen.php');

      $('#guardarMedida').click(function(){
			vacios = validarFrmVacio('frmMedida');
			if(vacios > 0){
				alertify.alert("Debes llenar el nombre de la medida.");
				return false;
			}
			datos = $('#frmMedida').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/unidad.php",
				success:function(r){
					if(r==1){
                  window.location="almacen.php";
					}else{
						alertify.error("Fallo al agregar.");
					}
				}
			});
		});

      $('#guardarInformacion').click(function(){
			vacios = validarFrmVacio('frmInformacion');
			if(vacios > 0){
				alertify.alert("Debes llenar todos los datos.");
				return false;
			}
			datos = $('#frmInformacion').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/gestion/guardaInfoStok.php",
				success:function(r){
					if(r==1){
                  $('#frmInformacion')[0].reset();
                  $('#cargaTablaAlmacen').load('tablas/tablaAlmacen.php');
                  $('#modalCompletarInfo').modal('hide');
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
   function agregaDato(idAlmacen, cantidadActual){
      $('#idAlmacen').val(idAlmacen);
      $('#cantidadActual').val(cantidadActual);
   }
</script>

<?php
   } else {
      header("location:inicio.php");
   }
?>
