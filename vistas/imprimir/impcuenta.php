
<?php
   session_start();
   require_once "../../clases/Gonexion.php";

   $c = new conectar();
   $conexion = $c->conexion();

   $idCaja = $_SESSION['caja'];
   $numMesa = $_GET['mesa'];
   $total = 0;

   $sqlPrepa = "SELECT ord.orden_id,
                       pro.producto_nombre,
                       ord.orden_cantidad,
                       ord.orden_precioventa
                  from orden as ord
            inner join producto as pro
                    on ord.orden_producto = pro.producto_id
                 where ord.orden_mesa = '$numMesa'
                   and ord.orden_caja = '$idCaja'
                   and (ord.orden_estado = 'Preparado')
              order by ord.orden_id asc";
   $queryPrepa = mysqli_query($conexion, $sqlPrepa);

   $sqlEntre = "SELECT ord.orden_id,
                       pro.producto_nombre,
                       ord.orden_cantidad,
                       ord.orden_precioventa
                  from orden as ord
            inner join producto as pro
                    on ord.orden_producto = pro.producto_id
                 where ord.orden_mesa = '$numMesa'
                   and ord.orden_caja = '$idCaja'
                   and (ord.orden_estado = 'Entregado')
              order by ord.orden_id asc";
   $queryEntre = mysqli_query($conexion, $sqlEntre);
?>


<div>
   <h3>La Catedral</h3>
   <table class="table table-bordered table-hover">
      <tr style="text-align: center">
         <td colspan="5">
            <b><?php echo 'MESA '.$numMesa; ?></b>
         </td>
      </tr>
      <tr>
         <td><b>CAN.</b></td>
         <td><b>PEDIDO</b></td>
         <td><b>PRECIO</b></td>
         <td><b>IMPORTE</b></td>
      </tr>
      <?php while ($verPrepa = mysqli_fetch_row($queryPrepa)):
         $importe = $verPrepa[2]*$verPrepa[3];
      ?>
         <tr>
            <td><?php echo $verPrepa[2]; ?></td>
            <td><?php echo $verPrepa[1]; ?></td>
            <td style="text-align: right"><?php echo $verPrepa[3]; ?></td>
            <td style="text-align: right"><?php echo $importe.'.00'; ?></td>
         </tr>
         <?php $total = $total + $importe; ?>
      <?php endwhile; ?>
      <?php while ($verEntre = mysqli_fetch_row($queryEntre)):
         $importe = $verEntre[2]*$verEntre[3];
      ?>
         <tr>
            <td><?php echo $verEntre[2]; ?></td>
            <td><?php echo $verEntre[1]; ?></td>
            <td style="text-align: right"><?php echo $verEntre[3]; ?></td>
            <td style="text-align: right"><?php echo $importe.'.00'; ?></td>
         </tr>
         <?php $total = $total + $importe; ?>
      <?php endwhile; ?>
      <tr>
         <td colspan="3" style="text-align: right ">TOTAL</td>
         <td style="text-align: right"><?php echo 'S/ '.$total.'.00'; ?></td>
      </tr>
   </table>
</div>
