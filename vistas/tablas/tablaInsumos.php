
<?php
   require_once "../../clases/Gonexion.php";
   $c = new conectar();
   $conexion = $c->conexion();

   $sqlInsumo = "SELECT ins.insumo_id,
                        ins.insumo_codigo,
                        ins.insumo_nombre,
                        fam.familia_nombre,
                        mar.marca_nombre
                   from insumo as ins
             inner join familia as fam
                     on ins.insumo_familia = fam.familia_id
             inner join marca as mar
                     on ins.insumo_marca = mar.marca_id";
   $queryInsumo = mysqli_query($conexion, $sqlInsumo);

?>

<div class="container-fluid">
   <div class="row">
      <table class="table table-hover table-condensed table-bordered" style="text-align: center">
         <tr>
            <td><b>CODIGO</b></td>
            <td><b>FAMILIA</b></td>
            <td><b>MARCA</b></td>
            <td><b>NOMBRE DE INSUMO</b></td>
            <td><b>ACCIONES</b></td>
         </tr>
         <?php while ($verInsumo = mysqli_fetch_row($queryInsumo)): ?>
            <tr>
               <td><?php echo $verInsumo[1]; ?></td>
               <td><?php echo $verInsumo[3]; ?></td>
               <td><?php echo $verInsumo[4]; ?></td>
               <td><?php echo $verInsumo[2]; ?></td>
               <td>
                  <p>
                     <span class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalCarrtitoCompra" onclick="agregaDato('<?php echo $verInsumo[0]; ?>','<?php echo $verInsumo[1]; ?>','<?php echo $verInsumo[2]; ?>')">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                     </span>
                     <span class="btn btn-sm btn-success">
                        <span class="glyphicon glyphicon-eye-open"></span>
                     </span>
                     <span class="btn btn-sm btn-warning">
                        <span class="glyphicon glyphicon-pencil"></span>
                     </span>
                     <span class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                     </span>
                  </p>
               </td>
            </tr>
         <?php endwhile; ?>
      </table>
   </div>
</div>
