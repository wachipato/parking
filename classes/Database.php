<?php

/* Conexión a la BD */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "cochera");

class Database{
	private $_host      = DB_HOST;
	private $_user      = DB_USER;
	private $_pass      = DB_PASS;
	private $_dbname    = DB_NAME;

	private $_dbh;
	private $_error;
	private $_stmt;
	
	/*
	* Se construye la conexión al instanciar el objeto y se guarda en _dbh
	*/
	public function __construct(){
		// Setear DSN
		$dsn = 'mysql:host=' . $this->_host . ';dbname=' . $this->_dbname;
		// Opciones
		$options = array(
			PDO::ATTR_PERSISTENT    => true,
			PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
		);
		// Crear la instancia PDO
		try{
			$this->_dbh = new PDO($dsn, $this->_user, $this->_pass, $options);
		}
		// Catch errores
		catch(PDOException $e){
			$this->_error = $e->getMessage();
		}
	}
	
	public function getStmt()
	{
		return $this->_stmt;
	}
	
	/*
	* Este método sólo PREPARA el Query a ejecutar
	*/
	public function query($query){
		$this->_stmt = $this->_dbh->prepare($query);
	}
	
	/*
	* Se protege el 'statement' de inyecciones SQL
	*/
	public function bind($param, $value, $type = null){
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->_stmt->bindValue($param, $value, $type);
	}
	
	/*
	* Se ejecuta el 'statement', se recomienda siempre
	* 'bindear' el query antes de ejecutarlo
	*/
	public function execute(){
		return $this->_stmt->execute();
	}
	
	/*
	* Retorna las filas afectadas como un array asociativo
	*/
	public function resultset(){
		$this->execute();
		return $this->_stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/*
	* Retorna una fila como un array asociativo
	*/
	public function single(){
		$this->execute();
		return $this->_stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	/*
	* Retorna el último ID afectado como un String
	*/
	public function lastInsertId(){
		return $this->_dbh->lastInsertId();
	}

	/*
	* Comienza la transacción
	*/
	public function beginTransaction(){
		return $this->_dbh->beginTransaction();
	}
	
	/*
	* Finaliza la transacción
	*/
	public function endTransaction(){
		return $this->_dbh->commit();
	}
	
	/*
	* Se cancela la transacción
	*/
	public function cancelTransaction(){
		return $this->_dbh->rollBack();
	}
	
	/*
	* Vuelca la información contenida en una sentencia preparada directamente en la salida.
	* Proporcionará la consulta SQL en uso, el número de parámetros usados (Params),
	* la lista de parámetros con sus nombres, su tipo (paramtype) como un entero, sus
	* nombres de clave o posición, el valor, y la posición en la consulta (si lo admite el
	* controlador de PDO, si no, será -1).
	*/
	public function debugDumpParams(){
		return $this->_stmt->debugDumpParams();
	}

	/*
	CRUD Operations
	*/
	function insertar($tabla, $datos)
	{
		$valores = array();

		foreach ($datos as $key => $val) {
			$valores['campo'][] = '`'.$key.'`';
			$valores['valuesBind'][] = ':'.$key;
			$valores['values'][] = is_int($val)?(int)$val:(string)$val;
		}
		
		$this->query('INSERT INTO `'.$tabla.'` ('.implode(", ", $valores['campo']).') VALUES ('.implode(", ", $valores['valuesBind']).')');
		
		$cant = count($valores['valuesBind']);

		for ($i=0; $i<$cant;$i++) {
			$this->bind($valores['valuesBind'][$i], $valores['values'][$i]);
		}

		$this->execute();
	}

	public function actualizar($tabla, $where, $datos)
	{
		$campos = array();

		$datos = array_filter($datos);
		
		print_r($datos);
		foreach ($datos as $key => $val) {
			$campos['key'][] = '`'.$key.'` = :'.$key;
			$campos['bind'][':'.$key] = is_int($val)?(int)$val:(string)$val;
		}
		
		$this->query('UPDATE `'.$tabla.'` SET '.implode (", ", $campos['key']).' WHERE '.$where);

		foreach ($campos['bind'] as $key => $value) {
			$this->bind($key, $value);
		}

		$this->execute();
	}

	public function eliminar($tabla, $where)
	{
		$this->query('DELETE FROM `'.$tabla.'` WHERE '.$where);
		$this->execute();
	}
}
?>