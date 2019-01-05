
<?php
   session_start();
   if(isset($_SESSION['caja']) && ($_SESSION['cargo']=="Administrador" || $_SESSION['tipo']=="Empresario")){
      require_once "menu.php";
      require_once "../clases/Gonexion.php";

      $c = new conectar();
      $conexion = $c->conexion();

      $sqlFamilia = "SELECT familia_id,
                            familia_nombre
                       from familia";
      $queryFamilia = mysqli_query($conexion, $sqlFamilia);

      $sqlMarca = "SELECT marca_id,
                          marca_nombre
                     from marca";
      $queryMarca = mysqli_query($conexion, $sqlMarca);
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
               <span data-toggle="modal" data-target="#modalNuevaFamilia" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Familia</span>
               <span data-toggle="modal" data-target="#modalNuevaMarca" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Marca</span>
            </p>
            <form id="frmNuevoInsumo">
               <label>Nuevo Insumo</label>
               <select class="form-control" name="familia" id="familia" title="Selecciona Familia">
                  <option value="A">Selecciona Familia</option>
                  <?php while ($verFamilia=mysqli_fetch_row($queryFamilia)): ?>
                     <option value="<?php echo $verFamilia[0]; ?>">
                        <?php echo $verFamilia[1]; ?>
                     </option>
                  <?php endwhile; ?>
               </select> <p></p>
               <select class="form-control" name="marca" id="marca" title="Selecciona Marca">
                  <option value="A">Selecciona Marca</option>
                  <?php while ($verMarca=mysqli_fetch_row($queryMarca)): ?>
                     <option value="<?php echo $verMarca[0]; ?>">
                        <?php echo $verMarca[1]; ?>
                     </option>
                  <?php endwhile; ?>
               </select> <p></p>
               <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Codigo d Insumo" title="Codigo d Insumo"> <p></p>
               <input type="text" name="insumo" id="insumo" class="form-control" placeholder="Nombre d Insumo" title="Nombre d Insumo"> <p></p>
               <input type="reset" class="btn btn-default" name="limpiar" value="Limpiar">
               <button type="button" id="guardarInsumo" class="btn btn-info">
                  Registrar
               </button>
            </form>
         </div>
         <div class="col-sm-10">
            <div id="cargaTablaCompra"></div>
            <div class="col-sm-9" style="text-align: center">
               <h3>INSUMOS</h3>
            </div>
            <div class="col-sm-3" style="text-align: right">
               <p></p>
               <form id="frmBuscaInsumo" class="form-inline">
                  <div class="form-group">
                     <div class="input-group">
                        <div class="input-group-addon">Buscar</div>
                        <input type="text" class="form-control" id="buscaInsumo" placeholder="...">
                     </div>
                  </div>
               </form>
            </div>
            <div id="cargaTablaInsumos"></div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="modalNuevaMarca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">NUEVA MARCA</h4>
            </div>
            <div class="modal-body">
               <form id="frmMarca">
                  <input type="text" class="form-control" name="nombre" id="nombre" title="Nombre de Marca" placeholder="Nombre de Marca"><p></p>
                  <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
                  <span class="btn btn-primary" id="guardarMarca">Registrar</span>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="modalNuevaFamilia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">NUEVA FAMILIA</h4>
            </div>
            <div class="modal-body">
               <form id="frmFamilia">
                  <input type="text" class="form-control" name="nombre" id="nombre" title="Nombre de Familia" placeholder="Nombre de Familia"><p></p>
                  <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
                  <span class="btn btn-primary" id="guardarFamilia">Registrar</span>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="modalCarrtitoCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">ITEM DE COMPRA</h4>
            </div>
            <div class="modal-body">
               <form id="frmCarritoCompra">
                  <input type="text" hidden name="idInsumo" id="idInsumo"><p></p>
                  <input type="text" hidden name="codInsumo" id="codInsumo"><p></p>
                  <input type="text" readonly class="form-control" name="nombreInsumo" id="nombreInsumo" title="Nombre de Familia"><p></p>
                  <input type="text" class="form-control" name="cantidad" id="cantidad" title="Cantidad" placeholder="Cantidad"><p></p>
                  <input type="text" class="form-control" name="precio" id="precio" title="Precio" placeholder="Precio"><p></p>
                  <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
                  <span class="btn btn-primary" id="guardarItem">Guardar</span>
               </form>
            </div>
         </div>
      </div>
   </div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
      $('#cargaTablaCompra').load('tablas/tablaCompraTmp.php');
      $('#cargaTablaInsumos').load('tablas/tablaInsumos.php');

		$('#guardarMarca').click(function(){
			vacios = validarFrmVacio('frmMarca');
			if(vacios > 0){
				alertify.alert("Debes llenar el nombre de la marca.");
				return false;
			}
			datos = $('#frmMarca').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/marcas.php",
				success:function(r){
					if(r==1){
                  window.location="insumos.php";
					}else{
						alertify.error("Fallo al agregar.");
					}
				}
			});
		});

      $('#guardarFamilia').click(function(){
			vacios = validarFrmVacio('frmFamilia');
			if(vacios > 0){
				alertify.alert("Debes llenar el nombre de la familia.");
				return false;
			}
			datos = $('#frmFamilia').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/familias.php",
				success:function(r){
					if(r==1){
                  window.location="insumos.php";
					}else{
						alertify.error("Fallo al agregar.");
					}
				}
			});
		});

      $('#guardarInsumo').click(function(){
			vacios = validarFrmVacio('frmNuevoInsumo');
			if(vacios > 0){
				alertify.alert("Debes llenar todos los datos.");
				return false;
			}
			datos = $('#frmNuevoInsumo').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/gestion/nuevoInsumo.php",
				success:function(r){
					if(r==1){
                  $('#frmNuevoInsumo')[0].reset();
                  $('#cargaTablaInsumos').load('tablas/tablaInsumos.php');
						alertify.success("Agregado con exito.");
					}else{
						alertify.error("Fallo al agregar.");
					}
				}
			});
		});

      $('#guardarItem').click(function(){
			vacios = validarFrmVacio('frmCarritoCompra');
			if(vacios > 0){
				alertify.alert("Debes llenar todos los datos.");
				return false;
			}
			datos = $('#frmCarritoCompra').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/gestion/listaCompraTmp.php",
				success:function(r){
               window.location="insumos.php";
				}
			});
		});
   });
</script>

<script type="text/javascript">
   function agregaDato(idInsumo,codigoInsumo,nombreInsumo){
      $('#idInsumo').val(idInsumo);
      $('#codInsumo').val(codigoInsumo);
      $('#nombreInsumo').val(nombreInsumo);
   }
</script>

<script type="text/javascript">

   function quitarProducto(index){
       $.ajax({
         type:"POST",
         data:"ind=" + index,
         url:"../procesos/gestion/quitarCompraTmp.php",
         success:function(r){
            $('#cargaTablaCompra').load('tablas/tablaCompraTmp.php');
            alertify.success("Se quito el producto.");
         }
       });
   }

   function vaciarLista(){
      $.ajax({
         url:"../procesos/gestion/vaciarCompraTmp.php",
         success:function(r){
            $('#cargaTablaCompra').load('tablas/tablaCompraTmp.php');
            alertify.success("Se quito toda la Lista.");
         }
      });
   }

   function compra(suma){
      $.ajax({
         type: "POST",
         data: "total=" + suma,
         url: "../procesos/gestion/compra.php",
         success:function(r){
            if(r > 0){
               $('#cargaTablaCompra').load('tablas/tablaCompraTmp.php');
               alertify.success("Compra registrada con exito.");
            }else{
               alertify.error("No se registro la compra.");
            }
         }
      });
   }
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#familia').select2();
    $('#marca').select2();
  });
</script>

<?php
   } else {
      header("location:inicio.php");
   }
?>
