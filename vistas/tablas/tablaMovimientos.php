
<?php
   session_start();
   require_once "../../clases/Gonexion.php";
   $c = new conectar();
   $conexion = $c->conexion();

   $idCaja = $_SESSION['caja'];

   $sqlMovi = "SELECT mov.movimiento_fecha,
                      per.persona_nombre,
                      per.persona_apellido,
                      mov.movimiento_nombre,
                      mov.movimiento_monto,
                      mov.movimiento_dinero,
                      mov.movimiento_efectivo
                 from movimiento as mov
           inner join persona as per
                   on mov.movimiento_persona = per.persona_id
                where mov.movimiento_caja = '$idCaja'
             order by mov.movimiento_id desc ";
   $queryMovi = mysqli_query($conexion, $sqlMovi);

?>

<div class="container-fluid">
   <div class="row">
      <table class="table table-hover table-condensed table-bordered" style="text-align: center">
         <tr>
            <td><b>FECHA</b></td>
            <td><b>HORA</b></td>
            <td><b>PERSONA</b></td>
            <td><b>CONCEPTO</b></td>
            <td><b>INGRESO</b></td>
            <td><b>EGRESO</b></td>
            <td><b>EFECTIVO</b></td>
         </tr>
         <?php while ($verMovi = mysqli_fetch_row($queryMovi)): ?>
            <tr>
               <?php
                  $fyh = explode(" ",$verMovi[0]);
               ?>
               <td><?php echo $fyh[0]; ?></td>
               <td><?php echo $fyh[1]; ?></td>
               <td><?php echo $verMovi[1]." ".$verMovi[2]; ?></td>
               <td><?php echo $verMovi[3]; ?></td>
               <?php if ($verMovi[4]<$verMovi[6]): ?>
                  <td><?php echo $verMovi[5]; ?></td>
                  <td></td>
               <?php else: ?>
                  <td></td>
                  <td><?php echo $verMovi[5]; ?></td>
               <?php endif; ?>
               <td><?php echo $verMovi[6]; ?></td>
            </tr>
         <?php endwhile; ?>
      </table>
   </div>
</div>
