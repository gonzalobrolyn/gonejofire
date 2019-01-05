
<?php
   session_start();
   require_once "../../clases/Gonexion.php";
   $c = new conectar();
   $conexion = $c->conexion();

   $idCaja = $_SESSION['caja'];

   $sqlProducto = "SELECT pro.producto_id,
                          pro.producto_codigo,
                          car.carta_nombre,
                          gru.grupo_nombre,
                          pro.producto_nombre,
                          pro.producto_precio
                     from producto as pro
               inner join carta as car
                       on pro.producto_carta = car.carta_id
               inner join grupo as gru
                       on pro.producto_grupo = gru.grupo_id
                    where pro.producto_caja = '$idCaja'
                 order by gru.grupo_nombre";
   $queryProducto = mysqli_query($conexion, $sqlProducto);
?>

<div class="container-fluid">
   <div class="row">
      <table class="table table-hover table-condensed table-bordered" style="text-align: center">
         <tr>
            <td><b>CODIGO</b></td>
            <td><b>CARTA</b></td>
            <td><b>GRUPO</b></td>
            <td><b>NOMBRE DE PRODUCTO</b></td>
            <td><b>PRECIO</b></td>
            <td><b>VER</b></td>
         </tr>
         <?php while ($verProd = mysqli_fetch_row($queryProducto)): ?>
            <tr>
               <td><?php echo $verProd[1]; ?></td>
               <td><?php echo $verProd[2]; ?></td>
               <td><?php echo $verProd[3]; ?></td>
               <td><?php echo $verProd[4]; ?></td>
               <td><?php echo $verProd[5]; ?></td>
               <td>
                  <a href="producto.php?idProducto=<?php echo $verProd[0]; ?>" class="btn btn-sm btn-success">
                     <span class="glyphicon glyphicon-eye-open"></span>
                  </a>
               </td>
            </tr>
         <?php endwhile; ?>
      </table>
   </div>
</div>
