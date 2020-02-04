
<?php
   session_start();
   if(isset($_SESSION['caja']) && ($_SESSION['cargo']==("Cajero"||"Administrador") || $_SESSION['tipo']=="Empresario")){
      require_once "menu.php";
      require_once "../clases/Gonexion.php";

      $c = new conectar();
      $conexion = $c->conexion();

      $idCaja = $_SESSION['caja'];
      $total = 0;

      $sqlCuenta = "SELECT mov.movimiento_id,
                           mov.movimiento_dinero,
                           mov.movimiento_fecha,
                           per.persona_nombre
                      from movimiento as mov
                inner join persona as per
                        on mov.movimiento_persona = per.persona_id
                     where mov.movimiento_nombre = 'VentaHoy'
                       and mov.movimiento_caja = '$idCaja'
                  order by mov.movimiento_id asc";
      $queryCuenta = mysqli_query($conexion, $sqlCuenta);
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
   <meta charset="utf-8">
   <title></title>
   <script src="../librerias/printThis.js"></script>
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
         left: 50%;
         transform: translate(-50%, -50%);
      }
   </style>
</head>
<body>
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-5" id="cargaTablaPreparados"></div>
         <div class="col-sm-7" id="cargaTablaCuenta" style="text-align: right">
            <table class="table table-bordered table-hover table-condensed">
               <tr>
                  <td><b>FECHA</b></td>
                  <td><b>HORA</b></td>
                  <td><b>MOSO</b></td>
                  <td><b>IMPORTE</b></td>
                  <td><b>V</b></td>
               </tr>
               <?php while ($verCuenta = mysqli_fetch_row($queryCuenta)): ?>
                  <tr>
                     <?php $fh = explode(" ",$verCuenta[2]); ?>
                     <td><?php echo $fh[0]; ?></td>
                     <td><?php echo $fh[1]; ?></td>
                     <td><?php echo $verCuenta[3]; ?></td>
                     <td><?php echo $verCuenta[1]; ?></td>
                     <td></td>
                     <?php $total = $total + $verCuenta[1]; ?>
                  </tr>
               <?php endwhile; ?>
               <tr>
                  <td colspan="3" style="text-align: right">TOTAL</td>
                  <td><?php echo 'S/ '.$total; ?></td>
               </tr>
            </table>
            <button type="button" class="btn btn-success" name="imprimirCaja" id="imprimirCaja">Imprimir Caja</button>
         </div>
         <div hidden>
            <div id="cargaImpCaja" class="formatoCaja"></div>
         </div>
         <div hidden>
            <div id="cargaImpCuenta" class="formatoCuenta"></div>
         </div>

      </div>
   </div>
</body>
</html>

<script type="text/javascript">
   $(document).ready(function(){
      $('#cargaTablaPreparados').load('tablas/tablaPreparados.php');
      $('#cargaImpCaja').load('imprimir/impcaja.php');
   });

   $('#imprimirCaja').click(function(){
      $(".formatoCaja").printThis();
   });
</script>

<script type="text/javascript">
   function cuenta(mesa){
      $('#cargaTablaCuenta').load('tablas/tablaCuentas.php?mesa='+mesa);
      $('#cargaImpCuenta').load('imprimir/impcuenta.php?mesa='+mesa);
   };

   function imprimirCuenta(){
      $(".formatoCuenta").printThis();
   };

   function cobrarMesa(mesa){
      $.ajax({
         type:"POST",
         data:"idMesa="+mesa,
         url:"../procesos/gestion/mesaCobrada.php",
         success:function(r){
            if(r>0){
               window.location="caja.php";
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
