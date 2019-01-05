
<?php
   session_start();
   require_once "../../clases/Gonexion.php";
   $c = new conectar();
   $conexion = $c->conexion();

   $idCaja = $_SESSION['caja'];

   $sqlPedido = "SELECT ord.orden_id,
                        pro.producto_nombre,
                        pro.producto_resumen,
                        ord.orden_cantidad,
                        ord.orden_estado
                   from orden as ord
             inner join producto as pro
                     on ord.orden_producto = pro.producto_id
                  where ord.orden_estado = 'Registrado'
                    and ord.orden_caja = '$idCaja'
               order by ord.orden_id asc";
   $queryPedido = mysqli_query($conexion, $sqlPedido);
?>

<div class="container-fluid">
   <div class="row">
      <table class="table table-hover table-condensed table-bordered">
         <tr>
            <td><b>V</b></td>
            <td><b>PRODUCTO</b></td>
            <td><b>RESUMEN</b></td>
            <td style="text-align: center"><b>CANTIDAD</b></td>
            <td style="text-align: center"><b>ESTADO</b></td>
         </tr>
         <?php while ($verPedido = mysqli_fetch_row($queryPedido)): ?>
            <tr>
               <td></td>
               <td><h4><?php echo $verPedido[1]; ?></h4></td>
               <td><h4><?php echo $verPedido[2]; ?></h4></td>
               <td style="text-align: center"><h4><?php echo $verPedido[3]; ?></h4></td>
               <td style="text-align: center">
                  <span class="btn btn-danger" onclick="preparado('<?php echo $verPedido[0] ?>')">
                     PREPARADO
                  </span>
               </td>
            </tr>
         <?php endwhile; ?>
      </table>

   </div>
</div>
