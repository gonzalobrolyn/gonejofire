
<?php 
  session_start();
  require_once "../../clases/Insumos.php";
  
  $obj = new insumos();

  $idInsumo = $_POST['idInsumo'];

    echo $obj -> eliminaInsumo($idInsumo);
?>