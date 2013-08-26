<?php
class Lugar {
	private $_lugarId;
	private $_precio;
	private $_tipoId;
	private $_objetoBase;
	
	public function __construct($objBase)
	{
		$this->_objetoBase = $objBase;
	}
	
	public function getLugar($id)
	{
		$this->_objetoBase->query("SELECT * FROM `lugares` WHERE lugar_id = :lugar_id");
		$this->_objetoBase->bind(':lugar_id', $id);
		return $this->_objetoBase->single();
	}
	
	public function getLugares()
	{
		$this->_objetoBase->query("SELECT * FROM `lugares`");
		return $this->_objetoBase->resultset();
	}
	
	public function detectarOcupado($lugarId)
	{
		$this->_objetoBase->query("SELECT c.nombre, c.apellido, v.matricula, v.marca, v.modelo, v.color FROM lugares l LEFT JOIN vehiculos v ON (v.vehiculo_id = l.vehiculo_id) LEFT JOIN clientes c ON (c.cliente_id = v.cliente_id) WHERE l.lugar_id=".$lugarId." AND v.fecha_baja IS NULL AND c.cliente_id=v.cliente_id");
		return $this->_objetoBase->resultset();
	}

	public function insertarLugar($tabla, $datos)
	{
		$this->_objetoBase->insertar($tabla, $datos);
	}

	public function actualizarLugar($tabla, $where, $datos)
	{
		$this->_objetoBase->actualizar($tabla, $where, $datos);
	}

	public function eliminarLugar($tabla, $where)
	{
		$this->_objetoBase->eliminar($tabla, $where);
	}
}
?>