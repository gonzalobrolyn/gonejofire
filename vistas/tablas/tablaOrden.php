
<?php
   session_start();
   require_once "../../clases/Gonexion.php";
   $c = new conectar();
   $conexion = $c->conexion();

   $idCaja = $_SESSION['caja'];
   $numMesa = $_GET['mesa'];
   $total = 0;

   $sqlOrden = "SELECT ord.orden_id,
                       pro.producto_nombre,
                       ord.orden_cantidad,
                       ord.orden_precioventa,
                       ord.orden_estado
                  from orden as ord
            inner join producto as pro
                    on ord.orden_producto = pro.producto_id
                 where ord.orden_mesa = '$numMesa'
                   and ord.orden_estado <> 'Pagado'
                   and ord.orden_caja = '$idCaja'
              order by ord.orden_id asc";
   $queryOrden = mysqli_query($conexion, $sqlOrden);
?>

<table class="table table-bordered table-hover">
   <tr style="text-align: center">
      <td colspan="5">
         <b><?php echo 'MESA '.$numMesa; ?></b>
      </td>
   </tr>
   <tr>
      <td><b>PEDIDO</b></td>
      <td><b>CANTIDAD</b></td>
      <td><b>PRECIO</b></td>
      <td><b>IMPORTE</b></td>
      <td><b>ESTADO</b></td>
   </tr>
   <?php while ($verOrden = mysqli_fetch_row($queryOrden)):
      $importe = $verOrden[2]*$verOrden[3];
   ?>
      <tr>
         <td><?php echo $verOrden[1]; ?></td>
         <td><?php echo $verOrden[2]; ?></td>
         <td><?php echo $verOrden[3]; ?></td>
         <td><?php echo $importe.'.00'; ?></td>
         <td>
            <?php switch ($verOrden[4]) {
               case 'Registrado': ?>
               <span class="btn btn-success btn-sm">
                  <?php echo $verOrden[4]; ?>
               </span>
               <?php
                  break;
               case 'Preparado': ?>
               <span class="btn btn-warning btn-sm" onclick="entregaOrden('<?php echo $verOrden[0]; ?>')">
                  <?php echo $verOrden[4]; ?>
               </span>
               <?php
                  break;
               case 'Entregado': ?>
               <span class="btn btn-danger btn-sm">
                  <?php echo $verOrden[4]; ?>
               </span>
               <?php
                  break;
            } ?>

         </td>
      </tr>
      <?php $total = $total + $importe; ?>
   <?php endwhile; ?>
   <tr>
      <td colspan="3" style="text-align: right ">TOTAL</td>
      <td><?php echo 'S/ '.$total.'.00'; ?></td>
   </tr>
</table>
