
<?php
   session_start();
   require_once "../../clases/Gonexion.php";
   $c = new conectar();
   $conexion = $c->conexion();

   $idGrupo = $_GET['idGrupo'];
   $nombreGrupo = $_GET['nombre'];
   $idCaja = $_SESSION['caja'];

   $sqlProducto = "SELECT pro.producto_id,
                          pro.producto_nombre,
                          pro.producto_resumen,
                          ima.imagen_ruta,
                          pro.producto_precio
                     from producto as pro
                left join imagen as ima
                       on pro.producto_imagen = ima.imagen_id
                    where pro.producto_grupo = '$idGrupo'
                      and pro.producto_caja = '$idCaja'";
   $queryProducto = mysqli_query($conexion, $sqlProducto);
?>

<div class="container-fluid">
   <div class="row">
<table class="table table-hover table-condensed">
   <tr style="text-align: center">
      <td colspan="2">
         <h4><b><?php echo $nombreGrupo; ?></b></h4>
      </td>
   </tr>
   <?php while ($verProd = mysqli_fetch_row($queryProducto)): ?>

      <tr>
         <td>
            <h4><?php echo $verProd[1]; ?></h4>
            <h6><?php echo $verProd[2]; ?></h6>
         </td>
         <td style="text-align: right">
            <span class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalNuevaOrden" onclick="agregaDato('<?php echo $verProd[0]; ?>','<?php echo $verProd[1]; ?>','<?php echo $verProd[4]; ?>')">
               <h4><?php echo 'S/ '.$verProd[4]; ?></h4>
            </span>
         </td>
      </tr>

      <?php endwhile; ?>
      </table>
   </div>
</div>
