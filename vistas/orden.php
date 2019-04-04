
<?php
   session_start();
   if(isset($_SESSION['caja']) && ($_SESSION['cargo']==("Mesero"||"Administrador") || $_SESSION['tipo']=="Empresario")){
      require_once "menu.php";
      $numMesa = $_GET['numMesa'];

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
         <div class="col-sm-6" id="cargaTablaOrden"></div>
         <div class="col-sm-6">
            <div class="row">
               <div class="col-xs-3" id="cargaTablaGrupos"></div>
               <div class="col-xs-9" id="cargaTablaLista"></div>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modalNuevaOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">NUEVA ORDEN</h4>
            </div>
            <div class="modal-body">
               <form id="frmNuevaOrden">
                  <input type="text" name="mesaOr" id="mesaOr" value="<?php echo $numMesa; ?>" hidden>
                  <input type="text" name="productoOr" id="productoOr" hidden>
                  <input type="text" class="form-control" name="nombreOr" id="nombreOr" title="Nombre de Producto" readonly><p></p>
                  <div class="input-group">
                     <div class="input-group-addon">S/ </div>
                     <input type="text" class="form-control" name="precioOr" id="precioOr" title="Precio de Producto" readonly>
                  </div><p></p>
                  <input type="text" class="form-control" name="cantidadOr" id="cantidadOr" title="Cantidad" placeholder="Cantidad"><p></p>
                  <span class="btn btn-primary" id="btnGuardaOrden">Registrar</span>
               </form>
            </div>
         </div>
      </div>
   </div>
</body>
</html>

<script type="text/javascript">
   $(document).ready(function(){
      $('#cargaTablaOrden').load("tablas/tablaOrden.php?mesa="+<?php echo $numMesa; ?>);
      $('#cargaTablaGrupos').load("tablas/tablaGrupos.php");

      $('#btnGuardaOrden').click(function(){
			vacios = validarFrmVacio('frmNuevaOrden');
			if(vacios > 0){
				alertify.alert("Debes llenar la cantidad.");
				return false;
			}
			datos = $('#frmNuevaOrden').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/orden2.php",
				success:function(r){
					if(r==1){
                  $('#frmNuevaOrden')[0].reset();
                  $('#cargaTablaOrden').load("tablas/tablaOrden.php?mesa="+<?php echo $numMesa; ?>);
                  $('#modalNuevaOrden').modal('hide');
                  alertify.success("Orden registrada.");
					}else{
						alertify.error("Fallo al registrar.");
					}
				}
			});
		});

   });
</script>

<script type="text/javascript">
   function verLista(idGrupo,grupo) {
      $('#cargaTablaLista').load("tablas/tablaLista.php?idGrupo="+idGrupo+"&nombre="+grupo);
   }
</script>

<script type="text/javascript">
   function agregaDato(idProd,nombreProd,precioProd){
      $('#productoOr').val(idProd);
      $('#nombreOr').val(nombreProd);
      $('#precioOr').val(precioProd);
   }

   function entregaOrden(orden){
      $.ajax({
         type:"POST",
         data:"idOrden="+orden,
         url:"../procesos/gestion/ordenEntregada.php",
         success:function(r){
            if(r==1){
               $('#cargaTablaOrden').load("tablas/tablaOrden.php?mesa="+<?php echo $numMesa; ?>);
               alertify.success("Orden entregada.");
            }else{
               alertify.error("Fallo al registrar.");
            }
         }
      });
   }
</script>

<?php
} else {
   header("location:inicio.php");
}
?>
