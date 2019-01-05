<?php
   session_start();
   if (isset($_SESSION['usuario']) && $_SESSION['tipo']=='Empleado') {
      switch ($_SESSION['cargo']) {
         case 'Administrador':
            header('Location: almacen.php');
            exit();
         case 'Cajero':
            header('Location: caja.php');
            exit();
         case 'Barman-Cheff':
            header('Location: barra.php');
            exit();
         case 'Mesero':
            header('Location: mesas.php');
            exit();
         default:
            header("location:../index.php");
            exit();
      }
   } elseif (isset($_SESSION['usuario']) && $_SESSION['tipo']=='Empresario') {
      header("location: empresa.php");
   } else {
      header("location:../index.php");
   }
?>
