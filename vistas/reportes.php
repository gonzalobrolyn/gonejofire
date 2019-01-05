
<?php
   session_start();
   if(isset($_SESSION['caja']) && ($_SESSION['cargo']=="Administrador" || $_SESSION['tipo']=="Empresario")){
      require_once "menu.php";
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
         </div>
         <div class="col-sm-4" style="text-align: center">
            <h3>REPORTES</h3>
         </div>
         <div class="col-sm-4" style="text-align: right">
            <p></p>
            <form id="frmBuscaMovimiento" class="form-inline">
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-addon">Buscar</div>
                     <input type="text" class="form-control" id="buscaMovimiento" placeholder="...">
                  </div>
               </div>
            </form>
         </div>
         <div id="cargaTablaMovimientos"></div>
      </div>
   </div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
      $('#cargaTablaMovimientos').load('tablas/tablaMovimientos.php');
   });
</script>

<?php
   } else {
      header("location:inicio.php");
   }
?>
