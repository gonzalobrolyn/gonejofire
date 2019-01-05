
<?php
   session_start();
   if(isset($_SESSION['caja']) && ($_SESSION['cargo']=="Barman-Cheff" || $_SESSION['tipo']=="Empresario")){
      require_once "menu.php";
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
   <meta charset="utf-8">
   <title></title>
   <meta http-equiv="refresh" content="30">
</head>
<body>
   <div class="container-fluid">
      <div class="row">
         <h2 style="text-align: center">LISTA DE PEDIDOS</h2>
         <div id="cargaTablaPedidos"></div>
      </div>
   </div>
</body>
</html>

<script type="text/javascript">
   $(document).ready(function(){
      $('#cargaTablaPedidos').load('tablas/tablaPedidos.php');
   });
</script>

<script type="text/javascript">
   function preparado(orden){
      $.ajax({
         type: "POST",
         data: "idOrden=" + orden,
         url: "../procesos/gestion/ordenPreparada.php",
         success:function(r){
            if(r == 1){
               window.location="barra.php";
            }else{
               alertify.error("No se registro la compra.");
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
