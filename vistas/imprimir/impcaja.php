
<?php
   session_start();
   require_once "../../clases/Gonexion.php";

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
                  where mov.movimiento_nombre = 'Cuenta'
                    and mov.movimiento_caja = '$idCaja'
               order by mov.movimiento_id asc";
   $queryCuenta = mysqli_query($conexion, $sqlCuenta);
?>

<div>
   <h3 style="text-align: center">La Catedral</h3>
   <table class="table table-bordered table-hover table-condensed">
      <tr>
         <td><b>FECHA</b></td>
         <td><b>HORA</b></td>
         <td><b>MOSO</b></td>
         <td><b>IMPORTE</b></td>
      </tr>
      <?php while ($impCuenta = mysqli_fetch_row($queryCuenta)): ?>
         <tr>
            <?php $fh = explode(" ",$impCuenta[2]); ?>
            <td><?php echo $fh[0]; ?></td>
            <td><?php echo $fh[1]; ?></td>
            <td><?php echo $impCuenta[3]; ?></td>
            <td><?php echo $impCuenta[1]; ?></td>
            <?php $total = $total + $impCuenta[1]; ?>
         </tr>
      <?php endwhile; ?>
      <tr>
         <td colspan="3" style="text-align: right">TOTAL</td>
         <td><?php echo 'S/ '.$total; ?></td>
      </tr>
   </table>
</div>
