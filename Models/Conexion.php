<?php namespace Models;

	class Conexion{

		private $datos = array(
			"host" => "localhost",
			"user" => "root",
			"pass" => "lenov35",
			"db" => "proyecto"
		);
		private $con;

		public function __construct(){
			$this->con = new \mysqli($this->datos['host'], 
				$this->datos['user'], $this->datos['pass'],
				$this->datos['db']);
			$this->con->set_charset('utf8');
		}

		public function consultaSimple($sql){
			$this->con->query($sql);
		}

		public function consultaRetorno($sql){
			$datos = $this->con->query($sql);
			return $datos;
		}

		public function count($sql){
			$res=$this->con->query($sql);
			$total=$res->num_rows;
			return $total;
		}
	}

?>
