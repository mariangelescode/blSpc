<?php 
abstract class DBAbstractModel{
	private static $db_host = 'localhost';
	private static $db_user = 'u460553087_bienestarLabor';
	private static $db_pass = 'B13n3st_r';

	protected $db_name = 'u460553087_bL';
	protected $query;
	protected $row = array();

	private $conn;
	public $mensaje = 'Hecho';

	# Métodos abstractos para ABM de clases que hereden
	// abstract protected function get();
	// abstract protected function set();
	// abstract protected function edit();
	// abstract protected function delete();

	# Los siguientes métodos pueden definirse con exactitud 
	# y no son abstractos

	# Conectar a la base de datos
	private function open_connection(){
		//$this->conn = new mysqli(self::$this->db_host, self::$this->db_user, self::$this->db_pass, self::$this->db_name);
		$this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);

		if (mysqli_connect_errno()) {
			# Si existe error en la conexion
			die('Error al conectar Mysql'.mysqli_connect_errno().'---'.mysqli_connect_error());
		}
		# Se establece la codificacion que permite el uso de ñ y tìldes
		$this->conn->set_charset('utf8');
		$this->conn->query("SET lc_time_names = 'es_MX'");
	}

	# Desconectar la base de datos
	private function close_connection(){
		$this->conn->close();
	}

	# Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
	protected function execute_single_query(){
		$this->open_connection();
		$result = $this->conn->query($this->query);
		
		if($result){
			// $this->conn->query($this->query);
			$this->close_connection();
			$this->success = true;
			$this->mensaje = 'ok';
		}else{
			// var_dump('no');
			$this->close_connection();
			$this->success = false;
			$this->mensaje = 'Metodo no permitido';
		}

	}

	protected function multi_query($query){
			$this->open_connection();
			$result = $this->conn->multi_query($query);
			if($result){
				// $this->conn->multi_query($this->query);
				$this->close_connection();
				$this->success = true;
				$this->mensaje = 'ok';
			}else{
				// var_dump('no');
				$this->close_connection();
				$this->success = false;
				$this->mensaje = 'Metodo no permitido';
			}
	}


	# Traer resultados de una consulta en un Array
	protected function get_results_from_query(){
		$this->open_connection();

		$result = $this->conn->query($this->query);

		while ($this->rows[] = $result->fetch_assoc());

		$result->close();

		$this->close_connection();

		array_pop($this->rows);
	}
}
 ?>