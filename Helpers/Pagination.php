<?php namespace Helpers;

use Models\Conexion as Conexion;

/**
* Clase para realizar paginacion
*
* Una clase que retorna datos de una tabla, paginacion y busqueda
* la clase en si, es solo rudimentaria
* 
* @author     JC <juankarlos.0304@gmail.com>
* @version    0.1
* @copyright  (c) 2016 - 2020 JC
* @license    http://www.gnu.org/licenses/lgpl-3.0.txt GNU LESSER GENERAL PUBLIC LICENSE
*  
*/

class Pagination{

	// Metodo para la obtencion de la paginacion
	private $method = 'GET';

	// Variable para mostrar el boton siguiente
	private $next = 'Next';
	
	// Variable para mostrar el boton previo
	private $previous = 'Previous';

	// Variable para la conexion
	private $conn;

	// Tabla de la base de datos
	private $table = '';

	// Total de registros en una base de datos
	private $totalRecords=0;

	// Pagina actual
	private $page=1;

	// NUmero de paginas por tabla
	private $per_page = 10;

	// Clase css para la paginacion
	private $class_pagination='';

	// Items que mostraran el numero de paginas
	private $items=null;

	// Limite de los registros mostrados 
	private $limit = 0;

	// Base de la url
	private $url;

	//
	private $feature_query;

	// Variable para almacenar las consultas sql
	private $sql = "";

	// Variable para hacer las condiciones para mostrar contenido sql.
	private $where = "";
	
	/**
     *  Constructor de la clase.
     *
     *  Inicializa la conexion y la variable page y detecta el metodo.
     *  Si el metodo es post o get asignara el valor correspondiente.
     *
     *  @return void
     */
	function __construct(){
		$this->conn = new Conexion();

		if (isset($_GET['page'])) {
			$this->page = $_GET['page'];
		}else if (isset($_POST['page'])) {
			$this->page = $_POST['page'];
		}else{
			$this->page = 0;
		}
	}

	public function set($atributo, $contenido){
		$this->$atributo = $contenido;
	}

	public function get($atributo){
		return $this->$atributo;
	}

	/**
     *  Metodo build_where
     *
     *  construye parte de la sentencia sql si esta no esta
     *  inicializada por defecto
     *
     *  @return string
     */
	public function build_where(){
		if ($this->sql == '') {
			if ($this->where="") {
				$this->sql="SELECT * FROM ".$this->table;
			}
			else{
				$this->sql="SELECT * FROM ".$this->table." ".$this->where;
			}
		}
		return $this->sql;
	}

	/**
     * Metodo pagination_records
     *
     * Este metodo crea la paginacion con las variables inicializadas
     *
     *  @return array
     */
	public function pagination_records(){
		$paginacion="<ul class='".$this->class_pagination."'>";

		// Inicializa la variable $this->sql con l< consulta a la bd
		$this->build_where();

		// realiza una consulta para averiguar el numero de datos en la tabla de la bd
		$this->totalRecords=$this->conn->count($this->sql);

		// SI la cantidad de registros es igual a cero, retorna cero
		if ($this->totalRecords == 0) {
			return 0;
		}else{
			// Obtiene el numero de items que se mostararn
			$this->items=ceil($this->totalRecords/$this->per_page);

			if ($this->page > 1) {
				$paginacion = $paginacion.'<li><a href="?page='.($this->page-1).'">'.$this->previous.'</a></li>';
			}
			else{
				$paginacion = $paginacion.'<li><a href="#">'.$this->previous.'</a></li>';
			}
			
			for ($i = 1; $i <=$this->items ; $i++) { 
				if ($i == $this->page) {
					$paginacion = $paginacion.'<li class="active"><a href="?page='.$i.'">'.$i.'</a></li>';
				}else{
					$paginacion=$paginacion.'<li><a href="?page='.$i.'">'.$i.'</a></li>';
				}
			}
			
			if ($this->page < $this->items) {
				$paginacion = $paginacion.'<li><a href="?page='.($this->page+1).'">'.$this->next.'</a></li>';
			}else{
				$paginacion = $paginacion.'<li><a href="#">'.$this->next.'</a></li>';
			}
			
			if ($this->page<=1) {
				$this->limit=0;
			}else{
				$this->limit=$this->per_page*($this->page-1);
			}
			
			$paginacion=$paginacion."</ul>";

			$table = $this->table_pag();

			$datos = array($table,$paginacion);
		
			return $datos;
		}
	}

	/**
     * Metodo table_pag
     *
     * Este metodo crea una consulta a la base de datos pero agregando a la consulta
     * los valores de $this->limi y $this->per_page para obtener el numero de registros
     * a mostrar por cada pagina
     *
     *  @return string
     */
	public function table_pag(){
		if ($this->feature_query=='') {
			$this->build_where();
			$this->sql = $this->sql . " LIMIT ".$this->limit.",".$this->per_page;
			$res=$this->conn->consultaRetorno($this->sql);
			return $res;
		}else{
			$this->sql = $this->feature_query;
			$res=$this->conn->consultaRetorno($this->sql." LIMIT ".$this->limit.",".$this->per_page);
			return $res;
		}	
	}
}
?>