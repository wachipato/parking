<?php
class Tipo {
	private $_tipoId;
	private $_nombre;
	private $_objetoBase;
	
	public function __construct($objBase)
	{
		$this->_objetoBase = $objBase;
	}
	
	public function getTipo($id)
	{
		$this->_objetoBase->query("SELECT * FROM `tipos_de_vehiculo` WHERE tipo_id = :tipo_id");
		$this->_objetoBase->bind(':tipo_id', $id);
		return $this->_objetoBase->single();
	}
	
	public function getTipos()
	{
		$this->_objetoBase->query("SELECT * FROM `tipos_de_vehiculo`");
		return $this->_objetoBase->resultset();
	}
	
	public function insertarTipo($tabla, $datos)
	{
		$this->_objetoBase->insertar($tabla, $datos);
	}

	public function actualizarTipo($tabla, $where, $datos)
	{
		$this->_objetoBase->actualizar($tabla, $where, $datos);
	}

	public function eliminarTipo($tabla, $where)
	{
		$this->_objetoBase->eliminar($tabla, $where);
	}
}
?>