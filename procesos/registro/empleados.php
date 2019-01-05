<?php
   session_start();
   require_once "../../clases/Empleados.php";

   $objEmpleado = new empleados();

   $idEmpresa = $_SESSION['empresa'];

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);

   $datosEmpleado = array(
      $_POST['dni'],
      $_POST['nombre'],
      $_POST['apellido'],
      $_POST['celular'],
      $_POST['usuario'],
      $_POST['clave'],
      $idEmpresa,
      $_POST['cargo'],
      $_POST['sueldo'],
      $_POST['diaPago'],
      $fechaHora,
      $_POST['idCaja']);

   echo $objEmpleado->agragaEmpleado($datosEmpleado);

?>
