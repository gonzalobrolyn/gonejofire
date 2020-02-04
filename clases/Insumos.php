
<?php
   require_once "Gonexion.php";

   class insumos{

      public function guardaInsumo($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlInsumo = "INSERT into insumo (
                                   insumo_codigo,
                                   insumo_nombre,
                                   insumo_marca,
                                   insumo_familia,
                                   insumo_fecha,
                                   insumo_persona)
                           values ('$datos[0]',
                                   '$datos[1]',
                                   '$datos[2]',
                                   '$datos[3]',
                                   '$datos[4]',
                                   '$datos[5]')";
         return mysqli_query($conexion, $sqlInsumo);
      }

      public function editaInsumo($datos){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlEditaInsumo = "UPDATE insumo
                               set insumo_codigo = '$datos[1]',
                                   insumo_nombre = '$datos[2]',
                                   insumo_fecha = '$datos[3]',
                                   insumo_persona = '$datos[4]'
                             where insumo_id = '$datos[0]'";
         return mysqli_query($conexion, $sqlEditaInsumo);
      }

      public function muestraDatosInsumo($dato){
         $c = new conectar();
         $conexion = $c->conexion();

         $sqlMuestraDatos = "SELECT ins.insumo_codigo,
                                    ins.insumo_nombre,
                                    mar.marca_nombre,
                                    fam.familia_nombre
                               from insumo as ins
                         inner join marca as mar
                                 on ins.insumo_marca = mar.marca_id
                         inner join familia as fam
                                 on ins.insumo_familia = fam.familia_id
                              where ins.insumo_id = '$dato'";
         $queryMuestraDatos = mysqli_query($conexion, $sqlMuestraDatos);
         $muestraDatos = mysqli_fetch_row($queryMuestraDatos);
         $data = array(
            'codigoInsumo' => $muestraDatos[0],
            'nombreInsumo' => $muestraDatos[1],
            'marcaInsumo' => $muestraDatos[2],
            'familiaInsumo' => $muestraDatos[3]);
         return $data;
      }

      public function eliminaInsumo($idInsumo){
			$c = new conectar();
			$conexion = $c->conexion();

			$sql = "DELETE from insumo
					      where insumo_id='$idInsumo'";
			return mysqli_query($conexion,$sql);
		}
   }

?>
