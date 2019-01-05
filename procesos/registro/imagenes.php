
<?php
   session_start();
   require_once "../../clases/Imagenes.php";
   require_once "../../clases/Productos.php";

   $objImagen = new imagenes();
   $objProducto = new productos();

   $fechaMundial = time('Y-m-d H:i:s');
   $fechaLocal = $fechaMundial - (7*60*60);
   $fechaHora = date("Y-m-d H:i:s", $fechaLocal);
   $idPersona = $_SESSION['persona'];

   $archivo = $_FILES['foto']['name'];
   $rutaAlma = $_FILES['foto']['tmp_name'];
   $carpeta = '../../imgproduc/';
   $rutaFinal = $carpeta.$archivo;

   $idProducto = $_POST['idProducto'];

   $datosImg = array(
      $rutaFinal,
      $fechaHora,
      $idPersona);
   if (move_uploaded_file($rutaAlma, $rutaFinal)) {
      $idImagen = $objImagen->guardaImagen($datosImg);
      if ($idImagen > 0) {
         $datosProd = array(
            $idImagen,
            $idProducto);
         echo $objProducto->editaImgProd($datosProd);
      } else {
         echo 0;
      }
   } else {
      echo 0;
   }
?>
