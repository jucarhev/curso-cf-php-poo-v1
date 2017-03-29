<?php namespace Models;
	
	class Session{

		private $id;
		private $email;
		private $password;
		private $con;
		
		public function __construct(){
			$this->con = new Conexion();
		}

		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}

		public function get($atributo){
			return $this->$atributo;
		}

		public function auth(){
			$sql = "SELECT * FROM user WHERE email = '{$this->email}' and password = '{$this->password}' LIMIT 0,1";
			$datos = $this->con->consultaRetorno($sql);
			if ($datos == null) {
				return False;	
			}else{
				$row = mysqli_fetch_assoc($datos);
				return $row;
			}
		}

		public function add(){
			$sql = "INSERT INTO user (id, email,password) VALUES (null, '{$this->email}','{$this->password}')";
			$this->con->consultaSimple($sql);
		}

		public function delete(){
			$sql = "DELETE FROM user WHERE id = '{$this->id}'";
			$this->con->consultaRetorno($sql);
		}

		public function edit(){
			$sql = "UPDATE user SET password = '{$this->password}' WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
		}

		public function view(){
			$sql = "SELECT * FROM user WHERE id = '{$this->id}'";
			$datos = $this->con->consultaRetorno($sql);
			$row = mysqli_fetch_assoc($datos);
			return $row;
		}
	}
?>