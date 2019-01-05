
<?php
   session_start();
   if(isset($_SESSION['caja']) && ($_SESSION['cargo']=="Mesero" || $_SESSION['tipo']=="Empresario")){
      require_once "menu.php";
      require_once "../clases/Gonexion.php";

      $c = new conectar();
      $conexion = $c->conexion();

      $idCaja = $_SESSION['caja'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
   <meta charset="utf-8">
   <title></title>
   <style media="screen">
      .contenedor{
         position: relative;
         display: inline-block;
         text-align: center;
      }
      .texto-encima{
         position: absolute;
         top: 10px;
         left: 10px;
      }
      .centrado{
         position: absolute;
         top: 47%;
         left: 63%;
         transform: translate(-50%, -50%);
      }
   </style>
</head>
<body>
   <div class="container-fluid">
      <div class="row" style="text-align: right">
         <?php if ($_SESSION['tipo']=='Empresario'): ?>
            <span class="btn btn-info" data-toggle="modal" data-target="#modalNuevaMesa">
               NUEVA MESA
            </span><p></p>
         <?php endif; ?>
      </div>
      <div class="modal fade" id="modalNuevaMesa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">NUEVA MESA</h4>
               </div>
               <div class="modal-body">
                  <form id="frmNuevaMesa">
                     <input type="text" class="form-control" name="numero" id="numero" title="Número de Mesa" placeholder="Número de Mesa"><p></p>
                     <input type="text" class="form-control" name="fila" id="fila" title="Fila de Mesa" placeholder="Fila de Mesa"><p></p>
                     <input type="text" class="form-control" name="columna" id="columna" title="Columna de Mesa" placeholder="Columna de Mesa"><p></p>
                     <input type="reset" id="limpiar" value="Limpiar" class="btn btn-default">
                     <span class="btn btn-primary" id="btnGuardaMesa">Registrar</span>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
      <?php
         $filas = 12;
         $colum = 3;

         for ($i=1; $i<=$filas; $i++):
            for ($j=1; $j<=$colum; $j++):
               $sqlMesa = "SELECT mesa_id,
                                  mesa_numero,
                                  mesa_estado
                             from mesa
                            where mesa_fila = '$i'
                              and mesa_columna = '$j'
                              and mesa_caja = '$idCaja'";
               $queryMesa = mysqli_query($conexion, $sqlMesa);
               $verMesa = mysqli_fetch_row($queryMesa);
               if (isset($verMesa[0])):
      ?>
                  <div class="col-xs-4">
                     <div class="contenedor">
                        <img src="../imagenes/rojoflor2.jpg" class="img-rounded" alt="mesa"/>
                        <div class="centrado">
                           <a href="orden.php?numMesa=<?php echo $verMesa[1]; ?>" class="btn">
                              <h2 style="color: white">
                                 <b><?php echo 'Mesa '.$verMesa[1]; ?></b>
                              </h2>
                           </a>
                        </div>
                     </div><p></p>
                  </div>

               <?php else: ?>
                  <div class="col-xs-4">
                     <div class="contenedor">
                        <img src="../imagenes/neonpulgar.jpg" class="img-rounded" alt="mesa"/>
                        <div class="centrado">
                           <a href="#" class="btn">
                              <h2 style="color: white">
                                 <b>Asignar</b>
                              </h2>
                           </a>
                        </div>
                     </div><p></p>
                  </div>
      <?php
               endif;
            endfor;
         endfor;
      ?>

      </div>
   </div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){

		$('#btnGuardaMesa').click(function(){
			vacios = validarFrmVacio('frmNuevaMesa');
			if(vacios > 0){
				alertify.alert("Debes llenar todos los datos.");
				return false;
			}
			datos = $('#frmNuevaMesa').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/registro/mesas.php",
				success:function(r){
					if(r==1){
                  window.location="mesas.php";
					}else{
						alertify.error("Fallo al agregar.");
					}
				}
			});
		});
   });
</script>

<?php
   } else {
      header("location:inicio.php");
   }
?>
