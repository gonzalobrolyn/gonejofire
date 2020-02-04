
<?php
  require_once "../../clases/Insumos.php";

  $obj = new insumos();

  echo json_encode($obj->muestraDatosInsumo($_POST['idInsumoEditar']));
?>