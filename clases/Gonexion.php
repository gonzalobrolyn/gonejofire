
<?php
	class conectar{
		private $servidor="localhost";
		private $usuario="super";
		private $password="gonza";
		private $bd="gonejofire";

		public function conexion(){
			$conexion = mysqli_connect($this->servidor,
									         $this->usuario,
									         $this->password,
									         $this->bd);
			return $conexion;
		}
	}
?>
