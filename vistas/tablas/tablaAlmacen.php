
<?php
   session_start();
   require_once "../../clases/Gonexion.php";
   $c = new conectar();
   $conexion = $c->conexion();

   $idCaja = $_SESSION['caja'];

   $sqlStok = "SELECT alm.almacen_id,
                      ins.insumo_codigo,
                      fam.familia_nombre,
                      mar.marca_nombre,
                      ins.insumo_nombre,
                      alm.almacen_precio,
                      uni.unidad_medida,
                      und.unidad_medida,
                      alm.almacen_cantidad,
                      alm.almacen_minimo,
                      alm.almacen_actual,
                      alm.almacen_control
                 from almacen as alm
           inner join insumo as ins
                   on alm.almacen_insumo = ins.insumo_id
           inner join familia as fam
                   on ins.insumo_familia = fam.familia_id
           inner join marca as mar
                   on ins.insumo_marca = mar.marca_id
           left join unidad as uni
                   on alm.almacen_unidad = uni.unidad_id
           left join unidad as und
                   on alm.almacen_medida = und.unidad_id
                where alm.almacen_caja = '$idCaja'
             order by fam.familia_nombre";
   $queryStok = mysqli_query($conexion, $sqlStok);
?>

<div class="container-fluid">
   <div class="row">
      <table class="table table-hover table-condensed table-bordered" style="text-align: center">
         <tr>
            <td><b>CODIGO</b></td>
            <td><b>FAMILIA</b></td>
            <td><b>MARCA</b></td>
            <td><b>NOMBRE DE INSUMO</b></td>
            <td><b>CANTIDAD ACTUAL</b></td>
            <td><b>CANTIDAD MINIMA</b></td>
            <td><b>PRECIO POR UNIDAD</b></td>
            <td><b>CONTROL POR UNIDAD</b></td>
            <td><b>CONTROL ACTUAL</b></td>
            <td><b>+ INFO</b></td>
         </tr>
         <?php while ($verStok = mysqli_fetch_row($queryStok)): ?>

            <tr>
               <td><?php echo $verStok[1]; ?></td>
               <td><?php echo $verStok[2]; ?></td>
               <td><?php echo $verStok[3]; ?></td>
               <td><?php echo $verStok[4]; ?></td>
               <td><?php echo $verStok[10]." ".$verStok[6]; ?></td>
               <td><?php echo $verStok[9]." ".$verStok[6]; ?></td>
               <td><?php echo $verStok[5]; ?></td>
               <td><?php echo $verStok[8]." ".$verStok[7]; ?></td>
               <td><?php echo $verStok[11]." ".$verStok[7]; ?></td>
               <td>
                  <span class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalCompletarInfo" onclick="agregaDato('<?php echo $verStok[0]; ?>','<?php echo $verStok[10]; ?>')">
                     <span class="glyphicon glyphicon-pencil"></span>
                  </span>
               </td>
            </tr>
         <?php endwhile; ?>
      </table>
   </div>
</div>
