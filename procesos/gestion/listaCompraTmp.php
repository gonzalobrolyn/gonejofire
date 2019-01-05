
<?php
session_start();

   $idInsumo = $_POST['idInsumo'];
   $codigo = $_POST['codInsumo'];
   $nombre = $_POST['nombreInsumo'];
   $cantidad = $_POST['cantidad'];
   $precio = $_POST['precio'];

   $item = $idInsumo."||".
           $codigo."||".
           $nombre."||".
           $cantidad."||".
           $precio;

   $_SESSION['listaCompraTmp'][] = $item;
?>
