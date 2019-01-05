
<?php
   session_start();
   require_once "../../clases/Imagenes.php";
   require_once "../../clases/Empresas.php";

   $objImg = new imagenes();
   $objEmp = new empresas();

   $idPersona = $_SESSION['persona'];
   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);

   $archivo = $_FILES['logo']['name'];
   $rutaAlma = $_FILES['logo']['tmp_name'];
   $carpeta = '../../imagenes/';
   $rutaFinal = $carpeta.$archivo;

   $datosImg = array(
      $rutaFinal,
      $fechaHora,
      $idPersona);
   if (move_uploaded_file($rutaAlma, $rutaFinal)) {
      $idImagen = $objImg->guardaImagen($datosImg);
      if ($idImagen > 0) {
         $datosEmp = array(
            $_POST['ruc'],
            $_POST['razon'],
            $_POST['direccion'],
            $idImagen,
            $fechaHora,
            $idPersona);
         echo $objEmp->guardaEmpresa($datosEmp);
      } else {
         echo 0;
      }
   } else {
      echo 0;
   }

?>
