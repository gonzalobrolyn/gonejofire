
<?php session_start(); ?>
<div class="container-fluid">
   <div class="row">
      <h3>LISTA DE COMPRA</h3>
      <table class="table table-bordered table-hover table-condensed" style="text-align: center">
         <tr>
            <td><b>CODIGO</b></td>
            <td><b>NOMBRE DE INSUMO</b></td>
            <td><b>CANT.</b></td>
            <td><b>P.U.</b></td>
            <td><b>IMPORTE</b></td>
            <td><b>QUITAR</b></td>
         </tr>
         <?php
         $total = 0;
         if (isset($_SESSION['listaCompraTmp'])):
            $i = 0;
            foreach (@$_SESSION['listaCompraTmp'] as $key):
               $d = explode("||", @$key);
         ?>
               <tr>
                  <td><?php echo $d[1]; ?></td>
                  <td><?php echo $d[2]; ?></td>
                  <td><?php echo $d[3]; ?></td>
                  <td><?php echo $d[4]; ?></td>
                  <td><?php echo $d[3]*$d[4]; ?></td>
                  <td>
                     <span class="btn btn-danger btn-xs" onclick="quitarProducto('<?php echo $i; ?>')">
                        <span class="glyphicon glyphicon-remove"></span>
                     </span>
                  </td>
               </tr>
         <?php
               $total = $total + $d[3] * $d[4];
               $i++;
            endforeach;
         endif;
         ?>
         <tr>
            <td colspan="4" style="text-align: right"><b>TOTAL</b></td>
            <td colspan="1"><?php echo "S/ ".$total; ?></td>
         </tr>
      </table>
      <P style="text-align: right">
         <?php if ($total > 0): ?>
            <span class="btn btn-success" onclick="compra('<?php echo $total; ?>')"> Generar Compra
               <span class="glyphicon glyphicon-usd"></span>
            </span>
            <span class="btn btn-danger" onclick="vaciarLista()"> Vaciar Lista
               <span class="glyphicon glyphicon-trash"></span>
            </span>
         <?php endif; ?>
      </P>
   </div>
</div>
