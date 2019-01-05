
<?php require_once "dependencias.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>

   <meta name="description" content="GonejoFire">
   <meta name="author" content="Gonzalo Brolyn">
   <title>GonejoFire</title>
   <link rel="icon" type="image/png" href="../imagenes/favicon.png" />

</head>

<body >
   <nav class="navbar navbar-fixed-top navbar-inverse" data-spy="affix" id="barra-nav" role="navigation">
      <div class="container-fluid">
         <div class="nav navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">MENU</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="inicio.php">
               <span class="btn btn-primary btn-lg">
                  <span class="glyphicon glyphicon-fire" style="color: #22d0ff"></span> GonejoFire
               </span>
            </a>
         </div>
         <div id="main-nav" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
               <li>
                  <a href="empresa.php">
                     <span class="glyphicon glyphicon-tasks"></span>
                     EMPRESA
                  </a>
               </li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                     <span class="glyphicon glyphicon-edit"></span>
                     GESTION
                     <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                     <li><a href="insumos.php">Insumos</a></li>
                     <li><a href="almacen.php">Almacen</a></li>
                     <li><a href="productos.php">Productos</a></li>
                     <li><a href="reportes.php">Reportes</a></li>
                  </ul>
               </li>
               <li>
                  <a href="barra.php">
                     <span class="glyphicon glyphicon-th-list"></span>
                     BARRA
                  </a>
               </li><li>
                  <a href="caja.php">
                     <span class="glyphicon glyphicon-usd"></span>
                     CAJA
                  </a>
               </li>
               <li>
                  <a href="mesas.php">
                     <span class="glyphicon glyphicon-th"></span>
                     MESAS
                  </a>
               </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li>
                  <a href="#" class="navbar-brand">
                     <p>
                     <img src="../imagenes/tufoto.png" alt="foto" class="img-rounded" height="23" width="23">
                     <?php echo $_SESSION['usuario']; ?>
                     </p>
                  </a>
               </li>
               <li>
                  <a href="../procesos/salir.php" style="color: red">
                     <span class="glyphicon glyphicon-off"></span>
                     Cerrar Sesión
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </nav>

</body>
</html>
