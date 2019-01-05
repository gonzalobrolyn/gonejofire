
<?php
   session_start();
   require_once "../../clases/Gonexion.php";
   $c = new conectar();
   $conexion = $c->conexion();

   $idCaja = $_SESSION['caja'];

   $sqlGrupo = "SELECT grupo_id,
                       grupo_nombre
                  from grupo
                 where grupo_caja = '$idCaja'";
   $queryGrupo = mysqli_query($conexion, $sqlGrupo);
?>

<div class="container-fluid">
   <div class="row">
      <?php while ($verGrupo = mysqli_fetch_row($queryGrupo)): ?>
         <span class="btn btn-info form-control" onclick="verLista('<?php echo $verGrupo[0]; ?>','<?php echo $verGrupo[1]; ?>')">
            <?php echo $verGrupo[1]; ?>
         </span><p></p>
      <?php endwhile; ?>
   </div>
</div>
