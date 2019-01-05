
<?php
   session_start();
   require_once "../../clases/Gonexion.php";

   $c = new conectar();
   $conexion = $c->conexion();

   $idCaja = $_SESSION['caja'];

   for ($num=1; $num<20; $num++):

      $sqlPrepa = "SELECT *
                      from orden
                     where orden_caja = '$idCaja'
                       and orden_mesa = '$num'
                       and orden_estado = 'Preparado'";
      $queryPrepa = mysqli_query($conexion, $sqlPrepa);
      $resultPrepa = mysqli_num_rows($queryPrepa);

      $sqlEntre = "SELECT *
                      from orden
                     where orden_caja = '$idCaja'
                       and orden_mesa = '$num'
                       and orden_estado = 'Entregado'";
      $queryEntre = mysqli_query($conexion, $sqlEntre);
      $resultEntre = mysqli_num_rows($queryEntre);

      if (($resultPrepa || $resultEntre) > 0):
?>
         <div class="col-xs-4">
            <div class="contenedor">
               <img src="../imagenes/acero2.jpg" class="img-rounded" alt="mesa"/>
               <div class="centrado">
                  <span class="btn" onclick="cuenta('<?php echo $num; ?>')">
                     <h2>
                        <b><?php echo 'Mesa '.$num; ?></b>
                     </h2>
                  </span>
               </div>
            </div><p></p>
         </div>
<?php
      endif;
   endfor;
?>
