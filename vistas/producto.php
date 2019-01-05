
<?php
   session_start();
   if(isset($_SESSION['caja']) && ($_SESSION['cargo']=="Administrador" || $_SESSION['tipo']=="Empresario")){
      require_once "menu.php";
      require_once "../clases/Gonexion.php";

      $c = new conectar();
      $conexion = $c->conexion();

      $idProducto = $_GET['idProducto'];
      $idCaja = $_SESSION['caja'];

      $sqlProd = "SELECT pro.producto_codigo,
                         car.carta_nombre,
                         gru.grupo_nombre,
                         pro.producto_nombre,
                         pro.producto_resumen,
                         pro.producto_precio,
                         ima.imagen_ruta
                    from producto as pro
              inner join carta as car
                      on pro.producto_carta = car.carta_id
              inner join grupo as gru
                      on pro.producto_grupo = gru.grupo_id
               left join imagen as ima
                      on pro.producto_imagen = ima.imagen_id
                   where pro.producto_id = '$idProducto'
                     and pro.producto_caja = '$idCaja'";
      $queryProd = mysqli_query($conexion, $sqlProd);
      $verProd = mysqli_fetch_row($queryProd);

      $sqlCarta = "SELECT carta_id,
                          carta_nombre
                     from carta
                    where carta_caja = '$idCaja'";
      $queryCarta = mysqli_query($conexion, $sqlCarta);

      $sqlGrupo = "SELECT grupo_id,
                          grupo_nombre
                     from grupo
                    where grupo_caja = '$idCaja'";
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
         <div class="col-sm-8" style="text-align: center">
            <div class="col-sm-2">
               <p></p>
               <span class="btn btn-success" data-toggle="modal" data-target="#modalEditarImagen">Editar Imagen</span><p></p>
               <span class="btn btn-info" data-toggle="modal" data-target="#modalEditarProducto">Editar Producto </span><p></p>
            </div>
            <div class="col-sm-10">
               <h3><?php echo $verProd[3]; ?></h3>
               <p>
                  <?php echo $verProd[1]." - ".$verProd[2]." - ".$verProd[0]; ?>
               </p>
               <p>
                  <?php echo $verProd[4]; ?>
               </p>
               <h3><?php echo 'S/ '.$verProd[5]; ?></h3>
            </div>
            <div class="col-sm-6">
               <p>
                  <?php
                     if ($verProd[6] <> NULL):
                        $img = explode("/",$verProd[6]);
                        $ruta = $img[1]."/".$img[2]."/".$img[3];
                  ?>
                     <img src="<?php echo $ruta; ?>" class="img-responsive" alt="Responsive image">
                  <?php endif; ?>
               </p>
            </div>
            <div class="col-sm-6" id="cargaTablaReceta"></div>
         </div>
         <div class="col-sm-4" style="text-align: right">
            <p></p>
            <form id="frmBuscaInsumo" class="form-inline">
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-addon">Buscar Insumo</div>
                     <input type="text" class="form-control" id="buscaInsumo" placeholder="...">
                  </div>
               </div>
            </form>
            <div id="cargaResultado"></div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modalEditarImagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">EDITAR IMAGEN</h4>
            </div>
            <div class="modal-body">
               <form id="frmEditarImagen" enctype="multipart/form-data">
                  <input type="text" hidden name="idProducto" id="idProducto" value="<?php echo $idProducto; ?>">
                  <input type="file" name="foto" id="foto"><p></p>
                  <span class="btn btn-primary" id="btnSubirImagen">Guardar Imagen</span>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">EDITAR PRODUCTO</h4>
            </div>
            <div class="modal-body">
               <form id="frmEditarProducto">
                  <input type="text" hidden name="producto" id="producto" value="<?php echo $idProducto; ?>">
                  <input type="text" class="form-control" name="codigo" id="codigo" title="Codigo del producto" placeholder="Codigo del producto"><p></p>
                  <input type="text" class="form-control" name="nombre" id="nombre" title="Nombre del producto" placeholder="Nombre del producto"><p></p>
                  <textarea class="form-control" rows="6" name="resumen" id="resumen" title="Ingredientes a mostrar" placeholder="Ingredientes a mostrar"></textarea><p></p>
                  <select class="form-control" name="carta" id="carta" title="Elige una carta">
                     <option value="A">Elige una carta</option>
                     <?php while ($verCarta = mysqli_fetch_row($queryCarta)): ?>
                        <option value="<?php echo $verCarta[0]; ?>">
                           <?php echo $verCarta[1]; ?>
                        </option>
                     <?php endwhile; ?>
                  </select><p></p>
                  <select class="form-control" name="grupo" id="grupo" title="Elige un grupo">
                     <option value="A">Elige un grupo</option>
                     <?php while ($verGrupo = mysqli_fetch_row($queryGrupo)): ?>
                        <option value="<?php echo $verGrupo[0]; ?>">
                           <?php echo $verGrupo[1]; ?>
                        </option>
                     <?php endwhile; ?>
                  </select><p></p>
                  <input type="text" class="form-control" name="precio" id="precio" title="Precio del producto" placeholder="Precio del producto"><p></p>
                  <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
                  <span class="btn btn-primary" id="btnEditarProducto">Registrar</span>
               </form>
            </div>
         </div>
      </div>
   </div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){

      $('#btnSubirImagen').click(function(){
         vacios = validarFrmVacio('frmEditarImagen');
         if (vacios > 0) {
            alertify.alert("Debes seleccionar una imagen.");
            return false;
         }
         var formData = new FormData(document.getElementById("frmEditarImagen"));
         $.ajax({
            url: "../procesos/registro/imagenes.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(r){
               if (r == 1) {
                  window.location="producto.php?idProducto="+<?php echo $idProducto?>;
               } else {
                  alertify.error("Fallo al agregar.");
               }
            }
         });
      });

      $('#btnEditarProducto').click(function(){
         vacios = validarFrmVacio('frmEditarProducto');
         if(vacios > 0){
            alertify.alert("Debes llenar todos los datos.");
            return false;
         }
         datos = $('#frmEditarProducto').serialize();
         $.ajax({
            type:"POST",
            data:datos,
            url:"../procesos/gestion/editaProducto.php",
            success:function(r){
               if(r==1){
                  window.location="producto.php?idProducto="+<?php echo $idProducto?>;
               }else{
                  alertify.error("Fallo al agregar.");
               }
            }
         });
      });
      //implementar modulo busqueda
      $('#buscaInsumo').change(function(){
         $('#cargaResultado').load("busqueda/buscarInsumo.php");
      });

   });
</script>

<?php
   } else {
      header("location:inicio.php");
   }
?>
