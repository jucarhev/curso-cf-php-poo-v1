<?php namespace Models;


	use Helpers\Pagination as Pagination;

	class Estudiante{

		private $id;
		private $nombre;
		private $edad;
		private $promedio;
		private $imagen;
		private $id_seccion;
		private $fecha;
		private $con;
		private $pagination;

		public function __construct(){
			$this->con = new Conexion();
			$this->pagination = new Pagination();
		}

		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}

		public function get($atributo){
			return $this->$atributo;
		}

		public function listar(){
			$this->pagination->set('table','estudiantes');
			$this->pagination->set('per_page',2);
			$this->pagination->set('class_pagination','pagination');
			$this->pagination->set('feature_query','SELECT t1.*, t2.nombre as nombre_seccion FROM estudiantes t1 INNER JOIN secciones t2 ON t1.id_seccion = t2.id ORDER BY id DESC');
			$pagination = $this->pagination->pagination_records();
			
			$datos = $pagination;
			return $datos;
		}

		public function add(){
			$sql = "INSERT INTO estudiantes(id, nombre, edad, promedio, imagen, id_seccion, fecha)
					VALUES (null, '{$this->nombre}', '{$this->edad}', '{$this->promedio}', '{$this->imagen}',
					'{$this->id_seccion}', NOW())";
			$this->con->consultaSimple($sql);
		}

		public function delete(){
			$sql = "DELETE FROM estudiantes WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
		}

		public function edit(){
			$sql = "UPDATE estudiantes SET nombre = '{$this->nombre}', edad = '{$this->edad}', 
					promedio = '{$this->promedio}', id_seccion = '{$this->id_seccion}' WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
		}

		public function view(){
			$sql = "SELECT t1.*, t2.nombre as nombre_seccion FROM estudiantes t1 INNER JOIN secciones t2 
					ON t1.id_seccion = t2.id WHERE t1.id = '{$this->id}'";
			$datos = $this->con->consultaRetorno($sql);
			$row = mysqli_fetch_assoc($datos);
			return $row;
		}

	}
?>